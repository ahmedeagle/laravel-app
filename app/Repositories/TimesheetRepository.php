<?php
namespace App\Repositories;
use App\Models\Timesheet;

class TimesheetRepository
{
    public function getAllTimesheets()
    {
        return Timesheet::with('user', 'project')->paginate(10);
    }
    public function findTimesheetById($id)
    {
        return Timesheet::with('user', 'project')->findOrFail($id);
    }
    public function createTimesheet(array $data)
    {
        return Timesheet::create($data);
    }
    public function updateTimesheet($id, array $data)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($data);
        return $timesheet;
    }
    public function deleteTimesheet($id)
    {
        return Timesheet::destroy($id);
    }
}