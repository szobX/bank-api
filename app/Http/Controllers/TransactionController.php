<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditCardResource;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transactions::all();
        return response(['data'=>Transactions::collection($transactions)],200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $data = $request->all();



        $validator = Validator::make($data, [
            'type' => 'required',
        ]);


        return response(['creditCard' => new CreditCardResource($creditCardCreated), 'message' => 'Created successfully'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show($accountId,$cardId)
    {
        $creditCard = CreditCard::findorFail($cardId);
        return response(['creditCard' => new CreditCardResource($creditCard), 'message' => 'Credit Cards finded'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
            $account = Account::findOrFail($id);
//            dd($account->creditCards);
        return response(['creditCards' => CreditCardResource::collection($account->creditCards), 'message' => 'Credit Cards successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditCard $creditCard)
    {
        //
        $creditCard->update($request->all());

        return response(['creditCards' => new CreditCardResource($creditCard), 'message' => 'Update successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditCard $creditCard)
    {
        //
    }
}
