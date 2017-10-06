<?php
    include "mysql-connect.php";
    include "status_class.php";
    $app_name = $_REQUEST['app_name']
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

    <title>AATCI - <?php echo($_REQUEST['app_name']); ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>


    <div class="container">

      <div class="starter-template">
        <h1>Ann Arbor Tees CI Dashboard for <?php echo($app_name); ?></h1>
        <div class="text-right">
          <a href="index.php" class="btn btn-primary">Return to Dashboard</a>
        </div>
      </div>
      <h2>Builds</h2>
      <?php
        try {
            $sql = "select * from runs where app='{$app_name}' order by created_at DESC";
            $result = $conn->query($sql);
      ?>
          <table class="table table-striped">
            <thead>
                <th>Build
                </th>
                <tr>
                <th>App
                </th>
                <th>Branch
                </th>
                <th>Status
                </th>
                <th>Spec Start Time
                </th>
                <th>Spec Finish Time
                </th>
                <th>Deploy Start Time
                </th>
                <th>Deploy Finished time
                </th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                <td><a href="/build.php?build_id=<?php echo($row["id"]) ?>&app_name=<?php echo($row["app"]) ?>"><?php echo($row["commit"] ? $row["commit"] : $row["id"]); ?></a>
                </td>
                <td><a href="/app.php?app_name=<?php echo($row["app"]) ?>"><?php echo($row["app"]); ?></a>
                </td>
                <td><?php echo($row["branch"]); ?>
                </td>
                <td>
                    <div class="label label-<?php echo(status_class($row["status"])); ?>">
                        <?php echo($row["status"]); ?>
                    </div>
                </td>
                <td><?php echo(displaytime($row["specs_started_at"])); ?>
                </td>
                <td><?php echo(displaytime($row["specs_ended_at"])); ?>
                </td>
                <td><?php echo(displaytime($row["deploy_started_at"])); ?>
                </td>
                <td><?php echo(displaytime($row["deploy_ended_at"])); ?>
                </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
      <?php
        } catch (Exception $e) {
    ?>
        <div class="alert alert-danger">
            <h3>There was an error</h3>
            <p><?php echo $e ?></p>
        </div>
    <?php
        }
      ?>


    </div><!-- /.container -->
  </body>
</html>
