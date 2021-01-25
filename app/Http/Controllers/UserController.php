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
    public function index(Request $request)
    {
        $users = User::withFilters($request);
        return response(['data'=>UserResource::collection($users)],200);
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

        $aController = new AddressController();
        $data = $request->all();

        $addressValidator = $aController->validator($data['address']);

        if ($addressValidator->fails()) {
            return response(['error' => $addressValidator->errors()]);
        }

        $addressFromRequest = $data['address'];
//        unset($data["address"]);
        $validator = Validator::make($data, [
            'email' => 'required|unique:users',
            'firstName'=>'required|max:100',
            'lastName'=>'required|max:100',
            'phone'=>'required',
            'sex'=>'required',
            'birthday'=>'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }


        $address = $aController->saveAddressFromUser($addressFromRequest);

        $userObject = [
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'birthday'=>$data['birthday'],
            'sex'=>$data['sex'],
            'first_name'=>$data['firstName'],
            'last_name'=>$data['lastName'],
            'address_id'=>$address->id];

        $userObject['password'] = Hash::make('test123');
        $user = User::create($userObject);


        return response(['user' => new UserResource($user)], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(new UserResource($user),200);
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
        $data = $request->all();

//        $user->update($request->all);

        $aController = new AddressController();
        $addressFromRequest = $data['address'];
        unset($data['address']);
        return response([new UserResource(($user))]);
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
        $user->delete();
        return response(['message' => 'User has been delete']);
    }
}
