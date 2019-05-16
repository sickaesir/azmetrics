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

  function get_display_name($id) {
    $user_info = get_user($id);
    if($id === false) return 'N/A';

    return isset($user_info['username']) ? $user_info['username'] : $user_info['email'];
  }

  function is_admin($id) {
    if($id === null) return false;
    
    $user_info = get_user($id);
    if($id === false) return false;

    return $user_info['admin'];
  }
?>
