<?php
  function status_class($status){
    switch($status){
      case "initialized":
        return "primary";
        break;
      case "in_progress":
      case "deploy_started":
        return "info";
        break;
      case "specs_started":
      case "specs_ended":
      case "deploy_ended":
        return 'warning';
        break;
      case "specs_failed":
      case "deploy_failed":
      case "error":
        return 'danger';
        break;
      case "fulfilled":
      case "deployed":
      case "specs_passed":
        return 'success';
        break;
      case "pending":
      case "retrying_specs":
        return 'default';
        break;
      default:
        return "danger";
    }
  }
?>
