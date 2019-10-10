<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Event;
class InfoconnectApiController extends Controller
{
 public function login(Request $request)
 {
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
    
        
    }
}
