<?php

  class Subject {

    private $id;

    private $name;

    private $coefficient;

    private $id_ue;

    public function getId(): string {
      return $this->id;
    }

    public function getName(): string {
      return $this->name;
    }

    public function getCoefficient(): float {
      return $this->coefficient;
    }

    public function getUE(): string {
      return $this->id_ue;
    }

    public function getNameFromId($id): string {
      if ($id === $this->id) {
        return $this->name;
      }
    }

    public function toString(): string {
      return "Name: ".$this->name." coefficient: ".$this->coefficient." ue: ".$this->id_ue."<br>";
    }

  }

?>
