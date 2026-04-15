<?php

use PHPUnit\Event\Code\NoTestCaseObjectOnCallStackException;

class TaskController extends Controller
{
    public function indexAction()
    {
        $model = new TaskModel();
        $tasks = $model->getTasks();
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

        if (!$task) {
            header('Location: /');
            exit;
        }

        $this->view->task = $task;
    }

    public function editAction() {}

    public function deleteAction()
    {
        $id = (int) $this->_getParam('id');

        $model = new TaskModel();
        $model->deleteTask($id);

        header('Location: /');
        exit;
    }

    public function completedAction() {}
}
