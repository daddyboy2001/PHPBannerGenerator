<?php
$hits = file_get_contents('hits.txt');

$views = $hits + 1;

$file = 'hits.txt';

// Write the contents back to the file
file_put_contents($file, $views);

echo file_get_contents('hits.txt');;

?>