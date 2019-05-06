<?php

  function get_db_connection()
  {
    $host = 'localhost';
    $user = 'root';
    $pass = 'kali_123';
    $db = 'azmetrics';

    $conn = new mysqli($host, $user, $pass, $db);

    return $conn;
  }

  function make_register($user, $pass, $pass_repeat)
  {
    if($pass !== $pass_repeat)
    {
      return 'The two passwords has to match!';
    }

    $hashed_password = hash('sha256', $pass);

    $conn = get_db_connection();

    $stmt = $conn->prepare("INSERT INTO users (email, password, admin) VALUES (?, ?, 0)");

    $stmt->bind_param('ss', $user, $hashed_password);

    $stmt->execute();

    return true;
  }

  function make_login($user, $pass)
  {
    $hashed_password = hash('sha256', $pass);

    $conn = get_db_connection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");

    $stmt->bind_param('ss', $user, $hashed_password);

    $stmt->execute();

    if($row = $stmt->get_result()->fetch_assoc()) {
      return $row['id'];
    }

    return false;

  }

?>
