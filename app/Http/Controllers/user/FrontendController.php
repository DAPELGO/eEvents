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
        return view('frontend.frontend', compact('categories', 'structures'));
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

}
