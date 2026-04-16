<?php

use PHPUnit\Event\Code\NoTestCaseObjectOnCallStackException;

class TaskController extends Controller
{
    public function indexAction()
    {
        $model = new TaskModel();
        $tasks = $model->getTasks();
        $id = (int) $this->_getParam('id');

        $this->view->tasks = $tasks;
    }

    public function createAction() {}

    public function storeAction()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $model = new TaskModel();
        $model->addTask($title, $description, 'pending', 1);

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

        $model = new TaskModel();
        $model->deleteTask($id);

        header('Location: /');
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

        $model = new TaskModel();
        $model->updateStatus($id, $status);
        
        header('Location: /task/edit/' . $id);
        exit;
    }

    public function completedAction() {}
}
