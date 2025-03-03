<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Laravel API",
 *      version="1.0.0",
 *      description="API Documentation for Laravel 11",
 *      @OA\Contact(
 *          email="ahmed.emam.dev@gmail.com"
 *      )
 * )
 */

/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get all users",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(response="200", description="List of users"),
 * )
 */

/**
 * @OA\Post(
 *     path="/api/users",
 *     summary="Create a new user",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "last_name", "email", "password"},
 *             @OA\Property(property="first_name", type="string"),
 *             @OA\Property(property="last_name", type="string"),
 *             @OA\Property(property="email", type="string", format="email"),
 *             @OA\Property(property="password", type="string", format="password")
 *         )
 *     ),
 *     @OA\Response(response="201", description="User created"),
 * )
 */

/**
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Get a user by ID",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="User details"),
 * )
 */

/**
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Update a user",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "last_name", "email"},
 *             @OA\Property(property="first_name", type="string"),
 *             @OA\Property(property="last_name", type="string"),
 *             @OA\Property(property="email", type="string", format="email"),
 *             @OA\Property(property="password", type="string", format="password")
 *         )
 *     ),
 *     @OA\Response(response="200", description="User updated"),
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/users/{id}",
 *     summary="Delete a user",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="User deleted"),
 * )
 */
class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


public function index(Request $request)
{
    return UserResource::collection($this->userRepository->getAllUsers());
}

public function store(UserRequest $request)
{
    return response()->json($this->userRepository->createUser($request->validated()), 201);
}
 
    public function show($id)
    {
        return new UserResource($this->userRepository->findUserById($id));
    }

    public function update(UserRequest $request, $id)
    {
        return response()->json($this->userRepository->updateUser($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'User deleted'], 200);
    }
}
