<?php

namespace App;

// use App\Mail\RequestCreated;
// use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [ 'user_1_id' , 'user_2_id' , 'user_3_id' ,  
    ];
}
