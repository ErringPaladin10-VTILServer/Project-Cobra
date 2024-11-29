<?php

if (isset($_GET['User-Id']))
  echo file_get_contents("https://nodewebserver-tuskor661.herokuapp.com/rap?userId=" . urlencode($_GET['User-Id']));

?>