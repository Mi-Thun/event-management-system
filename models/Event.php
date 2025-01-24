<?php

class Event {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEvents() {
        $stmt = $this->db->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEvent($name, $description, $date) {
        $stmt = $this->db->prepare("INSERT INTO events (name, description, date) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $date]);
    }

    public function getEventById($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, $name, $description, $date) {
        $stmt = $this->db->prepare("UPDATE events SET name = ?, description = ?, date = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $date, $id]);
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>