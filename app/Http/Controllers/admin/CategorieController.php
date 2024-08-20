<?php

namespace App\Http\Controllers\admin;

use Exception;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{

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
        if (Auth::user()->can('categories.view')) {
            $categories = Categorie::where('is_delete', FALSE)->get();
            return view('backend.categories.index', compact('categories'));
        }
        else{
            return redirect(route('backend.home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('categories.create')) {
            return view('backend.categories.create');
        }
        else{
            return redirect(route('backend.home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('categories.create')) {
            $this->validate($request, [
                'titre'=>'required',
                'type' => 'required|in:events,articles'
            ]);

            $slug = Categorie::where('slug', Str::slug($request->titre))->first();

            if ($slug) {
                flash()->addError('Cette catégorie existe déjà');
                return redirect()->back();
            }

            try{
                Categorie::create([
                    'nom_categorie'=>$request->titre,
                    'slug'=>Str::slug($request->titre),
                    'type_categories'=>$request->type,
                    'description'=>$request->description,
                    'id_user_created'=>Auth::user()->id
                ]);
            }
            catch(Exception $e){
                Log::error('Erreur lors de l\'enregistrement de la catégorie: '.$e->getMessage());
                flash()->addError('Erreur lors de l\'enregistrement de la catégorie');
                return redirect()->back();
            }

            flash()->addSuccess('Catégorie enregistrée avec succès');
            return redirect()->route('categories.index');
        }
        else{
            return redirect(route('backend.home'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if (Auth::user()->can('categories.update')) {
            $categorie = Categorie::where('id', $id)->first();

            if(!$categorie){
                flash()->addError('Catégorie introuvable');
                return redirect()->route('categories.index');
            }

            return view('backend.categories.edit', compact('categorie'));
        }
        else{
            return redirect(route('backend.home'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('categories.update')) {
            $this->validate($request, [
                'titre'=>'required',
                'type' => 'required|in:events,articles'
            ]);

            $verif_categorie = Categorie::where('slug', Str::slug($request->titre))
                                ->where('id', '!=', $id)
                                ->first();

            if ($verif_categorie) {
                flash()->addError('Cette catégorie existe déjà');
                return redirect()->back();
            }

            try{
                $categorie = Categorie::where('id', $id)->first();

                if(!$categorie){
                    flash()->addError('Catégorie introuvable');
                    return redirect()->route('categories.index');
                }

                $categorie->update([
                    'titre'=>$request->titre,
                    'slug'=>Str::slug($request->titre),
                    'type_categories'=>$request->type,
                    'description'=>$request->description,
                    'id_user_modified'=>Auth::user()->id
                ]);
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification de la catégorie: '.$e->getMessage());
                flash()->addError('Erreur lors de la modification de la catégorie');
                return redirect()->back();
            }

            flash()->addSuccess('Catégorie modifiée avec succès');
            return redirect()->route('categories.index');
        }
        else{
            return redirect(route('backend.home'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        return redirect()->route('categories.index');
    }

     public function delete($id)
    {
        if (Auth::user()->can('categories.delete')) {
            try{
                $categorie = Categorie::where('id', $id)->first();

                if(!$categorie){
                    flash()->addError('Catégorie introuvable');
                    return redirect()->route('categories.index');
                }

                $categorie->update([
                    'is_delete'=>TRUE,
                    'id_user_delete'=>Auth::user()->id
                ]);
            }
            catch(Exception $e){
                Log::error('Erreur lors de la suppression de la catégorie: '.$e->getMessage());
                flash()->addError('Erreur lors de la suppression de la catégorie');
                return redirect()->back();
            }

            flash()->addSuccess('Catégorie supprimée avec succès');
            return redirect()->route('categories.index');
        }
        else{
            return redirect(route('backend.home'));
        }
    }
}
