<?php

namespace App\Http\Controllers\user;

use Exception;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\user\User;
use App\Models\user\Contact;
use App\Models\admin\Article;
use App\Models\admin\Categorie;
use App\Models\admin\Structure;
use App\Models\admin\Evenement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function frontend()
    {
        $categories = Categorie::where('is_delete', FALSE)->get();
        $structures = Structure::where('is_delete', FALSE)->get();
        $urgences = Article::where('id_categorie', env('ID_CATEGORIE_URGENCE'))->limit(4)->get();
        $actus = Article::where(['id_categorie'=>env('ID_CATEGORIE_ACTUALITE'), 'is_published'=>TRUE, 'is_delete'=>FALSE])->limit(4)->orderBy('created_at', 'DESC')->get();
        return view('frontend.frontend', compact('categories', 'structures', 'urgences', 'actus'));
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
                $title = 'LES EVENEMENTS EN COURS';
                $submenu = 'evenement';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_EVENEMENT')])->get();
                return view('frontend.menu.urgence', compact('articles', 'title', 'submenu'));
                break;
            case 'reponse-cours':
                $title = 'LES REPONSES SANITAIRES EN COURS';
                $submenu = 'reponse-cours';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_REPONSECOURS')])->get();
                return view('frontend.menu.urgence', compact('articles', 'title', 'submenu'));
                break;
            default:
            $title = 'LES REPONSES SANITAIRES REALISEES';
            $submenu = 'reponse-realisee';
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_REPONSEREALISE')])->get();
            return view('frontend.menu.urgence', compact('articles', 'title', 'submenu'));
                break;
        }

    }

    // MENU FORMATION
    public function formation($submenu)
    {
        switch ($submenu) {
            case 'formation-disponible':
                $title = 'LES FORMATIONS DISPONIBLES';
                $submenu = 'formation-disponible';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_FORMATIONDISPONIBLE')])->get();
                return view('frontend.menu.formation', compact('articles', 'title', 'submenu'));
                break;
            case 'formation-planifiee':
                $title = 'CATALOGUE DE FORMATIONS';
                $submenu = 'formation-planifiee';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_CATALOGUEFORMATION')])->get();
                return view('frontend.menu.formation', compact('articles', 'title', 'submenu'));
                break;
            default:
            $title = 'PROGRAMME DE FORMATIONS';
            $submenu = 'formation-realisee';
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_PROGRAMFORMATION')])->get();
            return view('frontend.menu.formation', compact('articles', 'title', 'submenu'));
                break;
        }

    }

    // MENU SIMULATION
    public function simulation($submenu)
    {
        switch ($submenu) {
            case 'exercice-planifie':
                $title = 'LES EXERCICES DE SIMULATIONS PLANIFIÉS';
                $submenu = 'exercice-planifie';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_EXERCICESIMPLAN')])->get();
                return view('frontend.menu.simulation', compact('articles', 'title', 'submenu'));
                break;
            default:
            $title = 'LES EXERCICES DE SIMULATIONS RÉALISÉS';
            $submenu = 'exercice-realise';
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_EXERCICESIMREAL')])->get();
            return view('frontend.menu.simulation', compact('articles', 'title', 'submenu'));
                break;
        }

    }

    // MENU RESSOURCE
    public function ressource($submenu)
    {
        switch ($submenu) {
            case 'evaluation':
                $title = 'ÉVALUATIONS ET RECHERCHES OPÉRATIONNELLES';
                $submenu = 'evaluation';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_RESSOURCESEVAL')])->get();
                return view('frontend.menu.ressource', compact('articles', 'title', 'submenu'));
                break;
            case 'texte':
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('texte')])->get();
                return view('frontend.menu.ressource.texte', compact('articles'));
                break;
            case 'plan':
                $title = 'PLANS, PROCÉDURES, DIRECTIVES';
                $submenu = 'plan';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_RESSOURCESPLANS')])->get();
                return view('frontend.menu.ressource', compact('articles', 'title', 'submenu'));
                break;
            case 'statistique':
                $title = 'LES STATISTIQUES';
                $submenu = 'statistique';
                $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_RESSOURCESSTATS')])->get();
                return view('frontend.menu.ressource', compact('articles', 'title', 'submenu'));
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
                $article = Article::where(['is_delete'=>FALSE, 'id'=>env('ID_ART_CORUSMISSION')])->first();
                return view('frontend.menu.corus.mission', compact('article'));
                break;
            case 'vision':
                $article = Article::where(['is_delete'=>FALSE, 'id'=>env('ID_ART_CORUSVISION')])->first();
                return view('frontend.menu.corus.vision', compact('article'));
                break;
            default:
            $articles = Article::where(['is_delete'=>FALSE, 'id_categorie'=>env('ID_CAT_CORUTEAM')])->get();
            return view('frontend.menu.corus.team', compact('articles'));
                break;
        }

    }

    // EVENT DECLARE
    public function declarer(Request $request)
    {
        try {
            $evenement = Evenement::create([
                'code_alert'=>strtoupper(Time()),
                'id_categorie'=>$request->id_categorie,
                'id_structure'=>$request->id_localite,
                'libelle'=>$request->name,
                'url_img'=>'',
                'date_event'=>$request->date_event,
                'slug'=>Str::slug($request->date_event, '-'),
                'description'=>$request->message,
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement de l\'évènemennt: '.$e->getMessage());
            flash()->addError('Erreur lors de l\'enregistrement d\'évènement.');
        }

        return response()->json(['code_alert'=>$evenement->code_alert]);

    }

    public function successAlert($code_alert)
    {
        $evenement = Evenement::where('code_alert', $code_alert)->first();
        return view('frontend.success-alert', compact('evenement'));
    }


    // CONTACT
    public function contacter(Request $request)
    {
        try {
            $contact = Contact::create([
                'code_contact'=>strtoupper(Time()),
                'name'=>$request->name_contact,
                'email'=>$request->email_contact,
                'objet'=>$request->subject,
                'message'=>$request->message_contact,
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement du contact: '.$e->getMessage());
            flash()->addError('Erreur lors de l\'enregistrement du contact.');
        }

        return response()->json(['code_contact'=>$contact->code_contact]);

    }

    public function successContact($code_contact)
    {
        dd(0);
    }

    // ARTICLES
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('frontend.article', compact('article'));
    }

    // EVENEMENTS
    public function showEvenement($slug)
    {
        $evenement = Evenement::where('slug', $slug)->first();
        return view('frontend.evenement', compact('evenement'));
    }

}
