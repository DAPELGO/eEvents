<?php

namespace App\Http\Controllers\admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\admin\Parametre;
use App\Models\admin\Structure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParametreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('users.view')) {
            $parametres = Parametre::where('is_delete', false)->orderBy('libelle')->get();
            return view('backend.parametres.index', compact('parametres'));
        }else{
            return redirect()->route('backend.home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('parametres.create')) {
            $parametres = Parametre::where('is_delete', false)->orderByDesc('libelle')->get();

            return view('backend.parametres.create', compact('parametres'));
        }

        return redirect()->route('backend.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('parametres.create')) {
            $this->validate($request, [
                'nom_parametre'=>'required',
            ]);

            //Verifier si le parametre existe deja
            $parametre = Parametre::where('libelle', $request->nom_parametre)->first();
            if($parametre && $parametre->is_delete == false){
                toastr()->error('Ce parametre existe déjà');
                return redirect()->route('parametres.index');
            }

            if($parametre && $parametre->is_delete == true){
                $parametre->update([
                    'is_delete'=>false
                ]);

                toastr()->success('Parametre ajouté avec succès');
                return redirect()->route('parametres.index');
            }

            Parametre::create([
                'parent_id'=>$request->parent_id,
                'libelle'=>$request->nom_parametre,
            ]);

            toastr()->success('Parametre ajouté avec succès');
            return redirect()->route('parametres.index');
        }

        return redirect()->route('backend.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('parametres.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('parametres.update')) {
            $parametreup = Parametre::where('id', $id)->first();
            if(!$parametreup){
                toastr()->error('Ce parametre n\'existe pas');
                return redirect()->route('parametres.index');
            }

            $parametres = Parametre::where('is_delete', false)->orderBy('libelle')->get();

            return view('backend.parametres.edit', compact('parametreup', 'parametres'));
        }

        return redirect()->route('backend.home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('parametres.update')) {
            $this->validate($request, [
                'nom_parametre'=>'required',
            ]);

            $parametre = Parametre::where('id', $id)->where('is_delete', false)->first();

            if(!$parametre){
                toastr()->error('Ce parametre n\'existe pas');
                return redirect()->route('parametres.index');
            }

            $verif_param = Parametre::where('libelle', $request->nom_parametre)->where('id', '!=', $id)->where('is_delete', false)->first();

            if($verif_param){
                toastr()->error('Ce parametre existe déjà');
                return redirect()->route('parametres.index');
            }

            try{
                $parametre->parent_id = $request->parent_id;
                $parametre->libelle = $request->nom_parametre;
                $parametre->id_user_updated = Auth::user()->id;
                $parametre->save();
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification du parametre: '.$e->getMessage());
                toastr()->error('Erreur lors de la modification du parametre');
                return redirect()->route('parametres.index');
            }

            toastr()->success('Parametre modifié avec succès');
            return redirect()->route('parametres.index');
        }

        return redirect()->route('backend.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('parametres.index');
    }

    public function delete(Request $request, $id)
    {
        if (Auth::user()->can('parametres.delete')) {

            $parametre = Parametre::find($id);

            if(!$parametre){
                toastr()->error('Ce parametre n\'existe pas');
                return redirect()->route('parametres.index');
            }

            $parametre->is_delete = true;
            $parametre->id_user_deleted = Auth::user()->id;
            $parametre->save();

            toastr()->success('Parametre supprimé avec succès');
            return redirect()->route('parametres.index');
        }
    }
}
