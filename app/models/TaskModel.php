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
            "status" => TaskStatus::PENDING->value,
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

    private function readTasks(): ?array
    {
        if (!file_exists($this->filePath)) {
            return null;
        }

        $data = json_decode(
            file_get_contents($this->filePath),
             true
        );

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

    public function deleteTask(int $id): void 
    {
        $data = $this->readTasks();

        foreach ($data as $key => $task) {
            if (isset($task['id']) && (int)$task['id'] === $id) {
                unset($data[$key]);
            }
        }

        $data = array_values($data);
        $this->writeTasks($data);
    }

    public function updateTask(int $id, array $newData): void 
    {
        $data = $this->readTasks();

        foreach ($data as $key => $task) {
            if (isset($task['id']) && (int)$task['id'] === $id) {
                $data[$key]['title'] = $newData['title'];
                $data[$key]['description'] = $newData['description'];
                break;
            }
        }

        $this->writeTasks($data);
    }

    public function updateStatus(int $id, string $status): void 
    {
        $tasks = $this->readTasks();

        foreach ($tasks as $key => $task) {
            if (isset($task['id']) && (int)$task['id'] === $id) {
                $tasks[$key]['status'] = $status;
                break;
            }
        }

        $this->writeTasks($tasks);
    }

    public function getStatusColor(string $status) 
    {
        $colors = [
            TaskStatus::PENDING->value => 'bg-pending text-white',
            TaskStatus::PROGRESS->value => 'bg-progress',
            TaskStatus::COMPLETED->value => 'bg-primary',
        ];

        return $colors[$status];
    }
}
