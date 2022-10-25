<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           'email' => 'required',
           'password' => 'required|min:8'
           
       ]);

       if($validator->fails()){
           return response()->json(["error"=>'fails']);

       }
      


       $matchThese = ['email' => $request->email];
       $found_with_email=Account::where($matchThese)->first();


       if($found_with_email){
           return response()->json(['success'=>false, 'message' => 'Email Exists'],422);

       }
      

    //    $ranpass=Str::random(12);
    //    $input['password'] =$ranpass;

       $input['hashedPassword'] = Hash::make($input['password']); 
    //    return  response()->json(["success"=>$input['hashedPassword']]);

       try {
           DB::beginTransaction();
           $user =Account::create($input); // eloquent creation of data
           if (!$user) {
               return response()->json(["error"=>"didnt work"],422);
           }
           // $response = Http::post('http://127.0.0.1:8000/v1/event', [
           //     "email"=>$student->email
               
           // ]);
        //    DB::commit();   
        //    $job=(new StudentEmailJob( $student->email,$student->password, $school->institution_name,$school->logo,))
        //    ->delay(Carbon::now()->addSeconds(5));
        //    dispatch( $job);
           DB::commit();  
        return  response()->json(["success"=>"true"]);
       }
       catch (\Exception $e) {
           DB::rollback();
           return response()->json(["error"=>"process error!"],422);
   }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
       
        $input = $request->only('email', 'password',);
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->json(["error"=>'email or password fails'],422);
    
        }
        $matchThese = ['email' => $request->email];
        $account=Account::where($matchThese)->first();
        if(!$account){
            return response()->json(["error"=>'Email not found'],422);
    
        }
       
           
               // $date1 = Carbon::parse($found->payment_date);
               // $now = Carbon::now();
               // $diff = $date1->diffInDays($now);
               // if($diff >30){
               //     return response()->json(["success"=>$false,"message"=>"you need to pay minthly fee" ]);
               // }
               if (!Hash::check($input['password'], $account->hashedPassword)) {
                   return response()->json(['success'=>false, 'message' => 'Login Fail, please check password'],422);
                }
                // $school=School::where('id','=',$found_admin->school_id)->first();
    
    
                $payload = JWTFactory::sub($account->id)
           // ->myCustomObject($account)
           ->make();
           $token = JWTAuth::encode($payload);
               return response()->json(['success'=>true, 
               'token' => '1'.$token ,
                       
           ]);
    
           
        
     
        
        return response()->json(['success'=>false, 'message' =>"Admin is not in the particular institution"],422);
    
    } 
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
