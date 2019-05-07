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

  function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function return_json_response($data) {
    header('Content-Type: application/json');
    die(json_encode($data));
  }

?>
