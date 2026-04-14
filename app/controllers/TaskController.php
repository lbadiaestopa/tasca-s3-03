<?php

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
        $model = new TaskModel();

        $id = (int) $this->_getParam('id', 0);

        $task = $model->getTaskById($id);

        $this->view->task = $task;
    }

    public function editAction() {}

    public function deleteAction() {}

    public function completedAction() {}
}
