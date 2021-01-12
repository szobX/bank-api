<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditCardResource;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
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
    public function store(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $fromAccount = Account::findOrFail($data['from_account_id']);
        $toAccount = Account::findOrFail($data['to_account_id']);

        $currentFromAccount = $fromAccount->setCurrentBalance($data['from_account_id'],$data['amount'],1);
        $currentToAccount = $fromAccount->setCurrentBalance($data['to_account_id'],$data['amount'],0);

        $validator = Validator::make($data, [
            'type' => 'required',
        ]);

            $fromRow =   [
                'transfer_type'=>1,
                'from_account_id'=>$data['from_account_id'],
                'amount'=>$data['amount'],
                'current_balance'=>$currentFromAccount,
                'title'=>$data['title'],
                'transfer_date'=>$data['transfer_date'],
                'to_account_id'=>$data['to_account_id']
            ];

            $toRow = [
                'transfer_type'=>0,
                'from_account_id'=>$data['to_account_id'],
                'amount'=>$data['amount'],
                'current_balance'=>$currentToAccount,
                'title'=>$data['title'],
                'transfer_date'=>$data['transfer_date'],
                'to_account_id'=>$data['from_account_id']
            ];
        $transferFromAccount =  Transactions::create($fromRow);
        $transferFromAccount =  Transactions::create($toRow);

//        $dd($transferFromAccount);
// wykonanie dwóch zapytań w zaloeżności od  typu przelewu

//        return response(['creditCard' => new CreditCardResource($creditCardCreated), 'message' => 'Created successfully'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
//        $creditCard = CreditCard::findorFail($cardId);
//        return response(['creditCard' => new CreditCardResource($creditCard), 'message' => 'Credit Cards finded'], 200);
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
