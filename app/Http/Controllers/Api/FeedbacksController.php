<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class FeedbacksController extends Controller
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
            $feedbacks = Feedback::all();
            $success['feedbacks'] = $feedbacks;
            return $this->sendResponse($success, 'Feedbacks retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required',
                'comment' => 'required',
                'photo' => 'required'
            ]);

            if($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation Error', 400);
            }

            $feedback = Feedback::create($data);
            $success['feedback'] = $feedback;
            return $this->sendResponse($success, 'Feedback created successfully', 201);
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
            $feedback = Feedback::find($id);
            if(!$feedback) {
                return $this->sendError([], 'Feedback not found', 404);
            }
            $success['feedback'] = $feedback;
            return $this->sendResponse($success, 'Feedback retrieved successfully', 200);

        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $feedback = Feedback::find($id);
            if(!$feedback) {
                return $this->sendError([], 'Feedback not found', 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'comment' => 'required',
                'photo' => 'required'
            ]);

            if($validator->fails()) {
                return $this->sendError($validator->errors(), 'Validation Error', 400);
            }

            $feedback->name = $request->name;
            $feedback->comment = $request->comment;
            $feedback->photo = $request->photo;
            $feedback->save();

            $success['feedback'] = $feedback;
            return $this->sendResponse($success, 'Feedback updated successfully', 200);
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
            $feedback = Feedback::find($id);
            if(!$feedback) {
                return $this->sendError([], 'Feedback not found', 404);
            }
            $feedback->delete();
            return $this->sendResponse([], 'Feedback deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
    }
}
