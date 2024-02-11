<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{

    /**
     * Method to send response
     * @param $data
     * @param $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data, $message, $status = 200) {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    
    /**
     * Method to send error
     * @param $errorData
     * @param $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($errorData, $message, $status = 500) {
        $response = [];
        $response['message'] = $message;
        if(!empty($errorData)) {
            $response['data'] = $errorData;
        }
        return response()->json($response, $status);
    }

    /**
     * Method to login user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation failed', 422);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->sendError([], 'Invalid login credentials', 401);
            }
            
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }

        $user = User::where('email', $credentials['email'])->first();
        $user['role'] = $user->role->name;


        $success = [
            'token' => $token,
            'user' => $user->attributesToArray(),
        ];
        return $this->sendResponse($success, 'User logged in successfully', 200);
    }

    
    /**
     * Method to register user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $input = $request->only('name', 'email', 'password', 'password_confirmation');
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation failed', 422);
        }

        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = 2;

        $user = User::create($input);

        $success['user'] = $user;

        return $this->sendResponse($success, 'User registered successfully', 201);
    }

    /**
     * Method to register users admin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerAdmin(Request $request) {
        $input = $request->only('name', 'email', 'password', 'password_confirmation');
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation failed', 422);
        }

        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = 1;

        $user = User::create($input);

        $success['user'] = $user;

        return $this->sendResponse($success, 'User registered successfully', 201);
    }

    /**
     * Method to logout user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        try {
            $token = $request->bearerToken();
            JWTAuth::invalidate($token);
            return $this->sendResponse([], 'User logged out successfully');
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Method to refresh token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request) {
        try {
            $token = $request->bearerToken();
            $newToken = JWTAuth::refresh($token);
            $user = JWTAuth::setToken($newToken)->toUser();
            $user['role'] = $user->role->name;
            
            return $this->sendResponse([
                'token' => $newToken,
                'user' => $user->attributesToArray()
            ], 'Token refreshed successfully');
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }    
}
