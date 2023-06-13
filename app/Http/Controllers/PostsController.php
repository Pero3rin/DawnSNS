<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    //
    public function index(){
            $posts = DB::table('posts')
            ->join('users','posts.user_id','users.id')
            ->select('posts.*','users.username','users.images')
            ->get();

            $username = Auth::user()->username;

            $follow_count = DB::table('follows')
            ->where('follower', '=', Auth::id())
            ->count();

            $follower_count = DB::table('follows')
            ->where('follow', '=', Auth::id())
            ->count();

        return view('posts.index',['posts' => $posts ,'username' => $username ,'follows' => $follow_count, 'followers' => $follower_count]);
    }

     public function create(Request $request){
        $post = $request->input('newPost');
        $id = Auth::id();
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => $id
        ]);
        return redirect('/top');
    }

     public function delete($id){
     DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

    public function update(Request $request){
        $post = $request->input('upPost');
        $id = $request->input('id');
        // DD($id);
          DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $post]
            );

        return redirect('/top');
    }
}
