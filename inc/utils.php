<?php

  function redirect($url) {
    header("location: $url");
    die('redirecting...');
  }

?>
