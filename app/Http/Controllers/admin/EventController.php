<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\Localite;
use App\Models\admin\Categorie;
use App\Models\admin\Evenement;
use App\Models\admin\Structure;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
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
     */
    public function index()
    {
        $evenements = Evenement::where('is_delete', FALSE)->get();
        return view('backend.events.index' , compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::where('is_delete', FALSE)->get();
        $localites = Localite::where('is_delete', FALSE)->get();
        $structures = Structure::where('is_delete', FALSE)->get();

        return view('backend.events.create', compact('categories', 'localites', 'structures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre'=>'required',
            'categorie'=>'required|exists:categories,id',
            'localite'=>'required|exists:localites,id',
            'structure'=>'required|exists:structures,id',
            'date_event'=>'required|date',
            'description'=>'required'
        ]);

        // verify if event already exist
        $event = Evenement::where('libelle', $request->titre)
                            ->where('id_categorie', $request->categorie)
                            ->where('date_event', $request->date_event)
                            ->first();

        if($event){
            flash()->addError('Cet événement existe déjà');
            return redirect()->back();
        }

        try {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/events'), $image_name);
        }
        catch (\Exception $e) {
            $image_name = 'default.png';
        }

        try{
            Evenement::create([
                'id_categorie'=>$request->categorie,
                'id_localite'=>$request->localite,
                'id_structure'=>$request->structure,
                'libelle'=>$request->titre,
                'url_img'=>$request->image,
                'date_event'=>$request->date_event,
                'slug'=>Str::slug($request->titre , "_"),
                'description'=>$request->description,
                'id_user_created'=>Auth::user()->id,
            ]);
        }
        catch(\Exception $e){
            Log::error('Erreur lors de l\'enregistrement de l\'événement: '.$e->getMessage());
            flash()->addError('Une erreur est survenue lors de l\'enregistrement de l\'événement');
            return redirect()->back();
        }

        flash()->addSuccess('Evénement enregistré avec succès');
        return redirect()->route('events.index');
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
            'slug'=>Str::slug($request->libelle , "_"),
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
