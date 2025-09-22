<?php

namespace App\Http\Controllers\user\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class LoginsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.login');
    }

    public function showForgetForm()
    {
        return view('frontend.recover-password');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    protected function credentials(Request $request)
    {
        // $user = User::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->orWhere('name', $request->email)->first();
        /*$user = DB::table('users')
                                ->join('volontaires', 'users.id', 'volontaires.id_user')
                                ->select('users.*')
                                ->where('users.email', $request->email)
                                ->orWhere('volontaires.numero_telephone', $request->email)
                                ->first();*/
        // dd($user);

        if(empty($user))
        {
            return ['email'=>'inactif', 'password'=>"Cet utilisateur n'existe pas"];
        }else{
            if ($user->status == false) {
                return ['email'=>'inactif', 'password'=>"Cet utilisateur n'est pas actif"];
            }else{
                if(is_numeric($request->get('email'))){
                    return ['name'=>$request->get('email'),'password'=>$request->get('password'), 'status'=>1];
                  }
                  elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                    return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'status'=>1];
                  }
                  // return ['username' => $request->get('email'), 'password'=>$request->get('password'), 'status'=>1];
                return ['email'=>$request->email, 'password'=>$request->password, 'status'=>1];
            }
        }
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $fields = $this->credentials($request);

        if ($fields['email'] == 'inactif') {
            
            $errors = response()->json($fields['password']);
        }else{
            $errors = response()->json([$this->username()=>trans('Identifiant/mot de passe incorrect')]);
        }

        throw ValidationException::withMessages([$errors,
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
