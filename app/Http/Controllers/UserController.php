<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('auth.role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response([
            'events' =>
            UserResource::collection($users),
            'message' => 'Successful'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // $validator = Validator::make($data, [
        //     'name' => 'required|max:50',
        //     'age' => 'required|max:50',
        //     'job' => 'required|max:50',
        //     'salary' => 'required|50'
        // ]);

        // if($validator->fails()){
        //     return response(['error' => $validator->errors(),
        //     'Validation Error']);
        // }

        $user = User::create($data);

        return response([
            'user' => new
                UserResource($user),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(['user' => new
            UserResource($user), 'message' => 'Success'], 200);
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
        $user->update($request->all());

        return response(['user' => new
            UserResource($user), 'message' => 'Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(['message' => 'User deleted']);
    }
}
