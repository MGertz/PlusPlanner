<div class="container box-outer">
	<div class="row">
		<div class="container">
			<div class="col-sm-12"><h1><?php echo $team["Name"]; ?></h1></div>
		</div>
	</div>
	<div class="row">
			<div class="col-lg-6">
				<h2>Trainers:</h2>

				<?php foreach( $team["trainers"] as $profile ) { ?>
					<div class="row">
						<div class="container overwatch_teamview_profile_outer">
							<div class="row">
								<div class="col-sm-2 overwatch_teamview_profile_image"><img src="<?php echo $profile["Avatar"]; ?>"></div>
								<div class="col-sm-6">
									<div class="row overwatch_teamview_profile_name"><a href="/OverWatch/ProfileView/<?php echo $profile["ProfileID"];?>"><?php echo $profile["BattleTag"]; ?></a></div>
									<div class="row overwatch_teamview_profile_class"><?php echo $profile["Class"]; ?> - <a href="#" data-toggle="modal" data-target="#mypopbox">Ret</a></div>
								</div>
								<div class="col-sm-2 overwatch_teamview_profile_rank"><img src="/images/overwatch/rank-<?php echo $profile["Badge"]; ?>.png"></div>
								<div class="col-sm-2 overwatch_teamview_profile_sr"><?php echo $profile["SR"]; ?></div>
							</div>
						</div>
					</div>
				<?php } ?>

				<h2>Players: </h2>

				<?php $players = 1; ?>

				<?php foreach( $team["players"] as $profile ) { ?>
					<div class="row">
						<div class="container overwatch_teamview_profile_outer">
							<div class="row">
								<div class="col-sm-2 overwatch_teamview_profile_image"><img src="<?php echo $profile["Avatar"]; ?>"></div>
								<div class="col-sm-6">
									<div class="row overwatch_teamview_profile_name"><a href="/OverWatch/ProfileView/<?php echo $profile["ProfileID"];?>"><?php echo $profile["BattleTag"]; ?></a></div>
									<div class="row overwatch_teamview_profile_class"><?php echo $profile["Class"]; ?> - <a href="#">Ret</a></div>
								</div>
								<div class="col-sm-2 overwatch_teamview_profile_rank"><img src="/images/overwatch/rank-<?php echo $profile["Badge"]; ?>.png"></div>
								<div class="col-sm-2 overwatch_teamview_profile_sr"><?php echo $profile["SR"]; ?></div>
							</div>
						</div>
					</div>
					<?php $players++; ?>
				<?php } ?>
				

				<?php if( $players <= 6 ) { ?>
					<?php while( $players <= 6 ) { ?>
						<div class="row">
							<div class="container overwatch_teamview_profile_outer_empty">
								<div class="row">
									<div class="col-sm-8"><a href="#" data-toggle="modal" data-target="#modal_addplayer_4">Add new Player to team</a></div>
									<div class="col-sm-4"></div>
								</div>
							</div>
						</div>
					
						<?php $players++; ?>
					<?php } ?>
				<?php } ?>


			</div>


			<div class="col-lg-6">
				<div class="container">
					<h2>Beskrivelse af holdet:</h2>
					<p><?php echo $team["Description"];?></p>
				</div>

			</div>

	</div>
</div>


<div class="modal fade" id="mypopbox">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Edit the user</h3>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tincidunt metus quis commodo scelerisque. Donec rutrum scelerisque erat, et tempor nunc suscipit nec. Duis luctus et elit a maximus. Duis quis malesuada ipsum, id pellentesque dolor. Fusce metus urna, posuere a porta at, euismod nec risus. Donec varius ac ex sit amet finibus. Fusce tortor felis, scelerisque eget fermentum quis, vulputate eget enim. Nulla neque leo, laoreet vel arcu a, tincidunt dapibus purus. In molestie at nibh vel consectetur.</p>
			</div>
			<div class="modal-footer">
				<form action="/Overwatch/TeamEdit" target="_blank" method="post" class="mr-auto">
					<input type="hidden" name="function" value="DeleteUserFromTeam">
					<input type="hidden" name="TeamID" value="<?php echo $team["TeamID"]; ?>">
					<input type="hidden" name="ProfileID" value="0">
					<button type="submit" class="btn btn-danger">Remove user from team</button>
				</form>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_addplayer_4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Add new player to the team</h3>
			</div>
			<div class="modal-body">
				<p>
					<form action="/OverWatch/TeamEdit" method="post" target="_blank">
						<input type="hidden" name="function" value="addplayer">
						<input type="hidden" name="TeamID" value="<?php echo $team["TeamID"]; ?>">
						<label for="BattleTag">BattleTag</label>
						<input type="text" name="BattleTag" value="">







					
				</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Add Player</button>
				</form>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
