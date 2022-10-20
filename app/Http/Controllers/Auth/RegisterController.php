<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\AuthenticatesRegister;
use App\Models\Auth\AuthenticatesUsers;
use Illuminate\Auth\Events\Logout;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    use AuthenticatesRegister;

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

    /*
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
    */

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'nis_nip' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'ruang_kalab' => ['string', 'max:20', 'nullable:users'],
            'kelas' => ['string', 'max:20', 'nullable:users'],
            'mapel_guru' => ['string', 'max:150', 'nullable:users'],
            'email' => ['required', 'string', 'email', 'max:150'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    
    

    
 /*     Create a new user instance after a valid registration.
    
      @param  array  $data
      @return \App\Models\Auth\User
*/
     
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

       // $this->guard()->login($user);
    //this commented to avoid register user being auto logged in

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    
    }
    
    
    protected function create(array $data)
    {
        return User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'nis_nip' => $data['nis_nip'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    
    /*
    protected function create(Request $request)
    {
        return User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nis_nip' => $request->nis_nip,
            'role' => $request->role,
            'ruang_kalab' => $request->ruang_kalab,
            'kelas' => $request->kelas,
            'mapel_guru' => $request->mapel_guru,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
    */

    protected function registered( Request $request, $user )
    {
    }
}
