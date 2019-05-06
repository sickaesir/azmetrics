<?php
  function init_session() {
    session_start();
    ob_start();
  }

  function set_logged_in_user($id) {
    $_SESSION['logged_id'] = $id;
  }

  function get_session_param($param) {
    return isset($_SESSION[$param]) ? $_SESSION[$param] : null;
  }

  function get_logged_in_user() {
    return get_session_param('logged_id');
  }
?>
