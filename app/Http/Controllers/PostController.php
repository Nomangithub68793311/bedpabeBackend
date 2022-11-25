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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData($id)
    {       
        //  return  response()->json(["bal"=> "id"]);

        $post=Account::find($id)->posts;
        return  response()->json(["success"=> $post]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFree(Request $request,$id)
    {


        $input = $request->only(
            'country','state','city','service','tag',
            'category','title','description','email',
            'phone','age','images'
            
      );   
  
        // return  response()->json(["success"=> $input]);

    

      $validator = Validator::make($input, [
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'service' => 'required',
        'category' => 'required',
        'title' => 'required',
        'description' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'age' => 'required',
        'images' => 'required',
        'tag' => 'required',


        
    ]);

    if($validator->fails()){
        return response()->json(["error"=>'fails']);

    }
    
    // $input['images']  = $request->file('file')->store('products');
    // $post = Post::create($input);
    //     return  response()->json(["success"=> $post]);

        try {
            DB::beginTransaction();
        

            $account=Account::find($id);
            
            $post = Post::create($input); 
            $account->posts()->save($post);
            $post->save();
            
            if (!$post) {
                return response()->json(["error"=>"didnt work"],422);
            } 
            // $response = Http::post('http://127.0.0.1:8000/v1/event', [
            //     "email"=>$student->email
                
            // ]);
            DB::commit();   
            // $job=(new StudentEmailJob( $student->email,$student->password, $school->institution_name,$school->logo,))
            // ->delay(Carbon::now()->addSeconds(5));
            // dispatch( $job);
            return  response()->json(["success"=>"true"]);
        }
            catch (\Exception $e) {
            DB::rollback();  

            }
    

    }
    public function storeAd(Request $request ,$id)
    {

        // return  response()->json(["success"=> $request->file('file')]);

        $input = $request->only(
            'country','state','city','service','tag',
            'category','title','description','email',
            'phone','age','images'
            
      );   
  
        // return  response()->json(["success"=> $request->file('file')]);

    

      $validator = Validator::make($input, [
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'service' => 'required',
        'category' => 'required',
        'title' => 'required',
        'description' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'age' => 'required',
        'images' => 'required',
        'tag' => 'required',

        
    ]);

    if($validator->fails()){
        return response()->json(["error"=>'fails']);

    }
    
    $input['images']  = $request->file('file')->store('products');


        try {
            DB::beginTransaction();
            $account=Account::find($id);
            
            $post = Post::create($input); // eloquent creation of data
            $account->posts()->save($post);
            $post->save();
            
            if (!$post) {
                return response()->json(["error"=>"didnt work"],422);
            } 
            // $response = Http::post('http://127.0.0.1:8000/v1/event', [
            //     "email"=>$student->email
                
            // ]);
            if($request->totalBill)
            {
            $account->credit=$account->credit-$request->totalBill ;
            $account->save();
             }
            DB::commit();   
            // $job=(new StudentEmailJob( $student->email,$student->password, $school->institution_name,$school->logo,))
            // ->delay(Carbon::now()->addSeconds(5));
            // dispatch( $job);
            return  response()->json(["success"=>"true"]);
        }
            catch (\Exception $e) {
            DB::rollback();  

            }
    

    }
    public function storeMultiple(Request $request ,$id)
    {

        // return  response()->json(["success"=> $request->file('file')]);

        $input = $request->only(
            'country','state','city','service','tag',
            'category','title','description','email',
            'phone','age','images'
            
      );   
  
        // return  response()->json(["success"=> $request->file('file')]);

    

      $validator = Validator::make($input, [
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'service' => 'required',
        'category' => 'required',
        'title' => 'required',
        'description' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'age' => 'required',
        'images' => 'required',
        'tag' => 'required',

        
    ]);

    if($validator->fails()){
        return response()->json(["error"=>'fails']);

    }
    


        try {
            DB::beginTransaction();

            foreach ($request->city as $city) {
                $input['city']=$city;
                $account=Account::find($id);
            
                $post = Post::create($input); 
                $account->posts()->save($post);
                $post->save();
                if (!$post) {
                    return response()->json(["error"=>"didnt work"],422);
                } 
              
            }
           
            
            
            
            // $response = Http::post('http://127.0.0.1:8000/v1/event', [
            //     "email"=>$student->email
                
            // ]);
            // if($request->totalBill)
            // {
            // $account->credit=$account->credit-$request->totalBill ;
            // $account->save();
            //  }
            DB::commit();   
            // $job=(new StudentEmailJob( $student->email,$student->password, $school->institution_name,$school->logo,))
            // ->delay(Carbon::now()->addSeconds(5));
            // dispatch( $job);
            return  response()->json(["success"=>"Ad posted successfullyy"]);
        }
            catch (\Exception $e) {
            DB::rollback();  

            }
    

    }
    /**
     * Display the s pecified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
