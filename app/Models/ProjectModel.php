<?php
namespace App\Models;
use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'status', 'user_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
