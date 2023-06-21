<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

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

    //ADDED:
    public function showRegistrationForm()
    {
        $customers = Customer::all();
        return view('auth.register', compact('customers'));
    }

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],

            'address' => ['nullable', 'string', 'max:255'],
            'nif' => ['nullable', 'integer', 'digits:9'],
            'default_payment_type' => ['nullable', 'in:VISA,MC,PAYPAL'],
            'default_payment_ref' => ['nullable', 'string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $newUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_type' => 'C',
                'blocked' => 0,
                'photo_url' => null,
            ]);
            $newCustomer = Customer::create([
                'id' => $newUser->id,
                'nif' => $data['nif'],
                'address' => $data['address'],
                'default_payment_type' => $data['default_payment_type'],
                'default_payment_ref' => $data['default_payment_ref'],

            ]);
            //$newCustomer->id = $newUser->id;
            return $newUser;
        });
    }
}
