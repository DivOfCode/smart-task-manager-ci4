<?php
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'priority', 'status', 'deadline', 'project_id', 'assigned_to', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
