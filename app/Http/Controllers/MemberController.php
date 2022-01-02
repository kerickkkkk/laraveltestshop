<?php

namespace App\Http\Controllers;

use App\Libraries\MemberAuth;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function create()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $errorMessage = MemberAuth::signUp(
            $request->email,
            $request->password,
            $request->password_confirm,
        );

        if(!empty($errorMessage)){
            return back()->withErrors($errorMessage);
        }
        
        return redirect('/');
        // // test1
        // if($request->password === $request->password_confirm){
        //     Member::create([
        //         'email' => $request->email,
        //         'password' => $request->password,
        //     ]);
        // }
    }
}
