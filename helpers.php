<?php


class Counter {
  public int $counter = 0;

  public function inc() {
    return $this->counter++;
  }
}


function dd(...$a) {
  foreach($a as $b) {
    echo "<br><pre>";
	  print(var_dump($b));
    echo "</pre>";
  }
  exit();
	
}

function printLn($text) {
	echo "<br>".$text;
}