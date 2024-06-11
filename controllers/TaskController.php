<?php
require_once '../config/database.php';
require_once '../models/Task.php';

class TaskController {
    private $db;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
            $this->task->title = $_POST['title'];
            $this->task->description = $_POST['description'];
            $this->task->status = $_POST['status'];

            if ($this->task->create()) {
                header("Location: /task_manager/public/index.php");
            } else {
                echo "Error creating task.";
            }
        }
    }

    public function read() {
        return $this->task->read();
    }

    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
            $this->task->id = $_POST['id'];
            $this->task->title = $_POST['title'];
            $this->task->description = $_POST['description'];
            $this->task->status = $_POST['status'];

            if ($this->task->update()) {
                header("Location: /task_manager/public/index.php");
            } else {
                echo "Error updating task.";
            }
        }
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $this->task->id = $_POST['id'];

            if ($this->task->delete()) {
                header("Location: /task_manager/public/index.php");
            } else {
                echo "Error deleting task.";
            }
        }
    }
}

$controller = new TaskController();
if (isset($_POST['create'])) {
    $controller->create();
}
if (isset($_POST['update'])) {
    $controller->update();
}
if (isset($_POST['delete'])) {
    $controller->delete();
}
?>
