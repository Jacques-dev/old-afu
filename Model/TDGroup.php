<?php
  class TDGroup {

    private $name;

    private $school;

    public function getName(): string {
      return $this->name;
    }

    public function getSchool(): School {
      return $this->school;
    }

    public function toString(): string {
      return "Name : ".$this->name." school: ".$this->school."<br>";
    }
    
  }
?>
