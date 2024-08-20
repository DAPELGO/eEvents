<?php

namespace App\Http\Controllers\user;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\user\User;
use App\Models\admin\Article;
use App\Models\admin\Evenement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function frontend()
    {
        return view('frontend.frontend');
    }

    // INSCRIPTION
    public function create()
    {
        return view('frontend.inscription');
    }

    // SAVE DATA
    public function store(Request $request)
    {
        // $user = User::find(5);
        // Mail::to($request->email)->send(new MailRecrutement($user, $user, 'frontend.mail.mail-signup', env('mail_account'), env('mail_account_object')));
        $this->validate($request, [
            'nom_prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            //'password_confirm' => 'required|string|min:6',
        ]);

        $user =  User::create([
            'name' => $request->nom_prenom,
            'email' => $request->email,
            'status' => 1,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login');
    }

    // MENU URGENCE
    public function urgence($submenu)
    {
        switch ($submenu) {
            case 'evenement':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('evenement')])->get();
                return view('frontend.menu.urgence.evenement', compact('articles'));
                break;
            case 'reponse-cours':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('reponse_cours')])->get();
                return view('frontend.menu.urgence.reponse-cours', compact('articles'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('reponse_realisee')])->get();
            return view('frontend.menu.urgence.reponse-realisee', compact('articles'));
                break;
        }

    }

    // MENU RISQUE
    public function risque($submenu)
    {
        switch ($submenu) {
            case 'information':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('information')])->get();
                return view('frontend.menu.risque.information', compact('articles'));
                break;
            case 'evaluation':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('evaluation')])->get();
                return view('frontend.menu.risque.evaluation', compact('articles'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('capacite')])->get();
            return view('frontend.menu.risque.capacite', compact('articles'));
                break;
        }

    }

    // MENU FORMATION
    public function formation($submenu)
    {
        switch ($submenu) {
            case 'formation-disponible':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('formation_disponible')])->get();
                return view('frontend.menu.formation.formation-disponible', compact('articles'));
                break;
            case 'formation-planifiee':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('formation_planifiee')])->get();
                return view('frontend.menu.formation.formation-planifiee', compact('articles'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('formation_realisee')])->get();
            return view('frontend.menu.formation.formation-realisee', compact('articles'));
                break;
        }

    }

    // MENU SIMULATION
    public function simulation($submenu)
    {
        switch ($submenu) {
            case 'exercice-planifie':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('exercice_planifie')])->get();
                return view('frontend.menu.simulation.exercice-planifie', compact('articles'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('exercice_realise')])->get();
            return view('frontend.menu.simulation.exercice-realise', compact('articles'));
                break;
        }

    }

    // MENU RESSOURCE
    public function ressource($submenu)
    {
        switch ($submenu) {
            case 'evaluation':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('evaluation')])->get();
                return view('frontend.menu.ressource.evaluation', compact('articles'));
                break;
            case 'texte':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('texte')])->get();
                return view('frontend.menu.ressource.texte', compact('articles'));
                break;
            case 'plan':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('plan')])->get();
                return view('frontend.menu.ressource.plan', compact('articles'));
                break;
            case 'statistique':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('statistique')])->get();
                return view('frontend.menu.ressource.statistique', compact('articles'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('mediatheque')])->get();
            return view('frontend.menu.ressource.mediatheque', compact('articles'));
                break;
        }

    }

    // MENU CORUS
    public function corus($submenu)
    {
        switch ($submenu) {
            case 'mission':
                return view('frontend.menu.corus.mission');
                break;
            case 'vision':
                return view('frontend.menu.corus.vision');
                break;
            default:
            return view('frontend.menu.corus.team');
                break;
        }

    }

    // EVENT DECLARE
    public function declarer(Request $request)
    {
        try {
            Evenement::create([
                'id_categorie'=>$request->id_categorie,
                'id_structure'=>$request->id_structure,
                'libelle'=>$request->name,
                'url_img'=>'',
                'date_event'=>$request->date_event,
                'slug'=>$request->slug($request->date_event, '-'),
                'description'=>$request->message,
                'id_user_created'=>Auth::user()->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement de l\'évènemennt: '.$e->getMessage());
            flash()->addError('Erreur lors de l\'enregistrement d\'évènement.');
            return redirect()->back();
        }

        flash()->addSuccess('Evènement enregistré avec succès');

    }
}
