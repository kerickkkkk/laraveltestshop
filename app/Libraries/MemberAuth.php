<?php

namespace App\Libraries;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException as DatabaseQueryException;

class MemberAuth {

  public const HOME = '/';

  private static $member = null;


  public static function signUp(
    $email,
    $password,
    $password_confirm
  ){
    if($password === $password_confirm){
      try {
        Member::create([
          'email' => $email,
          'password' => Hash::make($password),
        ]);
      } catch ( DatabaseQueryException $e) {
        return '信箱或者密碼無效';
      }
      return null;
    }
    return '密碼 與 再次確認密碼 不同';
  }


  public static function member()
  {

    if( empty(self::$member) && session()->exists('memberId')){
      
      // self::$member = Member::find(session('memberId'));
      
      $memberId = Crypt::decryptString(session('memberId'));
      self::$member = Member::find( $memberId );
    }

    return self::$member;
  }

  public static function isLoggedIn()
  {
    return !empty(self::member());
  }

  public static function login($email, $password)
  { 
    $_member = Member::where([
      'email' => $email
    ])->first();

    if( !empty($_member) 
      && Hash::check($password, $_member->password)){
        self::$member = $_member;
        // session(['memberId'=> self::$member->id]);
        
        // 一般需要連 memberId => 整個加密 
        // 但是因為 session  有加密選擇只加密 memberId 的內容
        session(['memberId'=> Crypt::encryptString(self::$member->id)]);
        if (Hash::needsRehash($_member->password))
        {
            self::$member->password = Hash::make($password);
            self::$member->save();
        }
    }

    return redirect( MemberAuth::HOME);
    // self::$member = Member::where([
    //   'email' => $email,
    //   'password' => $password,
    // ])->first();

    // if(!empty(self::$member)){
    //   session(['memberId' => self::$member->id ]);
    // }
  }

  public static function logOut(){
    session()->forget('memberId');
    self::$member = null;
  }

}