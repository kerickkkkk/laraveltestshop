<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberSessionController extends Controller
{
    public function create()
    {
        return view('member.login');
    }
    public function store(Request $request)
    {
        $member = Member::where([
            'email' => $request->email,
            'password' => $request->password,
        ])->first();
        

        return redirect('/');
    }
    public function delete()
    {
        return redirect('/');
    }
}
