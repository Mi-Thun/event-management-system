<?php

class Event {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEventsWithPagination($limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM events LIMIT ? OFFSET ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalEvents() {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM events");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getAllEvents() {
        $stmt = $this->db->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEvent($name, $description, $date, $max_capacity) {
        $stmt = $this->db->prepare("INSERT INTO events (name, description, date, max_capacity) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $date, $max_capacity]);
    }

    public function getEventById($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, $name, $description, $date, $max_capacity) {
        $stmt = $this->db->prepare("UPDATE events SET name = ?, description = ?, date = ?, max_capacity = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $date, $max_capacity, $id]);
    }

    // public function deleteEvent($id) {
    //     $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
    //     return $stmt->execute([$id]);
    // }

    public function deleteAttendeesByEventId($eventId) {
        $stmt = $this->db->prepare("DELETE FROM attendees WHERE event_id = ?");
        $stmt->execute([$eventId]);
    }
    
    public function deleteEvent($id) {
        // First, delete the associated attendees
        $this->deleteAttendeesByEventId($id);
    
        // Then, delete the event
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function searchEvents($query) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE name LIKE ? OR description LIKE ?");
        $searchQuery = '%' . $query . '%';
        $stmt->execute([$searchQuery, $searchQuery]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>