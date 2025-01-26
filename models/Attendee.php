<?php

class Attendee {
    private $db;
    private $table = 'attendees';

    public function __construct($database) {
        $this->db = $database;
    }

    public function register($event_id, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO attendees (event_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$event_id, $user_id]);
    }

    public function getAttendeeCountByEventId($event_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM attendees WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getAttendeesByEventId($event_id) {
        $stmt = $this->db->prepare("SELECT name, email, registered_at FROM attendees WHERE event_id = ?");
        $stmt->execute([$event_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>