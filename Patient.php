<?php
class Patient implements JsonSerializable{
    static $idCount = 0;

    private $id;
    private $name;
    private $age;
    private $gender;
    private $address;
    private $consultation;

    public function __construct($name, $age, $gender, $address) {
        $this->id = Patient::$idCount;
        Patient::$idCount++;

        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
        $this->consultation = [
            "time" => "",
            "done" => false
        ];
    }

    /**
     * Getters
     */
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getConsultationDetails(String $key) {
        return $this->consultation[$key];
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    /**
     * Setters
     */
    public function setName(String $name) {
        $this->name = $name;
    }

    public function setAge(int $age) {
        $this->age = $age;
    }

    public function setGender(String $gender) {
        $this->gender = $gender;
    }

    public function setAddress(String $address) {
        $this->address = $address;
    }

    public function setConsultationDetails($key, $value) {
        $this->consultation[$key] = $value;
    }
}