<?php

class TaskModel
{
    private $filePath;

    public function __construct()
    {
        $this->filePath = ROOT_PATH . '/data/tasks.json';
    }

    public function addTask(string $title, string $description, string $user): void
    {

        $tasks = $this->readTasks();

        $task = [
            "id" => $this->generateTaskId($tasks),
            "title" => $title,
            "description" => $description,
            "status" => TaskStatus::PENDING->value,
            "user" => $user,
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

    public function getTasks(?string $status = null): array
    {
        $tasks = $this->readTasks();

        if ($status === null || $status === '') {
            $filtered = array_filter(
                $tasks,
                fn($task) =>
                $task['status'] !== TaskStatus::COMPLETED->value
            );
        } else {
            $filtered = array_filter(
                $tasks,
                fn($task) =>
                $task['status'] === $status
            );
        }

        return array_reverse(array_values($filtered));
    }

    public function getTaskById(int $id): ?array
    {
        $tasks = $this->readTasks();
        $index = $this->findTaskIndexById($tasks, $id);

        return $index !== null ? $tasks[$index] : null;
    }

    public function deleteTask(int $id): void
    {
        $tasks = $this->readTasks();
        $index = $this->findTaskIndexById($tasks, $id);

        if ($index !== null) {
            unset($tasks[$index]);
            $tasks = array_values($tasks);
            $this->writeTasks($tasks);
        }
    }

    public function updateTask(int $id, array $newData): void
    {
        $tasks = $this->readTasks();
        $index = $this->findTaskIndexById($tasks, $id);

        if ($index !== null) {
            $tasks[$index]['title'] = $newData['title'];
            $tasks[$index]['description'] = $newData['description'];
            $this->writeTasks($tasks);
        }
    }

    public function updateStatus(int $id, string $status): void
    {
        $tasks = $this->readTasks();
        $index = $this->findTaskIndexById($tasks, $id);

        if ($index !== null) {
            $tasks[$index]['status'] = $status;
            $this->writeTasks($tasks);
        }
    }

    private function findTaskIndexById(array $tasks, int $id): ?int
    {
        foreach ($tasks as $key => $task) {
            if (isset($task['id']) && (int)$task['id'] === $id) {
                return $key;
            }
        }

        return null;
    }
}
