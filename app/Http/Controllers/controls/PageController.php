<?php

namespace App\Http\Controllers\controls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        // if( !Auth::user()->is_admin ){
        //     return redirect('/')->withErrors('沒有權限');
        // }
        return view('controls.home');
    }
}
