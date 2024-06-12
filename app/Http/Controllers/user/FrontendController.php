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
}
