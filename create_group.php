<?php include 'includes/header.php' ?>
<?php include 'includes/menu.php'; ?>
<div id="container_create_group" class="container">
	<div class="row">
		<div id='tournament_reg' class='col-sm-12'>
			<h2>Skapa grupp</h2><br/>
			<!--The p tag will contain the error messages for what is wrong with the value in input-->
			<?php
			if(isset($_GET['reg_error'])){?>
				<p id="message" style="text-align: center; color: red;">Något gick fel med registreringen. Testa igen eller försök igen senare.</p>
			<?php
			}else{?>
				<p id="message" style="text-align: center; color: red;">&nbsp;</p>
			<?php
			}?>
			<form id="creat_group_form" class="form-group" action='reg_tournament.php' method='post'>
				<div class="picture">
					<label>Grupp namn:</label>
					<input id="groupname" class="form-control" type='text' name='tournament_name' placeholder='Lisas tävling'>
					<img id="checked" style="display: none" class="hideImg" width="25px" height="25px" src="img/checked.png"><img id="uunchecked" style="display: none" class="hideImg" width="25px" height="25px" src="img/unchecked.png">
				</div>
				<br>
				<br>
				<label>Skriv en grupp text:</label>
				<textarea class="form-control" rows="5" name='tournament_text' correct="correct" placeholder="Här ska vi bara ha de skoj! inget funsk nu va!!"></textarea></br>
				<br/>
				<label>Skriv i mail adress till de som du vill bjuda in till gruppen med ett mellan slag mellan adresserna</label>
				<input class="form-control" name="invitation-email" correct="correct" placeholder='exempel@exempel.se exempel@exempel.se'></br>
				<br/>
				<button id="create_btn" class="btn btn-default" type='submit' name='tournament_reg_btn' value='skapa grupp'>Skapa Grupp</button>
			</form>
		</div>
	</div><!-- #row -->
</div><!-- #container -->


<?php include 'includes/footer.php' ?>
<script src="js/create_group_check.min.js"></script>
