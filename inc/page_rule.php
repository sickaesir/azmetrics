<?php

function if_logged_in($callback) {
  if(get_logged_in_user() !== null)
    $callback();
}


function if_not_logged_in($callback) {
  if(get_logged_in_user() === null)
    $callback();
}

?>
