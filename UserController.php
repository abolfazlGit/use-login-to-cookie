<?php

namespace App\Http\Controllers;

use  App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {

        $token_cocke = bin2hex(random_bytes(16));
        $request = $request->all();
        $request['cocke'] = $token_cocke;

//        dd($request);
        User::create($request);
        setcookie('user', $token_cocke, time() + (86400 * 30), '/');

        return redirect()->route('direct');

    }

    public function direct()
    {
        $token_user = User::where('cocke', $_COOKIE['user'])->first ();

        if (!empty($token_user)){
            echo $token_user['email'];
        };


//        $users = User::find(11);
////        dd($users['cocke']);
//        if (!isset($_COOKIE['user'])) {
//            echo 'cocke no isset';
//        } elseif ($_COOKIE['user'] != $users['cocke']) {
//            echo 'cocke no taghabol';
//        } else {
//            echo $_COOKIE['user'];
//
//            echo $users['cocke'];
//            echo 'yes';
//        }
    }
}
