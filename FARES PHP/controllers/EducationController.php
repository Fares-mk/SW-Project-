<?php
require_once '../models/education.php';

class EducationController {
    public function addEducation($studied_at, $field, $start_date, $end_date, $description) {
        $education = new Education();
        $education->setStudiedAt($studied_at);
        $education->setField($field);
        $education->setStartDate($start_date);
        $education->setEndDate($end_date);
        $education->setDescription($description);
        return $education->save();
    }

    public function delete($id) {
        $education = new Education();
        $education->setId($id);
        return $education->delete();
    }

    public function getAll() {
        return Education::findAll();
    }
}
?> 