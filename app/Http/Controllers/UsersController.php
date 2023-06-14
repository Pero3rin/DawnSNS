<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;

class UsersController extends Controller
{
    public function profile(){
        $users = DB::table('users')
        ->where('id',Auth::id())
        ->first();

        $session_count = session()->get('circle');

        $username = Auth::user()->username;

            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();


        return view('users.profile',['users'=>$users,'session_count' => $session_count,'username' => $username ,'follow' => $follow_count , 'follower' => $follower_count]);
    }

    public function search(Request $request){
        if(request('search')){
            $keyword = $request->search;
            $users = DB::table('users')
            ->where('username','like',"%".$keyword."%")
            ->where('id','<>',Auth::id())
        ->get();
        }else{
        $users = DB::table('users')
        ->where('id','<>',Auth::id())
        ->get();
        }

        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->where('id','<>',Auth::id())
            ->pluck('follow');

            $username = Auth::user()->username;

            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();


        return view('users.search',['users'=>$users,'followNumbers'=>$followNumbers,'username' => $username ,'follow' => $follow_count, 'follower' => $follower_count]);
    }

    public function update(Request $request){
        $username = $request->input('UserName');
        $mail = $request->input('mail');
        $bio = $request->input('bio');

        if(request('NewPassword')){
            $newpassword = $request->input('NewPassword');
        }else{
            $newpassword = DB::table('users')
            ->where('id',Auth::id())
            ->value('password');
        }

        if(request('IconImage')){
            $image_name = $request->file('IconImage')->getClientOriginalName();
            //getClientOriginalName=ファイル名取得
            $request->file('IconImage')->storeAs('public/images',$image_name);
            //保存されたファイルにファイル名を自動的に割り当てたくない場合は、
            //引数としてパス($request)、ファイル名(IconImage)、および(オプションの)ディスクを受け取るstoreAsメソッドを使用します。
        }else{
            $image_name = DB::table('users')
            ->where('id',Auth::id())
            ->value('images');
            //get=テーブルの中全部から()で指定する
            //value=()の中のもののみ
        }

        DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'username' => $username,
            'mail' => $mail,
            'password' => Hash::make($newpassword),
            'bio' => $bio,
            'images' => $image_name,
        ]);

        return back();

    }

}
