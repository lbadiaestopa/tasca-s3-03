<?php

use PHPUnit\Event\Code\NoTestCaseObjectOnCallStackException;

class TaskController extends Controller
{
    public function indexAction()
    {
        $id = (int) $this->_getParam('id');
        $status = $_GET['status'] ?? null;

        $model = new TaskModel();
        $tasks = $model->getTasks($status);

        $this->view->tasks = $tasks;
        $this->view->status = $status; // Em sembla que es pot esborrar
    }

    public function createAction() {}

    public function storeAction()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $user = $_POST['user'];

        $model = new TaskModel();
        $model->addTask($title, $description, $user);

        header('Location: /');
        exit;
    }

    public function detailAction()
    {
        $id = (int) $this->_getParam('id');

        $model = new TaskModel();
        $task = $model->getTaskById($id);

        $this->view->task = $task;
    }

    public function editAction() 
    {
        $id = (int) $this->_getParam('id');

        $model = new TaskModel();
        $task = $model->getTaskById($id);


        $this->view->task = $task;
    }

    public function deleteAction()
    {
        $id = (int) $this->_getParam('id');
        $redirect = $_POST['redirect'] ?? '/';

        $model = new TaskModel();
        $model->deleteTask($id);

        header('Location: ' . $redirect);
        exit;
    }

    public function updateAction()
    {
        $id = (int) $this->_getParam('id');
        $newData = $_POST;

        $model = new TaskModel();
        $model->updateTask($id, $newData);

        header('Location: /task/' . $id);
        exit;
    }

    public function statusAction()
    {
        $id = (int) $_POST['id'];
        $status = $_POST['status'];
        $redirect = $_POST['redirect'] ?? '/';

        $model = new TaskModel();
        $model->updateStatus($id, $status);
        
        header('Location: ' . $redirect);
        exit;
    }

    public function completedAction() 
    {
        $id = (int) $this->_getParam('id');
        $status = $_GET['status'] ?? null;

        $model = new TaskModel();
        $tasks = $model->getTasks(TaskStatus::COMPLETED->value);

        $this->view->tasks = $tasks;
        $this->view->status = $status; // Em sembla que es pot esborrar
    }
}
