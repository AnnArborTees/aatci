<?php
    include "mysql-connect.php";
    include "status_class.php";
    $build_id = $_REQUEST['build_id'];
    $app_name = $_REQUEST['app_name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>AATCI - <?php echo($_REQUEST['app_name']); ?> - Build #<?php echo($_REQUEST['build_id']); ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="colors.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>


    <div class="container">

      <div class="starter-template">
        <h1><?php echo($app_name); ?> - Build #<?php echo($build_id); ?></h1>
        <div class="text-right">
          <a href="app.php?app_name=<?php echo($app_name); ?>" class="btn btn-primary">Return to App</a>
          <a href="index.php" class="btn btn-primary">Return to Dashboard</a>
        </div>
      </div>
      <?php
        try {
            $sql = "select * from runs where id='{$build_id}';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
      ?>
        <div class="alert alert-<?php echo(status_class($row["status"])); ?>">
          <h3><?php echo($row["status"]); ?></h3>
        </div>

        <a href="https://github.com/AnnArborTees/<?php echo($row["app"]) ?>/commit/<?php echo($row["commit"]) ?>" target='_blank' class='btn btn-default'>
          View on <img src="https://assets-cdn.github.com/images/modules/logos_page/GitHub-Logo.png" height=13 />
        </a>

        <h4>Specs</h4>
        <dl>
          <dt>Started</dt>
          <dd><?php echo($row["specs_started_at"]); ?></dd>
          <dt>Ended</dt>
          <dd><?php echo($row["specs_ended_at"]); ?></dd>
        </dl>
        <div class="alert terminal">
          <?php echo(str_replace("  ", "&nbsp;&nbsp",nl2br($row["spec_output"]))); ?>
        </div>

        <h4>Deploy</h4>
        <dl>
          <dt>Started</dt>
          <dd><?php echo($row["deploy_started_at"]); ?></dd>
          <dt>Ended</dt>
          <dd><?php echo($row["deploy_ended_at"]); ?></dd>
        </dl>
        <div class="alert terminal">
          <?php echo(str_replace("  ", "&nbsp;&nbsp",nl2br($row["deploy_output"]))); ?>
        </div>
      <?php
        } catch (Exception $e) {
      ?>
        <div>
            <h3>There was an error</h3>
            <p><?php echo $e ?></p>
        </div>
    <?php
        }
      ?>


    </div><!-- /.container -->
  </body>
</html>
