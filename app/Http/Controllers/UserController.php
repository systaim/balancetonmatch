<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use Notifiable;

    public function index()
    {
        $users = User::all();
        $role = Auth::user()->role;

        if($role == "super-admin" || $role == "admin"){
            return view('admin.users', compact('users'));
        } else{
            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $role = Auth::user()->role;

        if($role == "super-admin" || $role == "admin"){
            return view('admin.user', compact('user'));
        } else{
            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    /**
     * Add a new user to the store
     * 
     * @OA\Post(
     *     path="/user",
     *     tags={"user"},
     *     operationId="addUser",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     },
     *     requestBody={"$ref": "http://127.0.0.1:8000/components/requestBodies/User"}
     * )
     */
    public function addUser()
    {
    }

    /**
     * Update an existing user
     *
     * @OA\Put(
     *     path="/users",
     *     tags={"user"},
     *     operationId="updateUser",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     },
     *     requestBody={"$ref": "http://127.0.0.1:8000/components/requestBodies/User"}
     * )
     */
    public function updateUser()
    {
    }

    /**
     * @OA\Get(
     *     path="/user/findByStatus",
     *     tags={"user"},
     *     summary="Finds Users by status",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="findUsersByStatus",
     *     deprecated=true,
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum = {"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="http://127.0.0.1:8000/components/schemas/User")
     *         ),
     *         @OA\XmlContent(
     *             type="array",
     *             @OA\Items(ref="http://127.0.0.1:8000/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     }
     * )
     */
    public function findUsersByStatus()
    {
    }

    /**
     * @OA\Get(
     *     path="/user/findByTags",
     *     tags={"user"},
     *     summary="Finds Users by tags",
     *     description="Muliple tags can be provided with comma separated strings. Use tag1, tag2, tag3 for testing.",
     *     operationId="findByTags",
     *     @OA\Parameter(
     *         name="tags",
     *         in="query",
     *         description="Tags to filter by",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="http://127.0.0.1:8000/components/schemas/User")
     *         ),
     *         @OA\XmlContent(
     *             type="array",
     *             @OA\Items(ref="http://127.0.0.1:8000/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     }
     * )
     */
    public function findByTags()
    {
    }

    /**
     * @OA\Get(
     *     path="/users/{userId}",
     *     tags={"user"},
     *     summary="Find user by ID",
     *     description="Returns a single user",
     *     operationId="getUserById",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of user to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="http://127.0.0.1:8000/components/schemas/User"),
     *         @OA\XmlContent(ref="http://127.0.0.1:8000/components/schemas/User"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplier"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     *
     * @param int $id
     */
    public function getUserById($id)
    {
    }

    /**
     * @OA\Post(
     *     path="/user/{userId}",
     *     tags={"user"},
     *     summary="Updates a user in the store with form data",
     *     operationId="updateUserWithForm",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of user that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the user",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     description="Updated status of the user",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function updateUserWithForm()
    {
    }

    /**
     * @OA\Delete(
     *     path="/user/{userId}",
     *     tags={"user"},
     *     summary="Deletes a user",
     *     operationId="deleteUser",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="User id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     *     security={
     *         {"userstore_auth": {"write:users", "read:users"}}
     *     },
     * )
     */
    public function deleteUser()
    {
    }

    /**
     * @OA\Post(
     *     path="/user/{userId}/uploadImage",
     *     tags={"user"},
     *     summary="uploads an image",
     *     operationId="uploadFile",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of user to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="http://127.0.0.1:8000/components/schemas/ApiResponse")
     *     ),
     *     security={
     *         {"userstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     @OA\RequestBody(
     *         description="Upload images request body",
     *         @OA\MediaType(
     *             mediaType="application/octet-stream",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *     )
     * )
     */
    public function uploadFile()
    {
    }

}
