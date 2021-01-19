<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Http\Resources\UserResource;
use App\Models\Account;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response(['data'=>UserResource::collection($users),'message'=>'Retrieved successfully'],200);
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
        //
        $aController = new AddressController();
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email|unique',
            'password' => 'required',
            'first_name'=>'required|max:100',
            'last_name'=>'require|max:100',
            'phone'=>'required',
            'sex'=>'required',
        ]);

        $addressValidator = $aController->validator($data['address']);

//        dd($addressValidator);
        if ($addressValidator->fails()) {
            return response(['error' => $addressValidator->errors()]);
        }

        $addressFromRequest = $data['address'];
        unset($data["address"]);
//        dd($data);
        $validator = Validator::make($data, [
            'email' => 'required|unique:users',
            'first_name'=>'required|max:100',
            'last_name'=>'required|max:100',
            'phone'=>'required',
            'sex'=>'required',
            'birthday'=>'required'
        ]);
//        dd($validator);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
//        dd($validator);

        $address = $aController->saveAddressFromUser($addressFromRequest);
        $data['hash_password'] = Hash::make($data['password']);
//        dd($address->id);
        $userObject = [
            'email'=>$data['email'],
            'password'=>$data['hash_password'],
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'phone'=>$data['phone'],
            'birthday'=>$data['birthday'],
            'sex'=>$data['sex'],
            'address_id'=>$address->id];
        $newUser =User::create($userObject);

        return $newUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $user
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $users = Auth::user();
        return response(new UserResource($users));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
