<?php

class TaskModel
{
    private $filePath;
    
    public function __construct()
    {
        $this->filePath = ROOT_PATH . '/data/tasks.json';
    }
}