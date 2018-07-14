<div class="container box-outer">
	
	<div class="row">

		<div class="col-sm-3 profile_sidebar_left">
		
			<div class="profile_userpic"><img src="<?php echo $Profile["Avatar"];?>" class="img-responsive" alt=""></div>

		
		
			<div class="row">
				<table class="profile_table">
					<tbody>
						<tr>
							<td class="profile_table_left">Name:</td>
							<td class="profile_table_right"><?php echo $Profile["Name"]; ?></td>
						</tr>
						<tr>
							<td class="profile_table_left">Birthday:</td>
							<td class="profile_table_right"><?php echo $Profile["Birthday"];?></td>
						</tr>
						<tr>
							<td class="profile_table_left">Country:</td>
							<td class="profile_table_right"><img src="https://lipis.github.io/flag-icon-css/flags/4x3/dk.svg" class="profile_flag"> Denmark</td>
						</tr>
						<tr>
							<td class="profile_table_left">SR:</td>
							<td class="profile_table_right"><?php echo $Profile["SR"];?></td>
						</tr>
						<tr>
							<td class="profile_table_left">Køn:</td>
							<td class="profile_table_right"><?php echo $Profile["Gender"];?></td>
						</tr>
						<tr>
							<td class="profile_table_left">Status:</td>
							
							<?php if( $Profile["Online"] == true ) { ?>
								<td class="profile_table_right">Online</td>
							<?php } else { ?>
								<td class="profile_table_right">Offline</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		
		
		
		
		
		
		
		</div>


		<div class="col-sm-6">
				<h1><?php echo $Profile["BattleTag"];?></h1>
				<h2>Lidt om mig:</h2>
				<?php if($Profile["Description"] != "" ) { ?>
					<p class="small"><?php echo nl2br( $Profile["Description"] ); ?></p>
				<?php } ?>
				
				<?php if( $Profile["Description"] == "" && $Profile["EditRights"] == true ) { ?>
					<p class="small">(Der er ikke skrevet nogen tekst endnu, og den kan ej heller redigeres lige pt. funktion kommer senere. Tryk på <b>Rediger tekst</b> neden for)</p>
				<?php } ?>
				
				
				<?php if( $Profile["EditRights"] == true ) { ?>
					<a href="#" data-toggle="modal" data-target="#modal_edit_description">Rediger tekst</a>
				<?php } ?>
				
				
		</div>



		<div class="col-sm-3 profile_sidebar_right">
			
			<h3 class="center">Follow me</h3>
			<div class="row">
				<div class="col-sm-12 center">
					
					<?php if( $Profile["Follow"] != false ) { ?>
						<?php if( isset( $Profile["Follow"]["Facebook"] ) ) { ?>
							<a href="<?php echo $Profile["Follow"]["Facebook"];?>" target="_blank"><img src="http://home.ringhus.dk/plusplanner-files/social-icons/facebook.png" class="profile_social_icon"></a>
						<?php } ?>
						
						<?php if( isset( $Profile["Follow"]["Facebook"] ) ) { ?>
							<a href="<?php echo $Profile["Follow"]["YouTube"];?>" target="_blank"><img src="http://home.ringhus.dk/plusplanner-files/social-icons/youtube.png" class="profile_social_icon"></a>
						<?php } ?>
							<a href="/profile" target="_blank"><img src="http://home.ringhus.dk/plusplanner-files/social-icons/twitch.png" class="profile_social_icon"></a>
					<?php } else { ?>
						<p class="small">Brugeren har ikke indtastet nogle follow me links.
					<?php } ?>

				</div>
			</div>
			
			
			
			
			<h3 class="center">Most played Heroes</h3>
			<div class="row">
				<div class="col-sm-4 profile_most_played_heroes"><img src="https://d1u1mce87gyfbn.cloudfront.net/hero/mercy/hero-select-portrait.png"><p class="profile_most_played_heroes_name">Mercy</p></div>
				<div class="col-sm-4 profile_most_played_heroes"><img src="https://d1u1mce87gyfbn.cloudfront.net/hero/lucio/hero-select-portrait.png"><p class="profile_most_played_heroes_name">Lucio</p></div>
				<div class="col-sm-4 profile_most_played_heroes"><img src="https://d1u1mce87gyfbn.cloudfront.net/hero/zenyatta/hero-select-portrait.png"><p class="profile_most_played_heroes_name">Zenyatta</p></div>
			</div>
		

			

				
		</div>





	</div> 
</div>

<?php if( $Profile["EditRights"] == true ) { ?>

<!-- MODAL FOR EDITING TEAM DESCRIPTION -->

<form action="/OverWatch/ProfileEdit" method="post">
<input type="hidden" name="ProfileID" value="<?php echo $Profile["ProfileID"]; ?>">

	<div class="modal fade" id="modal_edit_description">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Rediger beskrivelse</h3>
				</div>
				<div class="modal-body">
					<p>
						<textarea name="Description" class="form-control" rows="10"><?php echo $Profile["Description"];?></textarea>
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" name="function" value="EditDescription" class="btn btn-primary">Gem</button>
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
				</div>
			</div>
		</div>
	</div>

</form>
<!-- MODAL FOR EDITING TEAM DESCRIPTION END -->

<?php } ?>



