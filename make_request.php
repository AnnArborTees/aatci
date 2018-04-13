<?php
include "mysql-connect.php";
include "layout/head.php";

$stmt = $conn->prepare("insert into requests (app, action, target) values (?, ?, ?)");

$stmt->bind_param('sss', $_POST['app'], $_POST['action'], $_POST['target']);

if ($stmt->execute()) {
?>
<script type='text/javascript'>
  setTimeout(function() { history.go(-1); }, 2000)
</script>
<div class='alert alert-success'>
Request queued! Redirecting...
</div>
<?php
}
else {
?>
<div class='alert alert-danger'>
<?php echo($stmt->error); ?>
</div>
<?php
}

$stmt->close();
?>
