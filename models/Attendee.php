<?php

class Attendee {
    private $db;
    private $table = 'attendees';

    public function __construct($database) {
        $this->db = $database;
    }

    public function registerAttendee($event_id, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO attendees (event_id, user_id) VALUES (?, ?)");
        $stmt->bind_param($event_id, $user_id);
        return $stmt->execute();
    }

    public function getAttendeeCountByEventId($event_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM attendees WHERE event_id = ?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
}
?>