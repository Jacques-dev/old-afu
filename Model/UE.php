<?php

  class UE {

    private $id;

    private $name;

    private $school;

    private $id_semester;

    private $coefficient;

    private $level;

    public function getId(): string {
      return $this->id;
    }

    public function getName(): string {
      return $this->name;
    }

    public function getSchool(): string {
      return $this->school;
    }

    public function getSemester(): string {
      return $this->id_semester;
    }

    public function getCoefficient(): float {
      return $this->coefficient;
    }

    public function getLevel(): string {
      return $this->level;
    }

    public function getNameFromId($id): string {
      if ($id === $this->id) {
        return $this->name;
      }
    }

    public function toString(): string {
      return "Name : ".$this->name." school: ".$this->school." id_semester: ".$this->id_semester." coefficient: ".$this->coefficient." level: ".$this->level."<br>";
    }

  }

?>
