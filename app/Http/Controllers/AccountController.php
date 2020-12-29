<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Models\CreditCard;
use Illuminate\Http\Request;

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
        return response(['data'=>AccountResource::collection($accounts),'message'=>'Retrieved successfully'],200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
//        $account = Account::find($id);

        return response(['data'=> new AccountResource($account),'message'=>'account finded','bank'=>$account->bank,'creditCards'=>$account->creditCards],200);

//            return response()->json([
//                "success"=>true,
//                "message"=>"Account finded",
//                "data"=>$account,
//                "creditCards"=>$account->creditCards,
//                "bank"=>$account->bank
//            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
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
