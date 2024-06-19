<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\User;
use Illuminate\Support\Facades\Hash;

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

    public function mission()
    {
        return view('frontend.menu.corus.mission');
    }

    public function vision()
    {
        return view('frontend.menu.corus.vision');
    }

    public function team()
    {
        return view('frontend.menu.corus.team');
    }

    public function urgence($submenu)
    {
        switch ($submenu) {
            case 'evenement':
                return view('frontend.menu.urgence.evenement');
                break;
            case 'reponse-cours':
                return view('frontend.menu.urgence.reponse-cours');
                break;
            default:
            return view('frontend.menu.urgence.reponse-realisee');
                break;
        }

    }
}
