<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Valeur::where('is_delete', FALSE)->get();
        $localites = Valeur::where('is_delete', FALSE)->get();
        return view('backend.events.create', compact('categories', 'localites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_categorie'=>'required',
            'id_localite'=>'required',
            'id_structure'=>'required',
            'libelle'=>'required',
            'date_event'=>'required',
            'description'=>'required',
        ]);

        Evenement::create([
            'id_categorie'=>$request->id_categorie,
            'id_localite'=>$request->id_localite,
            'id_structure'=>$request->id_structure,
            'libelle'=>$request->libelle,
            'url_img'=>$request->libelle,
            'date_event'=>$request->date_event,
            'slug'=>str_slug($request->libelle , "-"),
            'description'=>$request->description,
            'id_user_created'=>Auth::user()->id,
        ]);

        return redirect()->action('${App\Http\Controllers\EventController@index}');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Evenement::where('id', $id)->first();
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Evenement::where('id', $id)->first();
        $categories = Valeur::where('is_delete', FALSE)->get();
        $localites = Valeur::where('is_delete', FALSE)->get();
        return view('backend.events.create', compact('event', 'categories', 'localites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'id_categorie'=>'required',
            'id_localite'=>'required',
            'id_structure'=>'required',
            'libelle'=>'required',
            'date_event'=>'required',
            'description'=>'required',
        ]);
        $event = Evenement::where('id', $id)->first();
        $event->update([
            'id_categorie'=>$request->id_categorie,
            'id_localite'=>$request->id_localite,
            'id_structure'=>$request->id_structure,
            'libelle'=>$request->libelle,
            'url_img'=>$request->libelle,
            'date_event'=>$request->date_event,
            'slug'=>str_slug($request->libelle , "-"),
            'description'=>$request->description,
            'id_user_created'=>Auth::user()->id,
        ]);

        return redirect()->action('${App\Http\Controllers\EventController@index}');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
