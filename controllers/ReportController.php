<?php
class ReportController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function downloadAttendeeList($eventId) {
        $attendees = $this->getAttendeesByEvent($eventId);
        $filename = "attendees_event_{$eventId}.csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Name', 'Email', 'Registration Date']);

        foreach ($attendees as $attendee) {
            fputcsv($output, [$attendee['name'], $attendee['email'], $attendee['registration_date']]);
        }

        fclose($output);
        exit();
    }

    private function getAttendeesByEvent($eventId) {
        $stmt = $this->db->prepare("SELECT name, email, registration_date FROM attendees WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>