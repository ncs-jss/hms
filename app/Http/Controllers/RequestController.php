<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $request = new Request;
        $request->user_1_id = $input['user'][0];
        $request->user_2_id = $input['user'][1];
        $request->save();



        // $attributes[$user_1_id]= 
        // dd($attributes);
        // request::create($attributes);
    }
}
