<?php

namespace App\Http\Controllers\admin;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        if(!Auth::user()->can('events.view')){
            flash()->addError('Vous n\'avez pas l\'autorisation de voir les événements');
            return redirect()->route('backend.home');
        }

        $evenements = Evenement::where('is_delete', FALSE)->get();
        return view('backend.events.index' , compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::user()->can('events.create')){
            flash()->addError('Vous n\'avez pas l\'autorisation de créer un événement');
            return redirect()->route('backend.home');
        }

        $categories = Categorie::where('is_delete', FALSE)
                                ->where('type_categories', 'events')
                                ->get();
        $structures = Structure::where('is_delete', FALSE)
                                ->with('niveau_structure')
                                ->get();

        return view('backend.events.create', compact('categories', 'structures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('events.create')){
            flash()->addError('Vous n\'avez pas l\'autorisation de créer un événement');
            return redirect()->route('backend.home');
        }

        $this->validate($request, [
            'titre'=>'required',
            'categorie'=>'required|exists:categories,id',
            'structure'=>'required|exists:structures,id',
            'date_event'=>'required|date',
            'description'=>'required'
        ]);

        $event = Evenement::where('slug', Str::slug($request->titre , "_"))
                                ->where('date_event', $request->date_event)
                                ->first();


        if($event){
            flash()->addError('Cet événement existe déjà');
            return redirect()->back();
        }

        try {
            if($request->file('image')){
                $image = $request->file('image');

                // check image extension
                $allowedfileExtension=['jpg','png','jpeg'];
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check){
                    flash()->addError('Le fichier doit être une image de type jpg, jpeg ou png');
                    return redirect()->back();
                }

                //check image size
                $size = $image->getSize();
                if($size > 5000000){
                    flash()->addError('La taille de l\'image ne doit pas dépasser 5Mo');
                    return redirect()->back();
                }

                //check image dimension
                $dimensions = getimagesize($image);
                if($dimensions[0] < 1920 || $dimensions[1] < 1080){
                    flash()->addError('Les dimensions de l\'image ne doivent pas dépasser 1920x1080');
                    return redirect()->back();
                }

                $image_name = Str::slug($request->titre , "_").'_'.$request->date_event.'.'.$extension;
                $image->move(public_path('images/events'), $image_name);
            }
            else{
                $image_name = 'default_event.png';
            }
        }
        catch (Exception $e) {
            $image_name = 'default_event.png';
            Log::error('Erreur lors de l\'enregistrement de l\'image de l\'événement: '.$e->getMessage());
        }

        try{
            Evenement::create([
                'id_categorie'=>$request->categorie,
                'id_structure'=>$request->structure,
                'libelle'=>$request->titre,
                'url_img'=>$image_name,
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
        return redirect()->route('evenements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Auth::user()->can('events.view')){
            flash()->addError('Vous n\'avez pas l\'autorisation de voir les événements');
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas l\'autorisation de voir les événements'
            ], 403);
        }

        $evenements = Evenement::where('id', $id)
                                ->where('is_delete', FALSE)
                                ->with('categorie', 'structure')
                                ->first();

        if(!$evenements){
            return response()->json([
                'success' => false,
                'message' => 'Cet événement n\'existe pas'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $evenements
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Auth::user()->can('events.update')){
            flash()->addError('Vous n\'avez pas l\'autorisation de modifier un événement');
            return redirect()->route('backend.home');
        }

        $event = Evenement::where('id', $id)
                            ->where('is_delete', FALSE)
                            ->first();

        if(!$event){
            flash()->addError('Cet événement n\'existe pas');
            return redirect()->back();
        }

        $categories = Categorie::where('is_delete', FALSE)
                                ->where('type_categories', 'events')
                                ->get();

        $structures = Structure::where('is_delete', FALSE)
                                ->with('niveau_structure')
                                ->get();

        return view('backend.events.edit', compact('event', 'categories', 'structures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->can('events.update')){
            flash()->addError('Vous n\'avez pas l\'autorisation de modifier un événement');
            return redirect()->route('backend.home');
        }

        $this->validate($request, [
            'titre'=>'required',
            'categorie'=>'required|exists:categories,id',
            'structure'=>'required|exists:structures,id',
            'date_event'=>'required|date',
            'description'=>'required'
        ]);

        $event = Evenement::where('id', $id)
                            ->where('is_delete', FALSE)
                            ->first();

        if(!$event){
            flash()->addError('Cet événement n\'existe pas');
            return redirect()->back();
        }

        $event_exist = Evenement::where('slug', Str::slug($request->titre , "_"))
                                ->where('date_event', $request->date_event)
                                ->first();

        if($event_exist && $event_exist->id != $event->id){
            flash()->addError('Cet événement existe déjà');
            return redirect()->back();
        }

        try {
            if($request->file('image')){
                $image = $request->file('image');

                // check image extension
                $allowedfileExtension=['jpg','png','jpeg'];
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check){
                    flash()->addError('Le fichier doit être une image de type jpg, jpeg ou png');
                    return redirect()->back();
                }

                //check image size
                /*$size = $image->getSize();
                if($size > 5000000){
                    flash()->addError('La taille de l\'image ne doit pas dépasser 5Mo');
                    return redirect()->back();
                }

                //check image dimension
                $dimensions = getimagesize($image);
                if($dimensions[0] < 1920 || $dimensions[1] < 1080){
                    flash()->addError('Les dimensions de l\'image ne doivent pas dépasser 1920x1080');
                    return redirect()->back();
                }*/

                $image_name = Str::slug($request->titre , "_").'_'.$request->date_event.'.'.$extension;
                $image->move(public_path('images/events'), $image_name);
            }
            else{
                $image_name = $event->url_img ? $event->url_img : 'default_event.png';
            }
        }
        catch (Exception $e) {
            $image_name = $event->url_img ? $event->url_img : 'default_event.png';
            Log::error('Erreur lors de la mise à jour de l\'image de l\'événement: '.$e->getMessage());
        }

        try{
            $event->update([
                'id_categorie'=>$request->categorie,
                'id_structure'=>$request->structure,
                'libelle'=>$request->titre,
                'url_img'=>$image_name,
                'date_event'=>$request->date_event,
                'slug'=>Str::slug($request->titre , "_"),
                'description'=>$request->description,
                'id_user_updated'=>Auth::user()->id,
            ]);
        }
        catch(\Exception $e){
            Log::error('Erreur lors de la mise à jour de l\'événement: '.$e->getMessage());
            flash()->addError('Une erreur est survenue lors de la mise à jour de l\'événement');
            return redirect()->back();
        }

        flash()->addSuccess('Evénement mis à jour avec succès');
        return redirect()->route('evenements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('backend.events.index');
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(string $id)
    {
        if(!Auth::user()->can('events.delete')){
            flash()->addError('Vous n\'avez pas l\'autorisation de supprimer un événement');
            return redirect()->route('backend.home');
        }

        $event = Evenement::where('id', $id)
                            ->where('is_delete', FALSE)
                            ->first();

        if(!$event){
            flash()->addError('Cet événement n\'existe pas');
            return redirect()->back();
        }

        try{
            $event->update([
                'is_delete'=>TRUE,
                'id_user_deleted'=>Auth::user()->id,
            ]);
        }
        catch(\Exception $e){
            Log::error('Erreur lors de la suppression de l\'événement: '.$e->getMessage());
            flash()->addError('Une erreur est survenue lors de la suppression de l\'événement');
            return redirect()->back();
        }

        flash()->addSuccess('Evénement supprimé avec succès');
        return redirect()->route('evenements.index');
    }
}
