<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get all users",
 *     tags={"Users"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(response="200", description="List of users"),
 * )
 */
public function index()
{
    return response()->json($this->userRepository->getAllUsers());
}

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
public function store(UserRequest $request)
{
    return response()->json($this->userRepository->createUser($request->validated()), 201);
}
 
    public function show($id)
    {
        return response()->json($this->userRepository->findUserById($id));
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
