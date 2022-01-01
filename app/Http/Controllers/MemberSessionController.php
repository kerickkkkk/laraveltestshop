<?php

namespace App\Http\Controllers;

use App\Libraries\MemberAuth;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberSessionController extends Controller
{
    public function create()
    {   
        if(MemberAuth::isLoggedIn()){
            return redirect(MemberAuth::HOME);
        }

        return view('member.login');

        // test 1 
        // $member = null;
        // if(session()->exists('memberId')){
        //     $member = Member::find(session('memberId'));
        // }
        // return view('member.login',[
        //     'member' => $member
        // ]);

    }
    public function store(Request $request)
    {

        MemberAuth::login(
            $request->email, 
            $request->password
        );
        return redirect(MemberAuth::HOME);

        // test 1 
        // $member = Member::where([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ])->first();
        
        // if(!empty($member)){
        //     session(['memberId' => $member->id]);
        // }

        // return redirect()->route('member.session.create');
    }
    public function delete()
    {

        MemberAuth::logOut();
        return redirect(MemberAuth::HOME);

        // test 1 
        // session()->forget('memberId');
        // var_dump(session('memberId'));
        // return redirect()->route('member.session.create');

    }
}
