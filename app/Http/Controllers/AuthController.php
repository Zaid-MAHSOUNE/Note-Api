<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequests;
use App\Http\Requests\StoreUserRequests;
use App\Http\Resources\TestResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (StoreUserRequests $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login (LoginUserRequests $request)
    {
        $request->validated($request->all());

        if(!Auth::attempt($request->all()))
        {
            return response(['message' => 'False Credentials'],401);
        }

        $user = User::where('email','=',$request->email)->first();

        $token = $user->createToken('myapptoken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];

    }

    public function test ()
    {
        // return DB::table('users')->where('name','like','%z%')->get();
        //$collection = DB::table('users')->where('name','like','%z%')->get();
        // return TestResource::collection($collection);
        return DB::table('users')
            ->select('name', 'email as user_email')
            ->get();
    }

    public function logout (Request $request)
    {
        Auth::user()->tokens()->delete();

        return Response(['message' => 'Logged Out'],200);
    }
}
