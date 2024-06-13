<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\user\Categorie;
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
        if (Auth::user()->can('category.view')) {
            $categories = Categorie::where('is_delete', 0)->get();
            return view('backend.categories.index', compact('categories'));
        }
        return redirect(route('backend.home'));
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
        return redirect(route('backend.home'));
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
            ]);

            Categorie::create([
                'titre'=>$request->titre,
                'chapeau'=>$request->chapeau,
                'is_delete'=>0,
                'corps'=>'',

            ]);

            return redirect()->route('categories.index');
        }
        return redirect(route('backend.home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if (Auth::user()->can('categories.create')) {
            $categorie = Categorie::where('id', $id)->first();
            return view('backend.categories.edit', compact('categorie'));
        }
        return redirect(route('backend.home'));
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
            ]);

            $categorie = Categorie::where('id', $id)->first();
            $categorie->update([
                'titre'=>$request->titre,
                'chapeau'=>$request->chapeau,

            ]);

            return redirect()->route('categories.index');
        }
        return redirect(route('backend.home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {

    }

     public function delete(Request $request)
    {
        //
        $id = $request->id;
            $categorie = Categorie::findOrFail($id);
            $categorie->update([
                'is_delete' => 1,
            ]);
    }
}
