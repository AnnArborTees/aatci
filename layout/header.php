<?php
  $sql = "select * from( select * from runs order by created_at DESC) x group by app";
  $result = $conn->query($sql);
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Ann Arbor Tees CI</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="https://github.com/annarbortees">github</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Apps <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php while($row = $result->fetch_assoc()) { ?>
              <li><a href="/app.php?app_name=<?php echo($row["app"]) ?>">
                <span class="label label-<?php echo(status_class($row["status"])); ?>">&nbsp;&nbsp;</span>
                <?php echo($row["app"]); ?></a>
              </li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

