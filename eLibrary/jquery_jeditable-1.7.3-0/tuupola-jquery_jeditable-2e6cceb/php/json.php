<?php

$array['D'] =  'Letter D';
$array['E'] =  'Letter E';
$array['F'] =  'Letter F';
$array['G'] =  'Letter G';
$array['selected'] =  'F';

print json_encode($array);
echo "<br>";
print_r(json_decode(json_encode($array)));

?>
