<?php
  class MarkType {

    private $name;

    public function getName(): string {
      return $this->name;
    }

    public function toString(): string {
      return "Name : ".$this->name."<br>";
    }
  }
?>
