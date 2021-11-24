<?php

class Utility {
    static function saveChanges() {
        global $DATA;

        $data_file = fopen('data.txt', 'w');
        fwrite($data_file, serialize($DATA));
        fclose($data_file);
    }

    static function loadData() {
        $data = file_get_contents("./data.txt");
        return unserialize($data);
    }
}