<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Project extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'department', 'start_date', 'end_date', 'status'];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'project_user')->withTimestamps();
    }
    
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
