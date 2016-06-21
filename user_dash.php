<?php include 'includes/header.php';

if($_SESSION['user_loggedin'] != 'true') {
	header("Location: index.php");
}

?>
<div class="container-fluid">
	<div class="row1">

		<div class="wrapper col-sm-12">
			<?php include 'includes/menu.php'; ?>
			<h1>Välkommen <?php echo $_SESSION['user_name']; ?></h1>
			<?php include 'bet.php' ?>
		</div>	
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<!-- <ul class="nav nav-tabs">
		  <li class="active" id="tab1"><a href="#">Scoreboard</a><div id="tab-content1" class="tab-content">
		        </div></li>
		  <li id="tab2"><a href="#">Betta</a><div id="tab-content2" class="tab-content">
		        </div></li>
		</ul> -->

		<ul class="tabs">
		    <li class="tab1 active">
		        <input type="radio" name="tabs" id="tab1" checked/>
		        <label for="tab1">Scoreboard</label>
		        <div id="tab-content1" class="tab-content">
		        </div>
		    </li>
		  
		    <li class="tab2">
		        <input type="radio" name="tabs" id="tab2" />
		        <label for="tab2">Betta</label>
		        <div id="tab-content2" class="tab-content">

		        </div>
		    </li>
		</ul>

		<br style="clear: both;" />
	</div><!-- #row -->
</div><!-- #container-fluid -->
		

<?php include 'includes/footer.php' ?>
<script src="js/user_dash_script.min.js"></script>