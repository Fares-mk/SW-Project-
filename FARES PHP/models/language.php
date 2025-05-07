<?php
require_once '../controllers/DBControllerr.php';

class Language {
    private $id;
    private $user_id;
    private $language_name;
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
        public function getLanguageName() {
                return $this->language_name; 
         }
        public function setId($id) {
                $this->id = $id; 
        }
        public function setUserId($user_id) { 
            $this->user_id = $user_id; 
        }
        public function setLanguageName($language_name) {
                $this->language_name = $language_name; 
        }
    public function save() {
        if ($this->id) {
            $sql = "UPDATE languages SET language_name = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("si", $this->language_name, $this->id);
        } else {
            $sql = "INSERT INTO languages (language_name) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $this->language_name);
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
            $sql = "DELETE FROM languages WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $this->id);
            return $stmt->execute();
        }
        return false;
    }

    public static function findAll() {
        $dbController = new DBController();
        $db = $dbController->getConnection();
        
        $sql = "SELECT * FROM languages";
        $result = $db->query($sql);
        
        $languages = [];
        while ($row = $result->fetch_assoc()) {
            $languages[] = $row;
        }
        
        return $languages;
    }


}
