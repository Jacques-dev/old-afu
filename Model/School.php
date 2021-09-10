<?php
  class School {

    private $name;

    private $nb_semester;

    public function getName(): string {
      return $this->name;
    }

    public function getNumberOfSemester(): int {
      return $this->nb_semester;
    }

    public function toString(): string {
      return "Name : ".$this->name." semester_number : ".$this->semester_number."<br>";
    }

  }
?>
