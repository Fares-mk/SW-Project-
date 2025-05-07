<?php
require_once '../models/language.php';

class LanguageController {
    public function addLanguage($name) {
        $language = new Language();
        $language->setLanguageName($name);
        return $language->save();
    }


    public function delete($id) {
        $language = new Language();
        $language->setId($id);
        return $language->delete();
    }

    public function getAll() {
        return Language::findAll();
    }
}
?> 