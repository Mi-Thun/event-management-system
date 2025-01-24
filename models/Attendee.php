<?php

class Attendee {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function register($eventId, $userId) {
        $stmt = $this->db->prepare("INSERT INTO attendees (event_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$eventId, $userId]);
    }

    public function getAttendeesByEvent($eventId) {
        $stmt = $this->db->prepare("SELECT * FROM attendees WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAttendee($id) {
        $stmt = $this->db->prepare("SELECT * FROM attendees WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAttendee($id) {
        $stmt = $this->db->prepare("DELETE FROM attendees WHERE id = ?");
        return $stmt->execute([$id]);
    }
}