                                                                                                                                                                                                                                                                                                <nav class="navbar navbar-default">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="user_dash.php">Dina grupper <!-- <span class="sr-only">(current)</span> --></a></li>
            <li><a href="team_groups.php">Grupper & Matcher</a></li>
            <li><a href="results.php">Resultat</a></li>
            <li><a href="slutspel.php">Slutspel</a></li>
            <!-- <li><a href="create_group.php">Skapa grupper</a></li> -->
            <li><a href="spelregler.php">Spelregler</a></li>
        </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
        <ul class="nav navbar-nav navbar-right">
            <?php 
            if(isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == 'true'){ 
                ?>
                <li>Admin: <?php echo $_SESSION['user_name']; ?></li>
                <li><a href="logout.php">Logga Ut</a></li>
                <?php echo $_SESSION['admin_loggedin'];?>
                <?php 
            }
            else if(isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == 'true'){
                ?>
                <!-- <li>User: <?php //echo $_SESSION['user_name']; ?></li> -->
                <li><a href="logout.php">Logga Ut</a></li>
                <?php 
            }?>  
        </ul>
    </div><!-- /.navbar-collapse -->

</nav>