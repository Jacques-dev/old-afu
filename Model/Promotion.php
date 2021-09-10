<?php
  class Promotion {

    private $year;

    public function getName(): string {
      return $this->year;
    }

    public function toString(): string {
      return "Year : ".$this->year."<br>";
    }

  }
?>
