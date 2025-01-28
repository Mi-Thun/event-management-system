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

    // public function index() {
    //     $events = $this->eventModel->getAllEvents();
    //     require __DIR__ . '/../views/events/list.php';
    // }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;
    
        $events = $this->eventModel->getEventsWithPagination($limit, $offset);
        $totalEvents = $this->eventModel->getTotalEvents();
        $totalPages = ceil($totalEvents / $limit);
    
        require __DIR__ . '/../views/events/list.php';
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
            $event_id = $_POST['event_id'];
            $user_id = 2;
            $this->attendeeModel->register($event_id, $user_id);
            $events = $this->eventModel->getAllEvents();
            header('Location: /event-management-system/');
            exit();
        } else {
            $events_drop = $this->eventModel->getAllEvents();
            require __DIR__ .  '/../views/attendees/registration.php';
        }
    }

    public function downloadReport($event_id) {
        $attendees = $this->attendeeModel->getAttendeesByEventId($event_id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=attendees_report.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Event ID', 'User Name', 'Email', 'Registered At', 'Seat Booked']);

        foreach ($attendees as $attendee) {
            fputcsv($output, [$event_id, $attendee['name'], $attendee['email'], $attendee['registered_at']]);
        }

        fclose($output);
        exit();
    }

    // public function viewEvent($id) {
    //     $event = $this->eventModel->getEventById($id);
    //     $attendees = $this->attendeeModel->getAttendeesByEventId($id);
    //     require __DIR__ . '/../views/events/view.php';
    // }

    public function viewEvent($id) {
        $event = $this->eventModel->getEventById($id);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5; 
        $offset = ($page - 1) * $limit;
        $attendees = $this->attendeeModel->getPaginatedAttendeesByEventId($id, $limit, $offset);
        $totalAttendees = $this->attendeeModel->getTotalAttendeesByEventId($id);
        $totalPages = ceil($totalAttendees / $limit);
        require __DIR__ . '/../views/events/view.php';
    }

    public function search() {
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $events = $this->eventModel->searchEvents($query);
        echo json_encode($events);
    }

    // public function searchAttendees() {
    //     $eventId = isset($_GET['eventId']) ? (int)$_GET['eventId'] : 0;
    //     $query = isset($_GET['query']) ? $_GET['query'] : '';
    //     $attendees = $this->attendeeModel->searchAttendeesByName($eventId, $query);
    //     echo json_encode($attendees);
    // }
    // public function searchAttendees() {
    //     $eventId = isset($_GET['eventId']) ? (int)$_GET['eventId'] : 0;
    //     $query = isset($_GET['query']) ? $_GET['query'] : '';
    //     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //     $limit = 5; // Number of attendees per page
    //     $offset = ($page - 1) * $limit;
    
    //     $attendees = $this->attendeeModel->searchAttendeesByName($eventId, $query, $limit, $offset);
    //     $totalAttendees = $this->attendeeModel->getTotalSearchAttendees($eventId, $query);
    //     $totalPages = ceil($totalAttendees / $limit);
    
    //     echo json_encode([
    //         'attendees' => $attendees,
    //         'totalPages' => $totalPages,
    //         'currentPage' => $page
    //     ]);
    // }

    public function searchAttendees() {
        $eventId = isset($_GET['eventId']) ? (int)$_GET['eventId'] : 0;
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $attendees = $this->attendeeModel->searchAttendeesByName($eventId, $query);
        echo json_encode($attendees);
    }
}
?>