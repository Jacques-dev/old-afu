<?php
  class Mark {

    private $id;
    private $type;
    private $coefficient;
    private $id_subject;


    public function getId(): int {
      return $this->id;
    }

    public function getName(): string {
      return $this->type;
    }

    public function getType(): string {
      return $this->type;
    }

    public function getCoefficient(): float {
      return $this->coefficient;
    }

    public function getSubject(): int {
      return $this->id_subject;
    }

    public function toString(): string {
      return "id : ".$this->id." type : ".$this->type." coefficient : ".$this->coefficient." id_subject : ".$this->id_subject."<br>";
    }
  }
?>
