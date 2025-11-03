<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimesheetModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'timesheets'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'project_id',
        'staff_id',
        'entry_date',
        'hours_spent',
        'notes',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_name', 'id');
    }
   /**
     * ✅ Format date when retrieved (e.g., 2025-11-02 → 02-Nov-2025)
     */
    public function getEntryDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

}
