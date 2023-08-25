<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;


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


        return view('users.profile',['users'=>$users,'session_count' => $session_count,'username' => $username ,'follow_count' => $follow_count , 'follower_count' => $follower_count]);
    }

    public function search(Request $request){
        $keyword = $request->search;
        if(request('search')){
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


        return view('users.search',['users'=>$users,'followNumbers'=>$followNumbers,'username' => $username ,'follow_count' => $follow_count, 'follower_count' => $follower_count, 'keyword' => $keyword, ]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'UserName' => 'required|string|min:4|max:12',
            'mail'  => 'required|string|email|min:4|max:50',
            'NewPassWord' => 'min:4|max:12'
        ],[
            'UserName.required' => '名前は必須です',
            'UserName.min' => '名前は4文字以上です',
            'UserName.max' => '名前は12文字以下です',
            'mail.required' => 'メールアドレスは必須です',
            'mail.min' => 'メールアドレスは4文字以上です',
            'mail.max' => 'メールアドレスは50文字以下です',
            'mail.email' => '有効なメールアドレスを入力してください',
            'NewPassWord.min' => 'パスワードは4文字以上です',
            'NewPassWord.max' => 'パスワードは12文字以内です'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput()
            ->withErrors($validator);
        }


        // バリデーションが通ったら
        $username = $request->input('UserName');
        $mail = $request->input('mail');
        $bio = $request->input('bio');

        if(request('NewPassword')){
            $newpassword = $request->input('NewPassword');
            DB::table('users')
            ->where('id',Auth::id())
            ->update([
                'password' => Hash::make($newpassword)
        ]);
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
            'bio' => $bio,
            'images' => $image_name,
        ]);

        return back();

    }

    public function otherProfile($id){
        $user = DB::table('users')
        ->where('id',$id)
        ->first();

        $username = Auth::user()->username;

        $posts = DB::table('posts')
            ->join('users','posts.user_id','users.id')
            ->where('posts.user_id',$id)
            ->select('posts.*','users.username','users.images')
            ->get();

            $username = Auth::user()->username;

            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();

        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->where('id','<>',Auth::id())
            ->pluck('follow');


        return view('users.otherProfile',['user' => $user,
        'username' => $username,'posts' => $posts,'username' => $username, 'follow_count' => $follow_count,'follower_count'=> $follower_count,'followNumbers'=>$followNumbers]);
    }
}
