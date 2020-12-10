<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterProfessionalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'notification']);
    }

    public function showProfessionForm()
    {
        return view(getTemplate() . '.professional.signup');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Response
     */
    public function registerProfessional(Request $request)
    {
        $this->create($request->all());
        return redirect('/')->with('msg', trans('main.account_created'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'professional_name' => ['required', 'string', 'max:255'],
            'professional_document' => ['required', 'string', 'max:255'],
            'professional_matricula' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);



    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        Professional::create([
            'name' => $data['professional_name'],
            'document' => $data['professional_document'],
            'matricula' => $data['professional_matricula'],
            'number_phone' => $data['professional_phone']
        ]);

        return User::create([
            'name' => $data['professional_name'],
            'username' => '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => time(),
            'admin' => false,
            'mode' => 'active',
            'category_id' => get_option('user_default_category', 0),
            'vendor' => 1,
            'token' => Str::random(25)
        ]);
    }
}
