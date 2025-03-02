<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimesheetResource;
use App\Repositories\TimesheetRepository;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    protected $timesheetRepository;

    public function __construct(TimesheetRepository $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }

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
