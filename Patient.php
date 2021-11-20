<?php
class Patient implements JsonSerializable{
    private $name;
    private $age;
    private $gender;
    private $address;

    public function __construct($name, $age, $gender, $address) {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;    
    }

    /**
     * Getters
     */
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
}