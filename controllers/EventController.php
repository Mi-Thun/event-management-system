<?php
class EventController {
    private $eventModel;

    public function __construct() {
        require_once '../models/Event.php';
        $this->eventModel = new Event();
    }

    public function index() {
        $events = $this->eventModel->getAllEvents();
        require '../views/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $this->eventModel->createEvent($name, $description, $date);
            header('Location: index.php');
        } else {
            require '../views/events/create.php';
        }
    }

    public function edit($id) {
        $event = $this->eventModel->getEventById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $this->eventModel->updateEvent($id, $name, $description, $date);
            header('Location: index.php');
        } else {
            require '../views/events/edit.php';
        }
    }

    public function delete($id) {
        $this->eventModel->deleteEvent($id);
        header('Location: index.php');
    }
}
?>