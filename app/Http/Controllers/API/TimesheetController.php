<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimesheetResource;
use App\Repositories\TimesheetRepository;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TimesheetController extends Controller
{
    protected $timesheetRepository;

    public function __construct(TimesheetRepository $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }
    
    /**
     * @OA\Get(
     *     path="/api/timesheets",
     *     summary="Get list of timesheets",
     *     tags={"Timesheets"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Timesheet"))
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/timesheets/{id}",
     *     summary="Get a timesheet by ID",
     *     tags={"Timesheets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timesheet not found"
     *     )
     * )
     */

    /**
     * @OA\Post(
     *     path="/api/timesheets",
     *     summary="Create a new timesheet",
     *     tags={"Timesheets"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"task_name", "date", "hours", "user_id", "project_id"},
     *             @OA\Property(property="task_name", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="hours", type="integer"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="project_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Timesheet created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */

    /**
     * @OA\Put(
     *     path="/api/timesheets/{id}",
     *     summary="Update an existing timesheet",
     *     tags={"Timesheets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="task_name", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="hours", type="integer"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="project_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Timesheet updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Timesheet")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timesheet not found"
     *     )
     * )
     */

    /**
     * @OA\Delete(
     *     path="/api/timesheets/{id}",
     *     summary="Delete a timesheet",
     *     tags={"Timesheets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Timesheet deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timesheet not found"
     *     )
     * )
     */
    public function index()
    {
        return TimesheetResource::collection($this->timesheetRepository->getAllTimesheets());
    }

    public function show($id)
    {
        return new TimesheetResource($this->timesheetRepository->findTimesheetById($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        return new TimesheetResource($this->timesheetRepository->createTimesheet($validated));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'task_name' => 'string|max:255',
            'date' => 'date',
            'hours' => 'integer|min:1',
            'user_id' => 'exists:users,id',
            'project_id' => 'exists:projects,id',
        ]);

        return new TimesheetResource($this->timesheetRepository->updateTimesheet($id, $validated));
    }

    public function destroy($id)
    {
        $this->timesheetRepository->deleteTimesheet($id);
        return response()->json(['message' => 'Timesheet deleted successfully'], 200);
    }
}
