<?php
  include_once('./inc/inc.php');

  if(!isset($_GET['app_key']))
  {
    return_json_response(['success' => false, 'error' => 'missing app key!']);
  }

  $metric = get_metric_by_appkey($_GET['app_key']);

  if($metric === false)
  {
    return_json_response(['success' => false, 'error' => 'invalid app key!']);
  }

  if($metric['active'] === false) {
    return_json_response(['success' => false, 'error' => 'the selected metric is currently inactive!']);
  }

  if(!isset($_GET['action'])) {
    return_json_response(['success' => false, 'error' => 'missing action type!']);
  }

  switch($_GET['action']) {
    case 'ingest':
      if(!isset($_GET['value'])) {
        return_json_response(['success' => false, 'error' => 'missing value parameter!']);
      }

      ingest_metric_value($metric['id'], $_GET['value'], get_ip());

      return_json_response(['success' => true]);
    break;

    case 'retrieve':
      return_json_response(['success' => true, 'data' => get_metric_value($metric['id'])]);
    break;
    
    default: return_json_response(['success' => false, 'error' => 'invalid action type!']);
  }

?>
