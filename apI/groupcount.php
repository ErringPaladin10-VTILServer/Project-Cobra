<?php

$input = file_get_contents("https://www.roblox.com/groups/2849639/");

preg_match_all('/with (\d*) members/', $input, $output_array);
echo $input;

?>