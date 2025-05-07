<?php
require_once '../controllers/DBControllerr.php';

class Skill {
    private $id;
    private $user_id;
    private $skill_name;
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
   public function getSkillName() {
        return $this->skill_name;
    }
   public function setId($id) {
        $this->id = $id; 
    }
   public function setUserId($user_id) {
        $this->user_id = $user_id; 
    }
   public function setSkillName($skill_name) { 
       $this->skill_name = $skill_name; 
   }
    public function save() {
        if ($this->id) {
            $sql = "UPDATE skills SET skill_name = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("si", $this->skill_name, $this->id);
        } else {
            $sql = "INSERT INTO skills (skill_name) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $this->skill_name);
        }
        
        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $stmt->insert_id;
            }
            return true;
        }
        return false;
    }

    public function delete() {
        if ($this->id) {
            $sql = "DELETE FROM skills WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $this->id);
            return $stmt->execute();
        }
        return false;
    }

    public static function findAll() {
        $dbController = new DBController();
        $db = $dbController->getConnection();
        
        $sql = "SELECT * FROM skills";
        $result = $db->query($sql);
        
        $skills = [];
        while ($row = $result->fetch_assoc()) {
            $skills[] = $row;
        }
        
        return $skills;
    }

}
