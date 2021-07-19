<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'creator_id',
        'color',
    ];
    public $timestamps = false;
}
