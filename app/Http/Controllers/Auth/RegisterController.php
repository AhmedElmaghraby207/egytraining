<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Interest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Mail\verifyEmail;

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifyToken' => Str::random(40),
        ]);


    }

    public function showRegistrationForm()
    {
        $countries = Country::all();
        $interests = Interest::all();
        return view('auth.register', compact('countries', 'interests'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'user_name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|max:255',
        ]);
        $request['verifyToken'] = Str::random(40);
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        $user->interests()->attach($request->interests);

        $thisUser = User::findOrFail($user->id);
        $this->sendVerifyEmail($thisUser);

        Session::flash('warning', 'تم تسجيل العضوية بنجاح, إذهب إلى بريدك الالكترونى قم بالتفعيل لتتمكن من تسجيل الدخول');
        return redirect('/login');
        //return redirect()->route('verifyEmailFirst');
    }

    public function sendVerifyEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function verifyEmailFirst()
    {
        return view('emails.verifyEmailFirst');
    }

    public function sendVerifyEmailDone($email, $verifyToken)
    {
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
        if ($user)
        {
            $user->update(['active' => 1, 'verifyToken' => null]);
            Session::flash('success', 'تم تفعيل الاكونت بنجاح, يمكنك تسجيل الدخول الان');
            return redirect('/login');
        }
        else
        {
            return 'no user found';
        }
    }

}
