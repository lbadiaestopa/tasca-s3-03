<?php

class TaskModel extends Model
{
    private $filePath;
    
    public function __construct()
    {
        $this->filePath = ROOT_PATH . '/data/tasks.json';
    }
}