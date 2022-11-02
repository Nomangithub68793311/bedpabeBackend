<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use JWTAuth;
use JWTFactory;

class PublicAllData extends Controller
{
    public function allPost($city,$category)

    {
        // return  response()->json(["success"=>$country]);

        $id="de191b40-f46e-450c-b5a2-20926c9b4ae0";
        $post = Post::where('city','=',$city)
        ->where('category','=',$category)
        ->get();
        return  response()->json(["success"=>$post]);
    }

    public function singlePost($id)

   { 
    $post=Post::find($id);
    return  response()->json(["success"=> $post]);
}



}
