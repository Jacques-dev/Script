



<?php

function render(string $view, $parameters = []) {
  extract($parameters);
  include("{$view}.php");
}

function show($x) {
  echo "<pre class='show'>";
  print_r($x);
  echo "</pre>";
}

?>
