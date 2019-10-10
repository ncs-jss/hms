<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


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
    public $successStatus = 200;

    protected function validator(array $data)
    {
        // dd('hello');

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            'mobile_number' => 'required|max:10',

            'admission_number' => 'unique:users|required|max:8',
            'roll_number' =>'required|max:11',
            'year'=>'required',
            'gender'=>'required',
            'is_hosteler'=>'required',
            
            
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
        //dd($data);
        // $validator = Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        //     'mobile_number' => 'required|unique:users|min:10|max:10',
        //     'admission_number' => 'required|unique:users|min:7|max:7',
        //     'roll_number' =>'required|unique:users|min:11|max:11',
        //     'year'=>'required',
        //     'gender'=>'required',
        //     'is_hosteler'=>'required',

        // ]);
        // if ($validator->fails())
        //  {
        //     return redirect('/register')
        //     ->withErrors($validator)
        //     ->withInput();
        // }
        // else
        // {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile_number' =>  $data['mobile_number'],
            'admission_number' =>  $data['admission_number'],
            'roll_number' => $data['roll_number'],
            'year'=> $data['year'],
            'gender'=> $data['gender'],
            'is_hosteler'=> $data['is_hosteler'],

        ]);
    // }
    }

    public function register(Request $request)
    {

    //dd("helo");
    // $this->validator($request->all())->validate();

        $errors = $this->validator($request->all())->errors();

        if(count($errors))
        {
            return response(['errors' => $errors], 401);
        }

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        $state = Str::random(40);

        return response(['user' => $user,
            'token' =>$state 
        ]);

    // event(new Registered($user = $this->create($request->all())));

    // return $this->registered($request, $user)
    // ?: redirect($this->redirectPath());
    }

    public function login(){ 
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] = Str::random(40); 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
           $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

           $url=config('infoConnectApi.url');
           $postData = array(
            'username' => $request->input('username'),
            'password' => $request->input('password')
        );
           $url=config('infoConnectApi.url');

           $client = new Client(); 
           $result = $client->post($url,$postData);
        //API URL

           $arr = json_decode($result, true);
           $state = Str::random(40);
           $user = new User;
           $user->name = $arr['first_name'];
           $user->addmission_number = $arr['username'];
           $user->token= $state;

           return response()->json(['success' => $user], $this-> successStatus); 


       } 
   }
}

