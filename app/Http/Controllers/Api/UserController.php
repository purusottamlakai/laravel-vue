<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    function __construct(protected User $user)
    {
        
    }
     
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(\App\Http\Resources\UserResource::collection($this->user->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = $this->user->findOrFail($id);
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->respondWithSuccessMessage('User Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
