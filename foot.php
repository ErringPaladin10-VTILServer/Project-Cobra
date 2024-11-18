<?php

$sourceAPIToken = "PRODUCTION.TOKEN.HERE";
$devSourceAPIToken = "DEVELOPMENT.TOKEN.HERE";
$veryDevSourceAPIToken = "STAGING.TOKEN.HERE";

if (json_decode(file_get_contents('php://input'), true)['key'] == $sourceAPIToken) {
  die(file_get_contents('../../pcsource.lua'));
} elseif (json_decode(file_get_contents('php://input'), true)['key'] == $devSourceAPIToken) {
  die(file_get_contents('../../devpcsource.lua'));
} elseif (json_decode(file_get_contents('php://input'), true)['key'] == $veryDevSourceAPIToken) {
  if (json_decode(file_get_contents('php://input'), true)['module'] == "") {
    die(file_get_contents('../../pcsourcedev.lua'));
  } else {
    die(file_get_contents('../../pc_modules/' . json_decode(file_get_contents('php://input'), true)['module'] . '.lua'));
  }
} else {
  die("print('Project Cobra loaded successfully!');");
}

?>