<?php

namespace App\Http\Controllers;

use App\Models\Signup;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use JWTAuth;
use JWTFactory;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignupMail;
use Illuminate\Support\Facades\DB;
// use Egulias\EmailValidator\EmailValidator;
// use Egulias\EmailValidator\Validation\DNSCheckValidation;
// use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
// use Egulias\EmailValidator\Validation\RFCValidation;
class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail($id)

    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(
            'name','email','password'
     );
    

                   

        $validator = Validator::make($input, [
            'name' => 'required',

            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',

            'password' => 'required',

            
        ]);

        if($validator->fails()){
            return response()->json(["error"=>'fails this time'],422);

        }
    //     $validator = new EmailValidator();
    // $multipleValidations = new MultipleValidationWithAnd([
    // new RFCValidation(),
    // new DNSCheckValidation()
    //        ]);
    //      $status=  $validator->isValid($input['email'], $multipleValidations);
    //      if(!$status){
    //         return response()->json(['success'=>false, 'message' => 'Email invalidates'],422);

    //      }

        $matchThese = ['email' => $request->email];
      
        $found_with_email=Signup::where($matchThese)->first();
        if($found_with_email){
            return response()->json(['success'=>false, 'message' => 'Email Exists'],422);
        }

        // $user = Signup::create($input);

        // return  response()->json(["message"=>"Your Account Successfully created"]);

        try {
            DB::beginTransaction();
            
            $user = Signup::create($input); // eloquent creation of data

            
            if (!$user) {
                return response()->json(["error"=>"didnt work"],422);
            } 
            // $response = Http::post('http://127.0.0.1:8000/v1/event', [
            //     "email"=>$student->email
                
            // ]);
            DB::commit();   
            return  response()->json(["message"=>"Your Account Successfully created"]);
        }
            catch (\Exception $e) {
            DB::rollback();   
             
        return response()->json(["error"=> $e],422);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function show(Signup $signup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function edit(Signup $signup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signup $signup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signup $signup)
    {
        //
    }
}
