<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

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
            'phone'=>$data['phone'],
            'birthday'=>$data['birthday'],
            'sex'=>$data['sex'],
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'address_id'=>$address->id];

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($userObject);
        $user->markEmailAsVerified();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => new UserResource($user), 'access_token' => $accessToken], 201);

    }


    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken('bankApi')-> accessToken;
            return response(['access_token' => $token, 'message' => 'User has been logged'], 200);
        }
        else{
            return response(['error' =>  'Unauthorised Error'],400);
        }
    }


    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

}
