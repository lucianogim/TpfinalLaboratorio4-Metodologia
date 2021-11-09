<?php
    namespace Models;

    class Student
    {
        private $studentId;
        private $careerId;
        private $firstName;
        private $lastName;
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $email;
        private $phone;
        private $active;

        public function getStudentId()
        {
            return $this->studentId;
        }

        public function setStudentId($studentId)
        {
            $this->studentId = $studentId;
        }

        public function getCareerid()
        {
            return $this->careerId;
        }

        public function setCareerid($careerId){
            $this->careerId = $careerId;
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        public function getDni(){
            return $this->dni;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }
        
        public function getFilenumber()
        {
            return $this->fileNumber;
        }

        public function setFilenumber($fileNumber){
            $this->fileNumber = $fileNumber;
        }

        public function getGender()
        {
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getBirthdate()
        {
            return $this->birthDate;
        }

        public function setBirthdate($birthdate){
            $this->birthDate = $birthdate;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPhone()
        {
            return $this->phone;
        }

        public function setPhone($phone){
            $this->phone = $phone;
        }

        public function getActive()
        {
            return $this->active;
        }

        public function setActive($active){
            $this->active = $active;
        }


    }
?>

