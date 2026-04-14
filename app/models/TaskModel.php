<?php

class TaskModel
{
    private $filePath;

    public function __construct()
    {
        $this->filePath = ROOT_PATH . '/data/tasks.json';
    }

    // Canviar string per enum a $status
    public function addTask(string $title, string $description, string $status, int $userId): void
    {
        $task = [
            "id" => 1, //canviar per paràmetre
            "title" => $title,
            "description" => $description,
            "status" => 'pending',
            "userId" => 1, //canviar per paràmetre
            "createdAt" => (new DateTime())->format('Y-m-d H:i:s'),
            "finishedAt" => null
        ];

        $tasks[] = $task;

        $this->writeTasks($tasks);
    }

    private function writeTasks(array $tasks): void
    {
        file_put_contents(
            $this->filePath, 
            json_encode($tasks, JSON_PRETTY_PRINT)
        );
    }
}
