<?php

namespace App\Http\Controllers;

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
        if($request->password === $request->password_confirm){
            Member::create([
                'email' => $request->email,
                'password' => $request->password,
            ]);
        }
        return redirect('/');
    }
}
