<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = User::firstOrNew(['email' => $request->email]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);
        $user->save();

        $http = new Client;

        $response = $http->post('http://todoapp.me/oauth/token',[
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => '0EQSnKtvnQgUuPJ3ELBtDUUL9dPTSlSL92f4klqS',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ]
        ]);

        return response(['auth'=>json_decode((string) $response->getBody(),true),'user'=>$user]);
    }
    public function login(Request $request){
        $request->validate([
			'email'=>'required',
			'password'=>'required'
		]);
        $user= User::where('email',$request->email)->first();

        if(!$user)
            return response(['status' => 'error', 'message' => 'User not found']);

        if(Hash::check($request->password, $user->password)){
			$http = new Client;
			$response = $http->post(url('oauth/token'), [
				'form_params' => [
					'grant_type' => 'password',
					'client_id' => '2',
					'client_secret' => '0EQSnKtvnQgUuPJ3ELBtDUUL9dPTSlSL92f4klqS',
					'username' => $request->email,
					'password' => $request->password,
					'scope' => '',
				],
			]);
			return response(['auth' => json_decode((string)$response->getBody(), true), 'user' => $user]);
		
		}else{
			return response(['message'=>'password not match','status'=>'error']);
		}
        
    }
}
