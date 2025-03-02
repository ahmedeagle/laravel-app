<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        return ProjectResource::collection($this->projectRepository->getAllProjects());
    }

    public function show($id)
    {
        return new ProjectResource($this->projectRepository->findProjectById($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,completed,pending',
        ]);

        return new ProjectResource($this->projectRepository->createProject($validated));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'department' => 'string|max:255',
            'start_date' => 'date',
            'end_date' => 'nullable|date',
            'status' => 'in:active,completed,pending',
        ]);

        return new ProjectResource($this->projectRepository->updateProject($id, $validated));
    }

    public function destroy($id)
    {
        $this->projectRepository->deleteProject($id);
        return response()->json(['message' => 'Project deleted successfully'], 200);
    }
}
