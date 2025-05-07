<?php
require_once '../controllers/DBControllerr.php';

class Education {
    private $id;
    private $studied_at;
    private $field;
    private $start_date;
    private $end_date;
    private $description;
    private $db;

    public function __construct() {
        $dbController = new DBController();
        $this->db = $dbController->getConnection();
    }

    public function getId() { 
        return $this->id; 
    }
    public function getStudiedAt() {
         return $this->studied_at; 
        }
    public function getField() { 
        return $this->field; 
    }
    public function getStartDate() {
         return $this->start_date; 
        }
    public function getEndDate() {
         return $this->end_date; 
        }
    public function getDescription() {
         return $this->description; 
        }

    public function setId($id) {
         $this->id = $id; 
        }
    public function setStudiedAt($studied_at) { 
        if (empty($studied_at)) {
            throw new Exception("Studied at cannot be empty");
        }
        $this->studied_at = $studied_at; 
    }
    public function setField($field) { 
        if (empty($field)) {
            throw new Exception("Field cannot be empty");
        }
        $this->field = $field; 
    }
    public function setStartDate($start_date) { 
        if (empty($start_date)) {
            throw new Exception("Start date cannot be empty");
        }
        $this->start_date = $start_date; 
    }
    public function setEndDate($end_date) {
         $this->end_date = $end_date; 
        }
    public function setDescription($description) {
         $this->description = $description;
         }

    public function save() {
        try {
            if (empty($this->studied_at)) {
                throw new Exception("Studied at is required");
            }
            if (empty($this->field)) {
                throw new Exception("Field is required");
            }
            if (empty($this->start_date)) {
                throw new Exception("Start date is required");
            }

            if ($this->id) {
                $sql = "UPDATE education SET studied_at = ?, field = ?, start_date = ?, end_date = ?, description = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error preparing update statement: " . $this->db->error);
                }
                $stmt->bind_param("sssssi", 
                    $this->studied_at, 
                    $this->field, 
                    $this->start_date, 
                    $this->end_date, 
                    $this->description, 
                    $this->id
                );
            } else {
                $sql = "INSERT INTO education (studied_at, field, start_date, end_date, description) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error preparing insert statement: " . $this->db->error);
                }
                $stmt->bind_param("sssss", 
                    $this->studied_at, 
                    $this->field, 
                    $this->start_date, 
                    $this->end_date, 
                    $this->description
                );
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            if (!$this->id) {
                $this->id = $stmt->insert_id;
            }
            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log("Error in Education::save(): " . $e->getMessage());
            throw $e;
        }
    }

    public function delete() {
        try {
            if ($this->id) {
                $sql = "DELETE FROM education WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error preparing delete statement: " . $this->db->error);
                }
                $stmt->bind_param("i", $this->id);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            }
            return false;
        } catch (Exception $e) {
            error_log("Error in Education::delete(): " . $e->getMessage());
            throw $e;
        }
    }

    public static function findAll() {
        try {
            $dbController = new DBController();
            $db = $dbController->getConnection();
            
            $sql = "SELECT * FROM education ORDER BY start_date DESC";
            $result = $db->query($sql);
            if (!$result) {
                throw new Exception("Error executing findAll query: " . $db->error);
            }
            
            $educations = [];
            while ($row = $result->fetch_assoc()) {
                $educations[] = $row;
            }
            
            return $educations;
        } catch (Exception $e) {
            error_log("Error in Education::findAll(): " . $e->getMessage());
            throw $e;
        }
    }
}
