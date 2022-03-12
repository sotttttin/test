<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use APP\HTTP\Controllers;

class PostsController extends Controller
{
    //viewに表示するための記述
    public function index()
    {
       $list = \DB::table('posts')->join('users','posts.user_id','=','users.id')
       ->get();
       return view('posts.index' , ['list' => $list]);
    }

        //下記で定義した変数の情報をデータベースへ登録するための記述
        public function create(Request $request){

         $text = $request->input('posts');
         $user = $request->user('user_id');
              \DB::table('posts')->insert([
             'posts' => $text,
             'user_id' => $user,
             'created_at' => now(),
             'updated_at' => now()
            ]);
         return redirect('/top');
    }

}
