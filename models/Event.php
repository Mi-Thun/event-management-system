<?php

class Event {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function create($name, $description, $date) {
        $stmt = $this->db->prepare("INSERT INTO events (name, description, date) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $date]);
    }

    public function update($id, $name, $description, $date) {
        $stmt = $this->db->prepare("UPDATE events SET name = ?, description = ?, date = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $date, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}