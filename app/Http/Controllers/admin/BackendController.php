<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Valeur;
use Illuminate\Http\Request;
use App\Models\admin\Evenement;
use App\Models\admin\Structure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
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

    public function home()
    {
        $evenements = Evenement::where('is_delete', FALSE)->count();

        $evenements = $this->formatNumber($evenements);

        return view('backend.admin', compact('evenements'));

    }

    private function formatNumber($number)
    {
        if($number < 10){
            return '0' . $number;
        }
        elseif($number >= 1000000){
            return number_format($number / 1000000, 1) . 'M';
        }
        elseif($number >= 1000){
            return number_format($number / 1000, 1) . 'k';
        }

        return $number;
    }

    // Chargement des données en fonction de la sélection
    public function dataSelection(Request $request)
    {
        $idparent_val = $request->idparent_val;
        $parent_label = $request->parent_label;
        $table = $request->table;

        $array[] = array("id" => '', "name" => '');

        switch ($table) {
            case 'structure':
                $structurees = Structure::where(['is_delete'=>FALSE, 'parent_id'=>$idparent_val])->get();
                foreach ($structurees as $structuree)
                {
                    $array[] = array("id" => $structuree->id, "name" => $structuree->nom_structure);
                }
            break;

            case 'valeur':
                $valeurs = Valeur::where(['is_delete'=>FALSE, 'id_parent'=>$idparent_val])->get();
                foreach ($valeurs as $valeur)
                {
                    $array[] = array("id" => $valeur->id, "name" => $valeur->libelle);
                }
                break;

            case 'type_structure':
                $niveau_structure = Valeur::where(['is_delete'=>FALSE, 'id'=>$idparent_val])->first();
                if($niveau_structure->libelle == 'Formation Sanitaire'){
                    $type_structures = Valeur::where(['id_param'=>env('PARAM_TYPE_STRUCTURE'), 'is_delete'=>FALSE])->get();
                    foreach ($type_structures as $type_structure)
                    {
                        $array[] = array("id" => $type_structure->id, "name" => $type_structure->libelle);
                    }
                }
                else{
                    $array = null;
                }
                break;
        }

        $response['data'] = $array;
        return response()->json($response);
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $file = $request->file('file');

        $fileName = 'article_img_' . uniqid() . '_' . $file->getClientOriginalName();

        $directory = 'images/article_images';

        $path = $file->storeAs($directory, $fileName, 'public');

        return response()->json(['location' => url("/storage/$path")]);
    }
}
