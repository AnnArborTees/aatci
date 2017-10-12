<?php
    include "mysql-connect.php";
    include "status_class.php";
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

    <title>AATCI - Dashboard</title>
    <?php include "layout/head.php"; ?>
  </head>

  <body>
    <div class="container">
    <?php include "layout/header.php"; ?>

      <div class="starter-template">
        <h1>Ann Arbor Tees CI Dashboard</h1>
      </div>
      <?php
        try {
            $sql = "select * from( select * from runs order by created_at DESC) x group by app";
            $result = $conn->query($sql);
      ?>
          <table class="table table-striped">
            <thead>
                <tr>
                <th>Latest Build
                </th>
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
