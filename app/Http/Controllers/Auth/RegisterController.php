<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'vorname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'firma' => 'required|string|max:255',
            'anr' => 'required|string|max:10',
            'agb' => 'required|string|max:1',
            'newsletter' => 'nullable|string|max:1',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create(
            [
                'name' => $data['name'],
                'vorname' => $data['vorname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'firma' => $data['firma'],
                'anr' => $data['anr'],
                'agb' => $data['agb'],
                'newsletter' => $data['newsletter']
            ]);
/*        DB::table('project')->insert([

        ]);*/
/*        if($user){
            if(auth()->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect()->to('/home');
            }
        }*/
    }

}
