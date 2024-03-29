<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        $follows = DB::table('follows')
            ->join('users', 'users.id', '=', 'follows.follow')
            ->where('follows.follower', Auth::id())
            ->select('users.id','users.images')
            ->get();
        $follow_post = DB::table('users')
            ->join('follows','users.id', '=', 'follows.follow')
            ->join('posts', 'posts.user_id', '=', 'follows.follow')
            ->where('follows.follower', Auth::id())
            ->select('users.username','users.images','posts.posts', 'posts.created_at')
            ->get();

            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();

            $username = Auth::user()->username;

        return view('follows.followList',['follows'=>$follows,'follow_post'=>$follow_post, 'follower_count' => $follower_count, 'follow_count' => $follow_count ,'username' => $username]);
    }

    public function followerList(){
        $followers = DB::table('follows')
            ->join('users', 'users.id', '=', 'follows.follower')
            ->where('follows.follow', Auth::id())
            ->select('users.id','users.images')
            ->get();

            $follows = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $followers = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();


            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();

            $username = Auth::user()->username;

        return view('follows.followerList',['followers'=>$followers, 'followers' => $followers , 'follower_count' => $follower_count, 'follow_count' => $follow_count ,'username' => $username]);
    }
    public function create(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->insert([
            'follow'=>$id,
            'follower'=>Auth::id(),
            'created_at'=>now()
        ]);
        return back();
    }

     public function delete(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->where([
            'follow'=>$id,
            'follower'=>Auth::id()
        ])->delete();
        return back();
    }
}
