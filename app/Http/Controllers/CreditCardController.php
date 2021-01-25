<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditCardResource;
use App\Models\Account;
use App\Models\CreditCard;
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
        $creditCards = CreditCard::all();
        return response(['data'=>CreditCardResource::collection($creditCards)],200);
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
//        dd($data['type']);
        $creditCard = new CreditCard;
//          'type'=>$this->faker->creditCardType,
//            'number'=>$this->faker->numerify("####-####-####-####"),
//            'exp_date'=>$this->faker->creditCardExpirationDateString,
//            'cvv'=>$this->faker->numberBetween(100,999),
//            'account_id'=>\App\Models\Account::all()->random()->id,
//            'active'=>$this->faker->boolean,
//            'limit_per_day'=>$this->faker->randomFloat(0,0,10000),
        $validator = Validator::make($data, [
            'type' => 'required',
        ]);


        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $today = Carbon::now();
//        dd($today);
//        $date = Carbon::createFromFormat('Y-m-d H',$today->toDayDateTimeString());
        $exp_date = $today->addYears(2)->rawFormat('m/y');
        $cvv=$creditCard->generateCvv();
//        dd($cvv);
        $number = $creditCard->generateNumber();
        $row = [
            'type'=> $data['type'],
            'number'=>$number,
            'exp_date'=>$exp_date,
            'cvv'=>$cvv,
            'account_id'=>$id,
            'active'=>false,
            'limit_per_day'=>1000.00,
        ];
$creditCardCreated =  CreditCard::create($row);
//        $creditCard = CreditCard::create($data);

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
    public function showAll($id, Request $request)
    {
            $creditCards = CreditCard::withFilters($id,$request);
//            $account = Account::findOrFail($id);
//            dd($account->creditCards);
        return response(['data' => CreditCardResource::collection($creditCards)], 200);

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
