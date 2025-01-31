<?php

class Attendee {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function register($event_id, $user_id, $seats) {
        $stmt = $this->db->prepare("INSERT INTO attendees (event_id, user_id, seats) VALUES (?, ?, ?)");
        return $stmt->execute([$event_id, $user_id, $seats]);
    }

    public function getAttendeeCountByEventId($event_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM attendees WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getAttendeesByEventId($event_id) {
        $stmt = $this->db->prepare("SELECT * FROM attendees WHERE event_id = ?");
        $stmt->execute([$event_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedAttendeesByEventId($eventId, $limit, $offset) {
        $stmt = $this->db->prepare("
            SELECT attendees.*, users.username, users.email 
            FROM attendees 
            JOIN users ON attendees.user_id = users.id 
            WHERE attendees.event_id = :event_id 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalAttendeesByEventId($eventId) {
        $stmt = $this->db->prepare("SELECT SUM(seats) FROM attendees WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetchColumn();
    }

    public function searchAttendeesByName($eventId, $query, $limit, $offset) {
        $stmt = $this->db->prepare("
            SELECT attendees.*, users.username, users.email 
            FROM attendees 
            JOIN users ON attendees.user_id = users.id 
            WHERE attendees.event_id = :event_id AND (users.username LIKE :query)
            LIMIT :limit OFFSET :offset
        ");
        $searchQuery = '%' . $query . '%';
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->bindParam(':query', $searchQuery, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalSearchAttendees($eventId, $query) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) 
            FROM attendees 
            JOIN users ON attendees.user_id = users.id 
            WHERE attendees.event_id = :event_id AND (users.username LIKE :query OR users.email LIKE :query)
        ");
        $searchQuery = '%' . $query . '%';
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->bindParam(':query', $searchQuery, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
?>