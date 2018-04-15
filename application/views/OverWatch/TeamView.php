<div class="container box-outer">
	<div class="row">
		<div class="container">
			<div class="col-sm-12"><h1><?php echo $team["Name"]; ?></h1></div>
		</div>
	</div>
	<div class="row">
			<div class="col-lg-6">
				<h2>Trainers:</h2>

				<?php if( !empty($team["trainers"]) ) { ?>

					<?php foreach( $team["trainers"] as $profile ) { ?>
						<div class="row">
							<div class="container overwatch_teamview_profile_outer">
								<div class="row">
									<div class="col-sm-2 overwatch_teamview_profile_image"><img src="<?php echo $profile["Avatar"]; ?>"></div>
									<div class="col-sm-6">
										<div class="row overwatch_teamview_profile_name"><a href="/OverWatch/ProfileView/<?php echo $profile["ProfileID"];?>"><?php echo $profile["BattleTag"]; ?></a></div>
										<div class="row overwatch_teamview_profile_class"><?php echo $profile["Class"]; ?>&nbsp;-&nbsp;<a href="#" data-toggle="modal" data-target="#ModalEditTrainer<?php echo $profile["ProfileID"]; ?>">Ret</a></div>
									</div>
									<div class="col-sm-2 overwatch_teamview_profile_rank"><img src="/images/overwatch/rank-<?php echo $profile["Badge"]; ?>.png"></div>
									<div class="col-sm-2 overwatch_teamview_profile_sr"><?php echo $profile["SR"]; ?></div>
								</div>
							</div>
						</div>
					<?php } ?>

				<?php } else { ?>


					<div class="row">
						<div class="container overwatch_teamview_profile_outer_empty">
							<div class="row">
								<div class="col-sm-8"><a href="#" data-toggle="modal" data-target="#modal_addplayer_4">Add new trainer team</a></div>
								<div class="col-sm-4"></div>
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
									<div class="row overwatch_teamview_profile_class"><?php echo $profile["Class"]; ?>&nbsp;-&nbsp;<a href="#" data-toggle="modal" data-target="#ModalEditPlayer<?php echo $profile["ProfileID"]; ?>">Rediger</a></div>
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

	<div class="row">
		<div class="col-sm-12 text-center">
			<a href="https://www.partner-ads.com/dk/klikbanner.php?partnerid=14053&bannerid=42303" target="_blank" rel="nofollow"> <img src="https://www.partner-ads.com/dk/visbanner.php?partnerid=14053&bannerid=42303" border="0"></a>
		</div>
	</div>

</div>

<!-- MODAL FOR EDITING TRAINERS IN THE TEAM -->
<?php foreach( $team["trainers"] as $profile ) { ?>
<form action="/Overwatch/TeamEdit" method="post">
<input type="hidden" name="TeamID" value="<?php echo $team["TeamID"]; ?>">
<input type="hidden" name="ProfileID" value="<?php echo $profile["ProfileID"]; ?>">

<div class="modal fade" id="ModalEditTrainer<?php echo $profile["ProfileID"]; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Edit user: <?php echo $profile["BattleTag"]; ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3 text-right">Editor:</div>
					<div class="col-sm-9"><input type="radio" name="Editor" value="true" id="EditorTrue<?php echo $profile["ProfileID"];?>" <?php if( $profile["Editor"] == "true" ) { echo "checked"; } ?>>&nbsp;<label for="EditorTrue<?php echo $profile["ProfileID"];?>">Yes</label>&nbsp;-&nbsp;<input type="radio" name="Editor" value="false" id="EditorFalse<?php echo $profile["ProfileID"];?>" <?php if( $profile["Editor"] == "false" ) { echo "checked"; } ?> >&nbsp;<label for="EditorFalse<?php echo $profile["ProfileID"];?>">No</label></div>
				</div>
				<div class="row">
					<div class="col-sm-3 text-right">Class:</div>
					<div class="col-sm-9">
						<input type="radio" name="Class" value="Offense" id="ClassOffense<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Offense" ) { echo "checked"; } ?>> <label for="ClassOffense<?php echo $profile["ProfileID"];?>">Offense</label> - 
						<input type="radio" name="Class" value="Defense" id="ClassDefense<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Defense" ) { echo "checked"; } ?>> <label for="ClassDefense<?php echo $profile["ProfileID"];?>">Defense</label> - 
						<input type="radio" name="Class" value="Support" id="ClassSupport<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Support" ) { echo "checked"; } ?>> <label for="ClassSupport<?php echo $profile["ProfileID"];?>">Support</label> - 
						<input type="radio" name="Class" value="Tank" id="ClassTank<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Tank" ) { echo "checked"; } ?>> <label for="ClassTank<?php echo $profile["ProfileID"];?>">Tank</label> 
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 text-right">Member Type:</div>
					<div class="col-sm-9">
						<input type="radio" name="MemberType" value="Player" id="MemberTypePlayer<?php echo $profile["ProfileID"];?>"  <?php if( $profile["MemberType"] == "Player" ) { echo "checked"; } ?>> <label for="MemberTypePlayer<?php echo $profile["ProfileID"];?>">Player</label> - 
						<input type="radio" name="MemberType" value="Trainer" id="MemberTypeTrainer<?php echo $profile["ProfileID"];?>"  <?php if( $profile["MemberType"] == "Trainer" ) { echo "checked"; } ?>> <label for="MemberTypeTrainer<?php echo $profile["ProfileID"];?>">Trainer</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="mr-auto">
					<button type="submit" name="function" value="DeleteMember" class="btn btn-danger">Remove user from team</button>
				</div>

				<button type="submit" name="function" value="EditMember" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</form>
