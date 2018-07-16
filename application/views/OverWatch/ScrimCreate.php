<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 box-outer">
			<h2>Opret Scrim</h2>


			<?php
				/*
				if( function_exists("validation_errors" ) ) {

					$errors = validation_errors('|','|');
			
					$errors = explode("|",$errors);
	
					if( isset( $errors[1] ) ) {
						echo '<div class="alert alert-danger" role="alert">Advarsel: ';
						echo $errors[1];
						echo '</div>';
					}

				}
				*/
			?>
		
		
			<form method="post">
			
				<div class="form-group row">
					<label for="TeamID" class="col-sm-3 control-label">Hold:</label>
					<div class="col-sm-9">
						<select name="TeamID" id="TeamID" class="formcontrol">
						<?php

							print_r($teams);

							foreach($teams as $key => $val ) {
								echo "<option value=\"".$key."\">".$val."</option>";

							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="starttime" class="col-sm-3 control-label">Start tid:</label>
					<div class="col-sm-9 date  input-group">
						<input type="text" id="ScrimCreateDatePicker" value="" placeholder="Vælg dato" class="form-control" autocomplete="off" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						<input type="hidden" id="DatetimePickerHidden" name="StartTime" value="">
						
					</div>
				</div>
				<div class="form-group row">
					<label for="playtime" class="col-sm-3 control-label">Spille tid:</label>
					<div class="col-sm-9">
						<select name="playtime" id="playtime" class="form-control">
							<option value="1">1 time</option>
							<option value="1,5">1 time 30 minuter</option>
							<option value="2">2 timer</option>
							<option value="2,5">2 timer 30 minuter</option>
							<option value="3">3 timer</option>
							<option value="3,5">3 timer 30 minuter</option>
							<option value="4" selected>4 timer</option>
							<option value="4,5">4 timer 30 minuter</option>
							<option value="5">5 timer</option>
							<option value="5,5">5 timer 30 minuter</option>
							<option value="6">6 timer</option>
							<option value="6,5">6 timer 30 minuter</option>
							<option value="7">7 timer</option>
							<option value="7,5">7 timer 30 minuter</option>
							<option value="8">8 timer</option>
							<option value="8,5">8 timer 30 minuter</option>
							<option value="9">9 timer</option>
							<option value="9,5">9 timer 30 minuter</option>
							<option value="10">10 timer</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="SRmin" class="col-sm-3 control-label">SR minimum:</label>
					<div class="col-sm-9">
						<select id="SRmin" name="SRmin" class="form-control">
							<option value="0" selected>0</option>
							<option value="1500">1500</option>
							<option value="2000">2000</option>
							<option value="2500">2500</option>
							<option value="3000">3000</option>
							<option value="3500">3500</option>
							<option value="4000">4000</option>
							<option value="10000">Over 4000</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="SRmax" class="col-sm-3 control-label">SR Maximum:</label>
					<div class="col-sm-9">
					<select id="SRmax" name="SRmax" class="form-control">
							<option value="0">0</option>
							<option value="1500">1500</option>
							<option value="2000">2000</option>
							<option value="2500">2500</option>
							<option value="3000">3000</option>
							<option value="3500">3500</option>
							<option value="4000">4000</option>
							<option value="10000" selected>Over 4000</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="comment" class="col-sm-3 control-label">Kommentar:</label>
					<div class="col-sm-9">
						<textarea name="Comment" id="comment" placeholder="Skriv en kommentar" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary btn-block">Opret</button>
						</div>
				</div>
			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>