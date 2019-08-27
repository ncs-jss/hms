<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class SearchController extends Controller
{
    public function search()
	{
		$users = DB::table('users')->select('id','name')->where('id', '<>', Auth::id())->where('fee_status', '=', '1')->get();
		
		return view("searchroommates", compact('users'));
	}

}
