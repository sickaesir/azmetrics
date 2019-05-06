<?php

  function get_db_connection()
  {
    $host = 'localhost';
    $email = 'root';
    $pass = 'kali_123';
    $db = 'azmetrics';

    $conn = new mysqli($host, $email, $pass, $db);

    return $conn;
  }

  function make_register($email, $pass, $pass_repeat)
  {
    if($pass !== $pass_repeat)
    {
      return 'The two passwords has to match!';
    }

    /*if(!preg_match('^[a-zA-Z]\w{3,14}$', $pass))
    {
      return "The password's first character must be a letter, it must contain at least 4 characters and no more than 15 characters and no characters other than letters, numbers and the underscore may be used";
    }

    if(!preg_match('^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$', $email))
    {
      return "Invalid email supplied!";
    }*/


    $hashed_password = hash('sha256', $pass);

    $conn = get_db_connection();

    $stmt = $conn->prepare("INSERT INTO users (email, password, admin) VALUES (?, ?, 0)");

    $stmt->bind_param('ss', $email, $hashed_password);

    $stmt->execute();

    return true;
  }

  function get_user($id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();

    if($row = $stmt->get_result()->fetch_assoc()) {
      return $row;
    }

    return false;
  }

  function get_metrics($user_id, $page) {
    $offset = 12 * $page;
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM metrics WHERE user_id = ? --?");
    $stmt->bind_param('dd', $user_id, $offset);
    $stmt->execute();

    $res = $stmt->get_result();

    $out = [];
    while($row = $res->fetch_assoc())
    {
      array_push($out, $row);
    }

    return $out;
  }

  function create_metric($name, $issuer) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO metrics (user_id, name, created_on, active) VALUES (?, ?, NOW(), 1)");
    $stmt->bind_param('ds', $issuer, $name);
    $stmt->execute();

    return true;
  }

  function make_login($email, $pass)
  {
    $hashed_password = hash('sha256', $pass);

    $conn = get_db_connection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");

    $stmt->bind_param('ss', $email, $hashed_password);

    $stmt->execute();

    if($row = $stmt->get_result()->fetch_assoc()) {
      return $row['id'];
    }

    return false;

  }

?>
