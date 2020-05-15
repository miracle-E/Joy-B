<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserResource;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);

        if (!isset($request->name)) {
            return $this->sendError("Name field is required!", [], $code = 400);
        }
        if (!isset($request->email)) {
            return $this->sendError("Email field is required!", [], $code = 400);
        }
        if (!isset($request->password)) {
            return $this->sendError("Password field is required!", [], $code = 400);
        }
        $u = User::where("email", $request->email)->first();
        if ($u) {
            return $this->sendError("Email already signed up!", [], $code = 400);
            return;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->user_type ? $request->user_type : 'user',
            'password' => bcrypt($request->password)
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return $this->sendError("Authentication error", [], $code = 401);
            // return response()->json(["status"=> "error", "message"=> "Authentication error"], 401);
        }

        return (new UserResource($user))
            ->additional([
                'meta' => [
                    "status" => "success",
                    "message" => "User registration successfull",
                    'token' => $token
                ]
            ]);
    }

    public function login(Request $request)
    {
        if (!isset($request->email)) {
            return $this->sendError("Email field is required!", [], $code = 400);
        }
        if (!isset($request->password)) {
            return $this->sendError("Password field is required!", [], $code = 400);
        }

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {

            return $this->sendError("Error verifying details!", null,  $code = 422);
            // return response()->json([
            //     "status"=> "error",
            //     "message"=> "Error verifying details!",
            //     'errors' => [
            //         'email' => ['There is something wrong! We could not verify details']
            //     ]
            // ], 422);
        }
        return (new UserResource($request->user()))
            ->additional([
                "status" => "success",
                "message" => "Login successful",
                'meta' => [
                    'token' => $token
                ]
            ]);
    }

    public function user(Request $request)
    {
        if ($request->user()) {
            $user = User::where('id', '=', $request->user()->id)->with('subscribed_subjects')->first();
            return (new UserResource($user))->additional([
                "status" => "success",
                "message" => "successful"
            ]);
        }
        return $this->sendError("Authentication error", [], $code = 401);
    }

    public function logout()
    {
        auth()->logout();
        return $this->sendResponse(null, "Logout successful");
        // return response()->json(["status" => "successful", "message" => "Logout successful"]);
    }
}
