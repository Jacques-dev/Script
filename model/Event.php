<?php
  class Event {

    private $ide;
    private $text;
    private $pred;
    private $script;

    public function getId(): int {
      return $this->ide;
    }

    public function getText(): string {
      return $this->text;
    }

    public function getPred(): int {
      return $this->pred;
    }

    public function getScript(): int {
      return $this->script;
    }

  }
?>
