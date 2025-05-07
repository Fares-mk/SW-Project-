<?php
require_once '../models/experience.php';

class ExperienceController {
    public function addExperience($work_at, $from_year, $to_year, $description) {
        $experience = new Experience();
        $experience->setWorkAt($work_at);
        $experience->setFromYear($from_year);
        $experience->setToYear($to_year);
        $experience->setDescription($description);
        return $experience->save();
    }

    public function delete($id) {
        $experience = new Experience();
        $experience->setId($id);
        return $experience->delete();
    }

    public function getAll() {
        return Experience::findAll();
    }
}
?> 