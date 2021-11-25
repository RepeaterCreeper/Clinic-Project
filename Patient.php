<?php
class Patient implements JsonSerializable{
    public static $idCount = 0;

    private $id;
    private $name;
    private $age;
    private $gender;
    private $address;
    private $consultation;

    public function __construct($name, $age, $gender, $address) {
        $this->id = spl_object_id($this);

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

    // Get Name
    public function getName() {
        return $this->name;
    }

    // Get Age
    public function getAge() {
        return $this->age;
    }

    // Get Gender
    public function getGender() {
        return $this->gender;
    }

    // Get Address
    public function getAddress() {
        return $this->address;
    }

    // Get consultation details
    public function getConsultationDetails(String $key) {
        return $this->consultation[$key];
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function __wakeup(){
        foreach (get_object_vars($this) as $k => $v) {
            $this->{$k} = $v;
        }
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