<?php } ?>
<!-- MODAL FOR EDITING A USER IS ENDED -->


<!-- MODALS FOR EDITING PLAYERS IN THE TEAM -->
<?php foreach( $team["players"] as $profile ) { ?>
<form action="/Overwatch/TeamEdit" method="post">
<input type="hidden" name="TeamID" value="<?php echo $team["TeamID"]; ?>">
<input type="hidden" name="ProfileID" value="<?php echo $profile["ProfileID"]; ?>">

<div class="modal fade" id="ModalEditPlayer<?php echo $profile["ProfileID"]; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Edit user: <?php echo $profile["BattleTag"]; ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3 text-right">Editor:</div>
					<div class="col-sm-9"><input type="radio" name="Editor" value="true" id="EditorTrue<?php echo $profile["ProfileID"];?>" <?php if( $profile["Editor"] == "true" ) { echo "checked"; } ?>>&nbsp;<label for="EditorTrue<?php echo $profile["ProfileID"];?>">Yes</label>&nbsp;-&nbsp;<input type="radio" name="Editor" value="false" id="EditorFalse<?php echo $profile["ProfileID"];?>" <?php if( $profile["Editor"] == "false" ) { echo "checked"; } ?> >&nbsp;<label for="EditorFalse<?php echo $profile["ProfileID"];?>">No</label></div>
				</div>
				<div class="row">
					<div class="col-sm-3 text-right">Class:</div>
					<div class="col-sm-9">
						<input type="radio" name="Class" value="Offense" id="ClassOffense<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Offense" ) { echo "checked"; } ?>> <label for="ClassOffense<?php echo $profile["ProfileID"];?>">Offense</label> - 
						<input type="radio" name="Class" value="Defense" id="ClassDefense<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Defense" ) { echo "checked"; } ?>> <label for="ClassDefense<?php echo $profile["ProfileID"];?>">Defense</label> - 
						<input type="radio" name="Class" value="Support" id="ClassSupport<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Support" ) { echo "checked"; } ?>> <label for="ClassSupport<?php echo $profile["ProfileID"];?>">Support</label> - 
						<input type="radio" name="Class" value="Tank" id="ClassTank<?php echo $profile["ProfileID"];?>"  <?php if( $profile["Class"] == "Tank" ) { echo "checked"; } ?>> <label for="ClassTank<?php echo $profile["ProfileID"];?>">Tank</label> 
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 text-right">Member Type:</div>
					<div class="col-sm-9">
						<input type="radio" name="MemberType" value="Player" id="MemberTypePlayer<?php echo $profile["ProfileID"];?>"  <?php if( $profile["MemberType"] == "Player" ) { echo "checked"; } ?>> <label for="MemberTypePlayer<?php echo $profile["ProfileID"];?>">Player</label> - 
						<input type="radio" name="MemberType" value="Trainer" id="MemberTypeTrainer<?php echo $profile["ProfileID"];?>"  <?php if( $profile["MemberType"] == "Trainer" ) { echo "checked"; } ?>> <label for="MemberTypeTrainer<?php echo $profile["ProfileID"];?>">Trainer</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="mr-auto">
					<button type="submit" name="function" value="DeleteMember" class="btn btn-danger">Remove user from team</button>
				</div>

				<button type="submit" name="function" value="EditMember" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</form>
<?php } ?>
<!-- MODAL FOR EDITING PLAYER ENDED -->




<!-- MODAL FOR ADDING PLAYER TO TEAM -->
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
						<input type="hidden" name="membertype" value="player">
						<label for="BattleTag">BattleTag</label>
						<input type="text" name="BattleTag" id="ModalBattleTag" value="" list="BattleTagList">	
							<datalist id="BattleTagList">
							</datalist>
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
<!-- MODAL FOR ADDING PLAYER END -->