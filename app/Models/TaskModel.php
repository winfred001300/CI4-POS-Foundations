<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    // Use the separate TasksToday database connection.
    protected $DBGroup = 'tasksdb';

    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'description',
        'status',
        'task_date',
        'is_archived',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}