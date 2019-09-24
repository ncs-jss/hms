<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function verify_results()
	{
		$users = DB::table('users')->select('name','id' , 'roll_number' ,'admission_number', 'result_status')->where([
			['book_room', '=', '1'],
			['is_rejected' , '=' , '0'],
			// 

				
		])->get();

		
		return view("/verifyresults", compact('users'));
			
	}

	public function verify_fees()
	{
		$users = DB::table('users')->select('name' ,'id', 'utr_number' ,'admission_number', 'fee_status')->where([
			['result_status', '=', '1'],
			['is_rejected' , '=' , '0'],
		])->get();
		
		return view("/verifyfees", compact('users'));
	}

	public function update_result_status(User $user)
	{

		
		if($user->result_status == '1')
		{
			$user->result_status='0';
		}
		else
			$user->result_status='1';
        	$user->save();
        return redirect('/verifyresults');
	}
	public function update_fee_status(User $user)
	{

		
		if($user->fee_status == '1')
		{
			$user->fee_status='0';
		}
		else
			$user->fee_status='1';
        	$user->save();
        return redirect('/verifyfees');
	}
	public function show_details(User $user)
	{
		
		return view("/reject", compact('user'));
		
       
	}
	public function show_details2(User $user)
	{
		
		return view("/reject2", compact('user'));
		
       
	}
	public function reject_user(User $user)
	{
		$user->is_rejected = '1';
		//dd($user->is_rejected);
        $user->save();
        // return redirect('/home');
        flash('The user is rejected!')->success();

        return redirect('/verifyresults');
		
		// return view("/verifyresult", compact('user'));
		
       
	}
	public function reject2_user(User $user)
	{
		$user->is_rejected = '1';
		//dd($user->is_rejected);
        $user->save();
        // return redirect('/home');
        flash('The user is rejected!')->success();

        return redirect('/verifyfees');
		
		// return view("/verifyresult", compact('user'));
		
       
	}

	

}
