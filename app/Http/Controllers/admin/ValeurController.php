<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Valeur;
use Illuminate\Http\Request;
use App\Models\admin\Parametre;
use App\Models\admin\Structure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ValeurController extends Controller
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
        if (Auth::user()->can('valeurs.view')) {
            $valeurs = DB::table('valeurs')
                                ->join('parametres', 'parametres.id', 'valeurs.id_parametre')
                                ->select('valeurs.*', 'parametres.libelle as libelle_parametre')
                                ->where('valeurs.is_delete', false)
                                ->get();

            return view('backend.valeurs.index', compact('valeurs'));
        }

        return redirect()->route('backend.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('valeurs.create')) {
            $parametres = Parametre::where('is_delete', false)->orderBy('libelle')->get();
            $valeurs = Valeur::where('is_delete', false)->get();

            return view('backend.valeurs.create', compact('parametres', 'valeurs'));
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
        if (Auth::user()->can('valeurs.create')) {
            $this->validate($request, [
                'parametre_id'=>'required',
                'nom_valeur'=>'required',
            ]);

            //verifier si la valeur existe deja
            $valeur = Valeur::where('libelle', $request->nom_valeur)->first();
            /*if($valeur && $valeur->is_delete == false){
                toastr()->error('Une valeur avec le même libellé existe déjà.');
                return redirect()->route('valeurs.index');
            }

            if($valeur && $valeur->is_delete == true){
                $valeur->update([
                    'is_delete'=>false
                ]);

                toastr()->success('Valeur ajoutée avec succès');
                return redirect()->route('valeurs.index');
            }*/

            try{
                $valeur = Valeur::create([
                    'id_parametre'=>$request->parametre_id,
                    'id_parent'=>$request->id_parent,
                    'libelle'=>$request->nom_valeur,
                ]);
            }
            catch(Exception $e){
                Log::error('Erreur lors de l\'enregistrement de la valeur: '.$e->getMessage());
                toastr()->error('Une erreur est survenue lors de l\'enregistrement de la valeur');
                return redirect()->route('valeurs.index');
            }

            toastr()->success('Valeur enregistrée avec succès');
            return redirect()->route('valeurs.index');
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
       return redirect()->route('valeurs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('valeurs.update')) {
            $valeurup = Valeur::where('id', $id)->first();

            if(!$valeurup)
            {
                toastr()->error('La valeur que vous voulez modifier n\'existe pas');
                return redirect()->route('valeurs.index');
            }

            $parametres = Parametre::where('is_delete', false)->orderBy('libelle')->get();
            $valeurs = Valeur::where('is_delete', false)->get();

            return view('backend.valeurs.edit', compact('valeurup', 'parametres', 'valeurs'));
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
        if (Auth::user()->can('valeurs.update')) {
            $this->validate($request, [
                'parametre_id'=>'required',
                'nom_valeur'=>'required',
            ]);

            $valeur = Valeur::where('id', $id)->where('is_delete', false)->first();

            if(!$valeur)
            {
                toastr()->error('La valeur que vous voulez modifier n\'existe pas');
                return redirect()->route('valeurs.index');
            }

            $verif_valeur = Valeur::where('libelle', $request->nom_valeur)->where('id', '!=', $id)->where('is_delete', false)->first();
            /*if($verif_valeur){
                toastr()->error('Une valeur avec le même libellé existe déjà.');
                return redirect()->route('valeurs.index');
            }*/

            try{
                $valeur->id_parametre = $request->parametre_id;
                $valeur->id_parent = $request->id_parent;
                $valeur->libelle = $request->nom_valeur;
                $valeur->id_user_modified = Auth::user()->id;
                $valeur->save();
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification de la valeur: '.$e->getMessage());
                toastr()->error('Une erreur est survenue lors de l\'enregistrement de la valeur');
                return redirect()->route('valeurs.index');
            }

            toastr()->success('Valeur modifié avec succès');
            return redirect()->route('valeurs.index');
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
        return redirect()->route('valeurs.index');
    }


    public function delete(Request $request, $id)
    {
        if (Auth::user()->can('valeurs.delete')) {

            $valeur = valeur::find($id);

            if(!$valeur)
            {
                toastr()->error('La valeur que vous voulez supprimer n\'existe pas');
                return redirect()->route('valeurs.index');
            }

            $valeur->is_delete = true;
            $valeur->id_user_delete = Auth::user()->id;
            $valeur->save();

            toastr()->success('Valeur supprimée avec succès');
            return redirect()->route('valeurs.index');
        }
    }
}
