<?php
class EventController {
    private $eventModel;

    public function __construct($db) {
        require_once __DIR__ . '/../models/Event.php';
        $this->eventModel = new Event($db);
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
            $this->eventModel->createEvent($name, $description, $date);
            header('Location: /event-management-system/');
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
            $this->eventModel->updateEvent($id, $name, $description, $date);
            header('Location: /event-management-system/');
        } else {
            require __DIR__ . '/../views/events/edit.php';
        }
    }

    public function delete($id) {
        $this->eventModel->deleteEvent($id);
        header('Location: /event-management-system/');
    }
}

require_once '../config/config.php';
$db = (new DatabaseConnection())->connect();
$controller = new EventController($db);

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