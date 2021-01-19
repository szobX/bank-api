<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        return response(['data'=>AccountResource::collection($accounts)],200);
//        return response()->json([
//            "success"=>true,
//            "message"=>"Account list",
//            "data"=>$accounts
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        //
//        $input = $request->all();
//        $account = Account::create($input);
//        return response()->json([
//            "success"=>true,
//            "message"=>"Account created",
//            "data"=>$account
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $data = $request->all();
        $validator = Validator::make($data, [
            'bank_id' => 'required',
            'account_name'=>'required|max:100',
        ]);


        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
//        dd($data);
            $account = new Account();

            $accountNumber = $account->generateNumber($data['bank_id']);
            $accountObject = [
                'account_name'=>$data['account_name'],
                'account_number'=>$accountNumber,
                'user_id'=>Auth::user()->id,
                'bank_id'=>$data['bank_id'],
            ];

//            dd($accountObject);
        $newAcc =Account::create($accountObject);
        return response(new AccountResource($newAcc),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $user = Auth::user()->id;

        if($user != $account->user_id){
            return response(['error'=>'unautorization'],401);
        }else{
            return response(new AccountResource($account),200);
        }
        // alternative method
//        if (() !== null) {
//            // Here you have your authenticated user model
//
//        }

        // return general data
//        return response('Unauthenticated user');


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
        $account->delete();
        return response(['message' => 'Account has been delete']);
    }
}
