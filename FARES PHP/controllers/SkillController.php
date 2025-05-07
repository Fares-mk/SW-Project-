<?php
require_once '../models/skill.php';

class SkillController {
    public function addSkill($name) {
        $skill = new Skill();
        $skill->setSkillName($name);
        return $skill->save();
    }

    public function delete($id) {
        $skill = new Skill();
        $skill->setId($id);
        return $skill->delete();
    }

    public function getAll() {
        return Skill::findAll();
    }
}
?> 