<?php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAllProjects()
    {
        return Project::with('users', 'timesheets')->paginate(10);
    }
    public function findProjectById($id)
    {
        return Project::with('users', 'timesheets')->findOrFail($id);
    }
    public function createProject(array $data)
    {
        return Project::create($data);
    }
    public function updateProject($id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }
    public function deleteProject($id)
    {
        return Project::destroy($id);
    }
}