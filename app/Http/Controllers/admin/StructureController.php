<?php

namespace App\Http\Controllers\admin;

use Exception;
use DataTables;
use App\Models\admin\Valeur;
use Illuminate\Http\Request;
use App\Models\admin\Structure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StructureController extends Controller
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
     * Display a view of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('structures.view')){
            return view('backend.structures.index');
        }

        return redirect()->route('backend.home');
    }


    public function structuresList(Request $request)
    {
        if(Auth::user()->can('structures.view')){
            if($request->ajax()){
                $query = DB::table('structures')
                            ->leftJoin('valeurs as niveau_structure', 'structures.id_niveau_structure', '=', 'niveau_structure.id')
                            ->leftJoin('valeurs as type_structure', 'structures.id_type_structure', '=', 'type_structure.id')
                            ->leftJoin('structures as parent', 'structures.parent_id', '=', 'parent.id')
                            ->select(
                                'structures.id',
                                'structures.nom_structure',
                                'niveau_structure.libelle as niveau',
                                'type_structure.libelle as type',
                                'structures.is_public_structure as nature',
                                'parent.nom_structure as parent',
                                'structures.code_structure'
                            )
                            ->where('structures.is_delete', false)
                            ->orderBy('structures.nom_structure', 'ASC');

                if($request->has('searchBuilder')){
                    $searchBuilder = $request->input('searchBuilder');

                    foreach($searchBuilder['criteria'] as $criteria){
                        $condition = $criteria['condition'];
                        $data = $criteria['data'];
                        $origData = $criteria['origData'];
                        $type = $criteria['type'];
                        $value = $criteria['value'];

                        if($origData == 'nom_structure'){
                            $origData = 'structures.nom_structure';
                        }
                        elseif($origData == 'niveau'){
                            $origData = 'niveau_structure.libelle';
                        }
                        elseif($origData == 'type'){
                            $origData = 'type_structure.libelle';
                        }
                        elseif($origData == 'nature'){
                            $origData = 'structures.is_public_structure';
                        }
                        elseif($origData == 'parent'){
                            $origData = 'parent.nom_structure';
                        }
                        elseif($origData == 'code_structure'){
                            $origData = 'structures.code_structure';
                        }

                        if($condition == '='){
                            $condition = 'ILIKE';
                        }
                        elseif($condition == '!='){
                            $condition = 'NOT ILIKE';
                        }

                        if($origData && $condition && $value){
                           if($origData == 'structures.is_public_structure'){
                                $texte = iconv('UTF-8', 'ASCII//TRANSLIT', $value[0]);
                                $texte = strtolower($texte);

                                if($texte == 'public'){
                                    $value[0] = true;
                                }
                                elseif($texte == 'prive'){
                                    $value[0] = false;
                                }

                                $query->where($origData, $condition, $value[0]);
                            }
                            else{
                                $value[0] = "%{$value[0]}%";
                                $query->whereRaw("unaccent($origData) $condition ?", [$values[0]]);
                            }
                        }
                    }
                }

                $structures = $query->get();

                $filteredRecords = $totalRecords = $structures->count();

                $structures = $structures->skip($request->input('start'))->take($request->input('length'))->values();

                $structures->transform(function($structure, $key){
                    $structure->nature = $structure->nature ? '<span class="badge bg-primary text-white">Public</span>' : '<span class="badge bg-secondary text-white">Privé</span>';
                    $structure->parent = $structure->parent ? $structure->parent : '---';
                    if(Auth::user()->can('structures.view') || Auth::user()->can('structures.update') || Auth::user()->can('structures.delete')){
                        $structure->actions = '<div class="btn-group">';
                            if(Auth::user()->can('structures.view')){
                                $structure->actions .= '<a href="#" class="btn btn-sm btn-info" title="Voir les détails de la structure" onclick="viewStructure('.$structure->id.')"><i class="fa fa-eye"></i></a>';
                            }
                            if(Auth::user()->can('structures.update')){
                                $structure->actions .= '<a href="'.route('structures.edit', $structure->id).'" class="btn btn-primary btn-sm" title="Modifier la structure"><i class="fa fa-edit"></i></a>';
                            }
                            if(Auth::user()->can('structures.delete')){
                                $structure->actions .= '<a class="btn btn-sm btn-delete btn-danger" title="Supprimer la structure" href="'.route('structures.delete', $structure->id).'"><i class="fa fa-trash"></i></a>';
                            }
                        $structure->actions .= '</div>';
                    }

                    return $structure;
                });

                return DataTables::of($structures)->addIndexColumn()
                        ->with([
                            'draw'=>$request->input('draw'),
                            'recordsTotal'=>$totalRecords,
                            'recordsFiltered'=>$filteredRecords
                        ])
                        ->rawColumns(['nature', 'actions'])
                        ->setTotalRecords($totalRecords)
                        ->setFilteredRecords($filteredRecords)
                        ->skipPaging()
                        ->make(true);
            }
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
        if(Auth::user()->can('structures.create')){
            $valeurs_niveau_structures = Valeur::where(['id_param'=>env('PARAM_NIVEAU_STRUCTURE'), 'is_delete'=>FALSE])->orderBy('libelle', 'ASC')->get();
            $valeurs_structures_non_fs = Structure::where([
                'is_delete'=>FALSE
            ])
            ->whereHas('niveau_structure', function($q){
                $q->where('libelle', '!=', env('FS'));
            })->get()->groupBy('niveau_structure.libelle');

            return view('backend.structures.create', compact('valeurs_niveau_structures', 'valeurs_structures_non_fs'));
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
        if(Auth::user()->can('structures.create')){
            $this->validate($request, [
                'id_valeur_niveaustructure'=>'required|numeric',
                'nom_structure'=>'required',
            ]);

            $array_valeurs_niveau_fs = [env('REGION'), env('PROVINCE'), env('DISTRICT'), env('COMMUNE'), env('FS')];

            $valeurs_niveau_fs = Valeur::where(['id' => $request->id_valeur_niveaustructure, 'is_delete'=>FALSE])->first();

            if((in_array($valeurs_niveau_fs->libelle, $array_valeurs_niveau_fs))  && !$request->parent_id){
                flash()->addError('Vous devez selectionner une structure parente pour un(e) '.strtolower($valeurs_niveau_fs->libelle));
                return redirect()->back();
            }

            if($valeurs_niveau_fs->libelle == env('FS') && !$request->id_valeur_typestructure){
                flash()->addError('Vous devez selectionner un type de structure pour une formation sanitaire');
                return redirect()->back();
            }

            $structure = Structure::where(['nom_structure'=>$request->nom_structure, 'id_niveau_structure'=>$request->id_valeur_niveaustructure])->first();

            if($structure && $structure->is_delete == FALSE){
                flash()->addError('Une structure avec le meme nom et le meme niveau existe deja');
                return redirect()->back();
            }

            if($structure && $structure->is_delete == TRUE){
                $structure->is_delete = FALSE;
                $structure->save();
                flash()->addSuccess('Structure enregistrée avec succès');
                return redirect()->route('structures.index');
            }

            if($request->private_structure == '1'){
                $public_structure = false;
            }
            else{
                $public_structure = true;
            }

            try{
                $structure = Structure::create([
                    'parent_id'=>$request->parent_id ? $request->parent_id : NULL,
                    'nom_structure'=>$request->nom_structure,
                    'slug'=>Str::slug($request->nom_structure, '_'),
                    'id_niveau_structure'=>$request->id_valeur_niveaustructure,
                    'id_type_structure'=>$request->id_valeur_typestructure ? $request->id_valeur_typestructure : NULL,
                    'code_structure'=>$request->code_structure ? $request->code_structure : NULL,
                    'is_public_structure'=>$public_structure,
                    'is_delete'=>FALSE,
                    'id_user_created'=>Auth::user()->id
                ]);
            }
            catch(Exception $e){
                Log::error('Erreur lors de l\'enregistrement de la structure: '.$e->getMessage());
                flash()->addError('Erreur lors de l\'enregistrement de la structure.');
                return redirect()->back();
            }

            flash()->addSuccess('Structure enregistrée avec succès');
            return redirect()->route('structures.index');
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
        if(Auth::user()->can('structures.view')){
            $structure = Structure::where('id', $id)
                                    ->with('niveau_structure', 'type_structure', 'parent')
                                    ->first();

            if(!$structure){
                return response()->json([
                    'success' => false,
                    'message' => 'Cette structure n\'existe pas'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $structure
            ], 200);
        }

        return redirect()->route('backend.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('structures.update')){
            $structure = Structure::find($id);
            if(!$structure){
                flash()->addError('Structure non trouvée');
                return redirect()->route('structures.index');
            }
            $valeurs_niveau_structures = Valeur::where(['id_parametre'=>env('PARAM_NIVEAU_STRUCTURE'), 'is_delete'=>FALSE])->orderBy('libelle', 'ASC')->get();
            $valeurs_type_structures = Valeur::where(['id_parametre'=>env('PARAM_TYPE_STRUCTURE'), 'is_delete'=>FALSE])->orderBy('libelle', 'ASC')->get();

            $valeurs_structures_non_fs = Structure::where([
                'is_delete'=>FALSE
            ])
            ->whereHas('niveau_structure', function($q){
                $q->where('libelle', '!=', env('FS'));
            })->get()->groupBy('niveau_structure.libelle');

            return view('backend.structures.edit', compact('structure', 'valeurs_niveau_structures', 'valeurs_type_structures', 'valeurs_structures_non_fs'));
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
        if(Auth::user()->can('structures.update')){
            $this->validate($request, [
                'id_valeur_niveaustructure'=>'required|numeric',
                'nom_structure'=>'required'
            ]);

            $array_valeurs_niveau_fs = [env('REGION'), env('PROVINCE'), env('DISTRICT'), env('COMMUNE'), env('FS')];

            $valeurs_niveau_fs = Valeur::where(['id' => $request->id_valeur_niveaustructure, 'is_delete'=>FALSE])->first();

            if((in_array($valeurs_niveau_fs->libelle, $array_valeurs_niveau_fs))  && !$request->parent_id){
                flash()->addError('Vous devez selectionner une structure parente pour un(e) '.strtolower($valeurs_niveau_fs->libelle));
                return redirect()->back();
            }

            if($valeurs_niveau_fs->libelle == env('FS') && !$request->id_valeur_typestructure){
                flash()->addError('Vous devez selectionner un type de structure pour une formation sanitaire');
                return redirect()->back();
            }

            $verif_structure = Structure::where(['nom_structure'=>$request->nom_structure, 'id_niveau_structure'=>$request->id_valeur_niveaustructure, 'is_delete'=>FALSE])
                                    ->where('id', '!=', $id)->first();

            if($verif_structure){
                flash()->addError('Une structure avec le meme nom et le meme niveau existe deja');
                return redirect()->back();
            }

            if($request->private_structure == '1'){
                $public_structure = false;
            }
            else{
                $public_structure = true;
            }

            try{
                $structure = Structure::find($id);
                if(!$structure){
                    flash()->addError('Structure non trouvée');
                    return redirect()->route('structures.index');
                }

                $structure->parent_id = $request->parent_id ? $request->parent_id : NULL;
                $structure->nom_structure = $request->nom_structure;
                $structure->slug = Str::slug($request->nom_structure, '_');
                $structure->id_niveau_structure = $request->id_valeur_niveaustructure;
                $structure->id_type_structure = $request->id_valeur_typestructure ? $request->id_valeur_typestructure : NULL;
                $structure->code_structure = $request->code_structure ? $request->code_structure : NULL;
                $structure->is_public_structure = $public_structure;
                $structure->id_user_updated = Auth::user()->id;
                $structure->save();
            }
            catch(Exception $e){
                Log::error('Erreur lors de la modification de la structure: '.$e->getMessage());
                flash()->addError('Erreur lors de la modification de la structure');
                return redirect()->back();
            }

            flash()->addSuccess('Structure modifiée avec succès');
            return redirect()->route('structures.index');
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
        return redirect()->route('structures.index');
    }

    public function delete($id)
    {
        if(Auth::user()->can('structures.delete')){
            try{
                $structure = Structure::find($id);

                if(!$structure){
                    flash()->addError('Structure non trouvée');
                    return redirect()->route('structures.index');
                }

                $structure->is_delete = TRUE;
                $structure->id_user_deleted = Auth::user()->id;
                $structure->deleted_at = now();
                $structure->save();
            }
            catch(Exception $e){
                Log::error('Erreur lors de la suppression de la structure: '.$e->getMessage());
                flash()->addError('Erreur lors de la suppression de la structure');
                return redirect()->back();
            }

            flash()->addSuccess('Structure supprimée avec succès');
            return redirect()->route('structures.index');
        }

        return redirect()->route('backend.home');
    }
}
