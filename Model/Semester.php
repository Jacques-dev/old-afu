<?php

  class Semester {

    private $id;
    private $num;
    private $school;

    public function getId(): string {
      return $this->id;
    }

    public function getName(): string {
      return $this->num;
    }

    public function getSchool(): string {
      return $this->school;
    }

    public function getNameFromId($id): string {
      if ($id === $this->id) {
        return $this->num;
      }
    }

    public function toString(): string {
      return "Id: ".$this->id." num: ".$this->num." school: ".$this->school."<br>";
    }

  }

?>
