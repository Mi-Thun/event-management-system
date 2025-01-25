<?php
class EventController {
    private $eventModel;
    private $attendeeModel;

    public function __construct($db) {
        require_once __DIR__ . '/../models/Event.php';
        require_once __DIR__ . '/../models/Attendee.php';
        $this->eventModel = new Event($db);
        $this->attendeeModel = new Attendee($db);
    }

    public function index() {
        $events = $this->eventModel->getAllEvents();
        require __DIR__ . '/../views/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $max_capacity = $_POST['max_capacity'];
            $this->eventModel->createEvent($name, $description, $date, $max_capacity);
            header('Location: /event-management-system/');
            exit();
        } else {
            require __DIR__ . '/../views/events/create.php';
        }
    }

    public function edit($id) {
        $event = $this->eventModel->getEventById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $max_capacity = $_POST['max_capacity'];
            $this->eventModel->updateEvent($id, $name, $description, $date, $max_capacity);
            header('Location: /event-management-system/');
        } else {
            require __DIR__ . '/../views/events/edit.php';
        }  
    }

    public function delete($id) {
        $this->eventModel->deleteEvent($id);
        header('Location: /event-management-system/');
    }

    public function registerAttendee() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['event_name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $max_capacity = $_POST['max_capacity'];
            $events = $this->eventModel->getAllEvents();
            $this->eventModel->createEvent($name, $description, $date, $max_capacity);
            header('Location: /event-management-system/');
            exit();
        } else {
            require __DIR__ .  '/../views/attendees/register.php';
        }
    }

    public function getAttendeeList($event_id) {
        return $this->attendeeModel->getAttendeesByEventId($event_id);
    }
}

// require_once __DIR__ . '/../config/config.php';
// $db = (new DatabaseConnection())->connect();
// $controller = new EventController($db);

// if (isset($_GET['action'])) {
//     $action = $_GET['action'];
//     $id = isset($_GET['id']) ? $_GET['id'] : null;

//     switch ($action) {
//         case 'index':
//             $controller->index();
//             break;
//         case 'create':
//             $controller->create();
//             break;
//         case 'edit':
//             if ($id !== null) {
//                 $controller->edit($id);
//             }
//             break;
//         case 'delete':
//             if ($id !== null) {
//                 $controller->delete($id);
//             }
//             break;
//         default:
//             header('Location: index.php?action=index');
//             break;
//     }
// }
?>