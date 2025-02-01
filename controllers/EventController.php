<?php
class EventController
{
    private $eventModel;
    private $attendeeModel;
    private $userModel;

    public function __construct($db)
    {
        require_once __DIR__ . '/../models/Event.php';
        require_once __DIR__ . '/../models/Attendee.php';
        require_once __DIR__ . '/../models/User.php';
        $this->eventModel = new Event($db);
        $this->attendeeModel = new Attendee($db);
        $this->userModel = new User($db);
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $events = $this->eventModel->getEventsWithPagination($limit, $offset);

        $totalEvents = $this->eventModel->getTotalEvents();
        $totalPages = ceil($totalEvents / $limit);

        require __DIR__ . '/../views/events/list.php';
    }

    public function create()
    {
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

    public function edit($id)
    {
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

    public function delete($id)
    {
        $this->eventModel->deleteEvent($id);
        header('Location: /event-management-system/');
    }

    public function registerAttendee()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event_id = $_POST['event_id'];
            $user_id = $_POST['user_id'];
            $seats = $_POST['seats'];
            $event = $this->eventModel->getEventById($event_id);
            $this->attendeeModel->register($event_id, $user_id, $seats);
            header('Location: /event-management-system/');
            exit();
        } else {
            $events_drop = $this->eventModel->getAllEvents();
            require __DIR__ . '/../views/attendees/registration.php';
        }
    }

    public function downloadReport($event_id)
    {
        $attendees = $this->attendeeModel->getAttendeesByEventId($event_id);
        $event = $this->eventModel->getEventById($event_id);
        $totalRegisteredSeats = $this->attendeeModel->getTotalAttendeesByEventId($event_id);
        $remainingSeats = $event['max_capacity'] - $totalRegisteredSeats;

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=attendees_report.csv');

        $output = fopen('php://output', 'w');

        // Add event details
        fputcsv($output, ['Event Report:']);
        fputcsv($output, ['Event Name:', $event['name']]);
        fputcsv($output, ['Description:', $event['description'], ''], );
        fputcsv($output, ['Date:', $event['date']]);
        fputcsv($output, ['Max Capacity:', $event['max_capacity']]);
        fputcsv($output, ['Total Registered Seats:', $totalRegisteredSeats]);
        fputcsv($output, ['Remaining Seats:', $remainingSeats]);


        fputcsv($output, []);
        fputcsv($output, ['Event Name', 'User ID', 'Email', 'Registered At', 'Seat Booked']);

        foreach ($attendees as $attendee) {
            $user = $this->userModel->getUserById($attendee['user_id']);
            fputcsv($output, [$event['name'], $user['username'], $user['email'], $attendee['registered_at'], $attendee['seats']]);
        }
        fputcsv($output, []);

        fputcsv($output, ['* This is a system-generated report.']);
        fclose($output);
        exit();
    }


    public function viewEvent($id)
    {
        $event = $this->eventModel->getEventById($id);
        $totalRegisteredSeats = $this->attendeeModel->getTotalAttendeesByEventId($id);
        $remainingSeats = $event['max_capacity'] - $totalRegisteredSeats;
        require __DIR__ . '/../views/events/view.php';
    }

    public function search()
    {
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $events = $this->eventModel->searchEvents($query);
        echo json_encode($events);
    }

    public function searchAttendees()
    {
        $eventId = isset($_GET['eventId']) ? (int) $_GET['eventId'] : 0;
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $attendees = $this->attendeeModel->searchAttendeesByName($eventId, $query, $limit, $offset);
        $totalAttendees = $this->attendeeModel->getTotalSearchAttendees($eventId, $query);
        $totalPages = ceil($totalAttendees / $limit);

        echo json_encode([
            'attendees' => $attendees,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function getRegisteredSeats()
    {
        if (isset($_GET['event_id'])) {
            $event_id = (int) $_GET['event_id'];
            $totalSeats = $this->attendeeModel->getTotalAttendeesByEventId($event_id);
            $event = $this->eventModel->getEventById($event_id);
            $remainingSeats = $event['max_capacity'] - $totalSeats;
            echo json_encode(['totalSeats' => $totalSeats, 'remainingSeats' => $remainingSeats]);
        }
    }
}
?>