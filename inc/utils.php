<?php

  function redirect($url) {
    header("location: $url");
    die('redirecting...');
  }

  function get_ip() {
    return $_SERVER['REMOTE_ADDR'];
  }

  function verify_recaptcha_response($payload, $ip) {
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LdiB6IUAAAAAHxuPKe1HpUp3H335inlz-gceDAM&response=$payload&remoteip=$ip";
    $response = json_decode(file_get_contents($url), true);

    return $response['success'] === true;
  }

?>
