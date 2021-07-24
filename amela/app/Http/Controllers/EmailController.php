<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
   public function index(Request $request)
   {
       $email = $request->email;
       $check = true;
       if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
       $check = false;
       return view('check.email',compact('check'));
   }
}
