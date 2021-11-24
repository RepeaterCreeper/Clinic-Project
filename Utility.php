<?php

class Utility {
    static function saveChanges() {
        global $DATA;

        $data_file = fopen('data.json', 'w');
        fwrite($data_file, json_encode($DATA));
        fclose($data_file);
    }

    static function loadData() {
        $data = file_get_contents("./data.json");
        return json_decode($data);
    }
}