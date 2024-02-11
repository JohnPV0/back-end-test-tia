<?php

namespace App\Http\Controllers\Api;

use App\Models\Dog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class DogsController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $dogs = Dog::all();
            $success['dogs'] = $dogs;
            return $this->sendResponse($success, 'Dogs retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|string',
                'stars' => 'required|integer',
                'breed' => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation failed', 422);
            }

            $dog = Dog::create($data);
            $success['dog'] = $dog;
            return $this->sendResponse($dog, 'Dog created successfully', 201);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $dog = Dog::find($id);
            if(!$dog) {
                return $this->sendError([], 'Dog not found', 404);
            }
            $success['dog'] = $dog;
            return $this->sendResponse($success, 'Dog retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|string',
                'stars' => 'required|integer',
                'breed' => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation failed', 422);
            }

            $dog = Dog::find($id);
            if(!$dog) {
                return $this->sendError([], 'Dog not found', 404);
            }

            $dog->update($data);
            $success['dog'] = $dog;
            return $this->sendResponse($success, 'Dog updated successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dog = Dog::find($id);
            if(!$dog) {
                return $this->sendError([], 'Dog not found', 404);
            }
            $dog->delete();
            return $this->sendResponse([], 'Dog deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }
}
