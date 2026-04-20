<?php

class TaskController extends Controller
{

    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function indexAction()
    {
        $status = $this->_getParam('status');

        $tasks = $this->taskModel->getTasks($status);

        $this->view->tasks = $tasks;
    }

    public function createAction() {}

    public function storeAction()
    {
        $title = $this->_getParam('title');
        $description = $this->_getParam('description');
        $user = $this->_getParam('user');

        $this->taskModel->addTask($title, $description, $user);

        header('Location: /');
        exit;
    }

    private function loadTask(): array
    {
        $id = (int) $this->_getParam('id');
        return $this->taskModel->getTaskById($id);
    }

    public function detailAction()
    {
        $this->view->task = $this->loadTask();
    }

    public function editAction()
    {
        $this->view->task = $this->loadTask();
    }

    public function deleteAction()
    {
        $id = (int) $this->_getParam('id');
        $redirect = $this->_getParam('redirect');

        $this->taskModel->deleteTask($id);

        header('Location: ' . $redirect);
        exit;
    }

    public function updateAction()
    {
        $id = (int) $this->_getParam('id');
        $newData = $_POST;

        $this->taskModel->updateTask($id, $newData);

        header('Location: /task/' . $id);
        exit;
    }

    public function statusAction()
    {
        $id = (int) $this->_getParam('id');
        $status = $this->_getParam('status');
        $redirect = $this->_getParam('redirect');

        $this->taskModel->updateStatus($id, $status);

        header('Location: ' . $redirect);
        exit;
    }

    public function completedAction()
    {
        $tasks = $this->taskModel->getTasks(TaskStatus::COMPLETED->value);

        $this->view->tasks = $tasks;
    }
}
