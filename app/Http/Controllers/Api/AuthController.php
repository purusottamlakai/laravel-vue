<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
    * Create user
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);
        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if($user->save()){
            $tokenResult = $user->createToken('auth_token');
            $token = $tokenResult->plainTextToken;
            return  $this->respondWithSuccess([
                'token' =>$token,
                'user' => $user
            ]);
        } else{
            return $this->respondWithFailureMessage('Provide proper details');
        }
    }


    /**
     * Login user and create token
    *
    * @param  [string] email
    * @param  [string] password
    * @param  [boolean] remember_me
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email','password']);
        $rememberMe = request('remember_me');
        if(!Auth::attempt($credentials, $rememberMe)) {
            return $this->respondUnathorized("email or password doesn't match.");
        }

        $user = $request->user();
        $tokenResult = $user->createToken('auth_token');
        $token = $tokenResult->plainTextToken;

        return  $this->respondWithSuccess([
            'token' =>$token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}