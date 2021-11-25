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

    static function sortByName($patients, $asc = true) {
        usort($patients, function($a,$b) {
            return strcmp($a->getName(), $b->getName());
        });

        $out = $asc ? $patients : array_reverse($patients);
        return $out;
    }

    static function sortByTime($patients, $asc = true) {
        usort($patients, function($a, $b) {
            return strcmp($a->getConsultationDetails("time"), $b->getConsultationDetails("time"));
        });

        $out = $asc ? $patients : array_reverse($patients);
        return $out;
    }

    static function sortByConsultation($patients, $asc = true) {
        usort($patients, function($a, $b) {
            return strcmp($a->getConsultationDetails("done"), $b->getConsultationDetails("done"));
        });
        
        $out = $asc ? $patients : array_reverse($patients);
        return $out;
    }
}