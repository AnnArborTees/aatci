<?php
  function status_class($status){
    switch($status){
      case "specs_started":
      case "specs_ended":
      case "specs_passed":
      case "deploy_started":
      case "deploy_ended":
        return 'warning';
        break;
      case "specs_failed":
      case "deploy_failed":
      case "error":
        return 'danger';
        break;
      case "deployed":
        return 'success';
        break;
      default:
        return "danger";
    }
  }
?>
