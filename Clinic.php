<?php
/**
 * Each Clinic contains multiple patients.
 */
class Clinic implements JsonSerializable {
    private $name = "";
    private $patients = [];

    public function __construct(String $name) {
        $this->name = $name;
    }

    /**
     * Returns the name of the Clinic instance.
     * 
     * @return String name - Name of the clinic
     */
    public function getClinicName() {
        return $this->name;
    }

    public function getAllPatients() {
        return $this->patients;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function __wakeup(){
        foreach (get_object_vars($this) as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function addPatient(Patient $patient) {
        array_push($this->patients, $patient);
    }

    public function getPatient($id) {
        $i = 0;
        foreach ($this->patients as $patient) {
            if ($patient->getId() == $id) {
                return $this->patients[$i];
            }

            $i++;
        }
        
        return false;
    }

    public function removePatient(int $id) {
        $i = 0;
        foreach ($this->patients as $patient) {
            if ($patient->getId() == $id) {
                array_splice($this->patients, $i, 1);
                return true;
            }

            $i++;
        }

        return false;
    }
}