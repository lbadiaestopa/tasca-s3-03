<?php

class TaskModel
{
    private $filePath;

    public function __construct()
    {
        $this->filePath = ROOT_PATH . '/data/tasks.json';
    }

    public function addTask(string $title, string $description, string $status, int $userId): void
    {

        $tasks = $this->readTasks();

        $task = [
            "id" => $this->generateTaskId($tasks),
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

    private function readTasks(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $data = json_decode(file_get_contents($this->filePath), true);

        return $data;
    }

    private function generateTaskId(array $tasks): int
    {
        if (empty($tasks)) {
            return 1;
        }

        return max(array_column($tasks, 'id')) + 1;
    }

    public function getTasks(): array
    {
        return $this->readTasks();
    }

    public function getTaskById(int $id): ?array
    {
        $data = $this->readTasks();

        foreach ($data as $task) {
            if (isset($task['id']) && (int)$task['id'] === $id) {
                return $task;
            }
        }

        return null;
    }
}
