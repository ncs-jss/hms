<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
