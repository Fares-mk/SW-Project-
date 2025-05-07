<?php
require_once '../controllers/DBControllerr.php';

class Experience {
    private $id;
    private $user_id;
    private $work_at;
    private $from_year;
    private $to_year;
    private $description;
    private $db;

    public function __construct() {
        $dbController = new DBController();
        $this->db = $dbController->getConnection();
    }
    public function getId() {
         return $this->id;
    }
    public function getUserId() {
         return $this->user_id; 
    }
    public function getWorkAt() {
         return $this->work_at; 
    }
    public function getFromYear() {
         return $this->from_year; 
    }
    public function getToYear() {
         return $this->to_year; 
    }
    public function getDescription() {
         return $this->description; 
    }

    public function setId($id) {
         $this->id = $id; 
        }
    public function setUserId($user_id) {
         $this->user_id = $user_id; 
        }
    public function setWorkAt($work_at) {
         $this->work_at = $work_at; 
        }
    public function setFromYear($from_year) {
         $this->from_year = $from_year; 
        }
    public function setToYear($to_year) {
         $this->to_year = $to_year; 
        }
    public function setDescription($description) {
         $this->description = $description; 
        }

    public function save() {
        try {
            if (empty($this->work_at)) {
                throw new Exception("Work place is required");
            }
            if (empty($this->from_year)) {
                throw new Exception("Start year is required");
            }

            if ($this->id) {
                $sql = "UPDATE experience SET work_at = ?, from_year = ?, to_year = ?, description = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("ssssi", 
                    $this->work_at, 
                    $this->from_year, 
                    $this->to_year,
                    $this->description,
                    $this->id
                );
            } else {
                $sql = "INSERT INTO experience (user_id, work_at, from_year, to_year, description) VALUES (1, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("ssss", 
                    $this->work_at, 
                    $this->from_year, 
                    $this->to_year,
                    $this->description
                );
            }
            
            if ($stmt->execute()) {
                if (!$this->id) {
                    $this->id = $stmt->insert_id;
                }
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("Error in Experience::save(): " . $e->getMessage());
            throw $e;
        }
    }

    public function delete() {
        if ($this->id) {
            $sql = "DELETE FROM experience WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $this->id);
            return $stmt->execute();
        }
        return false;
    }

    public static function findAll() {
        try {
            $dbController = new DBController();
            $db = $dbController->getConnection();
            
            $sql = "SELECT * FROM experience ORDER BY from_year DESC";
            $result = $db->query($sql);
            
            if (!$result) {
                error_log("Error in Experience::findAll(): " . $db->error);
                return [];
            }
            
            $experiences = [];
            while ($row = $result->fetch_assoc()) {
                $experiences[] = $row;
            }
            
            return $experiences;
        } catch (Exception $e) {
            error_log("Error in Experience::findAll(): " . $e->getMessage());
            return [];
        }
    }
}
