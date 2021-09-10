<?php
  class Profil {

    private $email;
    private $password;
    private $name;
    private $firstname;
    private $school;
    private $td_group;
    private $promotion;

    public function __construct($email, $password, $name, $firstname, School $school, TDGroup $td_group, Year $promotion) {
      $this->email = $email;
      $this->password = $password;
      $this->name = $name;
      $this->firstname = $firstname;
      $this->school = $school;
      $this->td_group = $td_group;
      $this->promotion = $promotion;
    }

    public function getEmail(): string {
      return $this->email;
    }
    public function getPassword(): string {
      return $this->password;
    }
    public function getName(): string {
      return $this->name;
    }
    public function getFirstname(): string {
      return $this->firstname;
    }
    public function getSchool(): string {
      return $this->school;
    }
    public function getTdGroup(): string {
      return $this->td_group;
    }
    public function getPromotion(): string {
      return $this->promotion;
    }

    public function toString(): string {
      return "Email : ".$this->email + " password : " + .$this->password + "name : ".$this->name + "firstname : " + .$this->firstname + "school : ".$this->school + "td_group : " + .$this->td_group + "promotion : " + .$this->promotion;
    }
  }
?>
