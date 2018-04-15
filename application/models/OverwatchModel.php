<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This class is used to collect data from database regarding users.
 */


class OverwatchModel extends CI_model {

	function __construct() {
		parent::__construct();

		//Load user_model
        $this->load->model("user_model");

	}



	/*
	 *
	 */ 
	public function get_profileid_by_userid($userid = 0) {
		
		if ( $userid == 0 ) {
			$userid = $this->user_model->get_userid();
		}

		$sql = "SELECT * FROM `Overwatch_Profile` WHERE `User_ID` = '" . $userid . "'";
		$query = $this->db->query($sql);

		if( $query->num_rows() != 0 ) {
			
			foreach( $query->result() as $row) {
				$profileID = $row->ProfileID;
			}
		} else {
			$profileID = false;
		}


		return $profileID;
	}


	/*
	 *
	 */ 
	public function add_profile($profile) {


		$profile["User_ID"] = $this->user_model->get_userid();

		$this->db->insert( "Overwatch_Profile" , $profile );
	}


	/*
	 *
	 */ 
	public function add_team($teamname) {
		// Hent profilID på denne bruger
		$profileID = $this->get_profileid_by_userid();


		// Opret holdet i databasen
		$team = array("Name" => $teamname, "Created" => date("Y-m-d H:i:s"), "CreatedBy" => $profileID, "Owner" => $profileID);
        $this->db->insert('Overwatch_Teams',$team);
		$id = $this->db->insert_id();
		

		// Her indsættes profilen som oprettede holdet som spiller på holdet, og han gives rettigheder til at redigere holdet
		$insert = array(
				"TeamID" => $id,
				"ProfileID" => $profileID,
				"Trainer" => "true",
				"Player" => "false",
				"Substitute" => "false",
				"Editor" => "true",
				"DateAdded" => date("Y-m-d H:i:s"),
				"AddedBy" => $profileID,
				"Sort" => 1
		);
		$this->db->insert("Overwatch_Team_Profile", $insert);
		

		// Returner ID på dette hold.
        return $id;
	}


	/*
	 *
	 */ 
	public function getteam( $id = 0 ) {

		$sql = 'SELECT * FROM `Overwatch_Teams` WHERE `id` = '.$id;
		$query = $this->db->query($sql);


		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {
				$team["Name"] = $row->Name;
				$team["Description"] = $row->Description;
				$team["TeamID"] = $row->ID;
			}
		} else {
			return false;
			
		}

		$team["trainers"] = array();
		$team["players"] = array();



		/* Koden som henter trænere til holdet */
		$sql = "SELECT * FROM `Overwatch_Team_Profile` INNER JOIN `Overwatch_Profile` on `Overwatch_Team_Profile`.`ProfileID` = `Overwatch_Profile`.`ProfileID` WHERE `TeamID` = '".$id."' AND `Trainer` = true ORDER BY `Sort`";
	
		$query = $this->db->query($sql);

		$arrayline = 0;

		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {

				if( $row->Avatar == "" ) {
					$avatar = "https://robohash.org/".$row->BattleTag.".png";
				} else {
					$avatar = $row->Avatar;
				}

				// Disse IF statements bruges på i modal til edit af melmed
				if( $row->Trainer == "true") {
					$membertype = "Trainer";
				}
				if( $row->Player == "true") {
					$membertype = "Player";
				}

				$team["trainers"][$arrayline] = array(
					"BattleTag" => $row->BattleTag,
					"ProfileID" => $row->ProfileID,
					"Class" => $row->Class,
					"Avatar" => $avatar,				
					"Editor" => $row->Editor,
					"Badge" => 4,
					"SR" => $row->SR,
					"MemberType" => $membertype
				);
				$arrayline++;
			}
		}
		

		// Nulstil array listen
		$arrayline = 0;
		/* Koden som henter spillere til holdet */
		$sql = "SELECT * FROM `Overwatch_Team_Profile` INNER JOIN `Overwatch_Profile` on `Overwatch_Team_Profile`.`ProfileID` = `Overwatch_Profile`.`ProfileID` WHERE `TeamID` = '".$id."' AND `Player` = true ORDER BY `Sort`";
		$query = $this->db->query($sql);

		$trainerline = 0;

		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {

				if( $row->Avatar == "" ) {
					$avatar = "https://robohash.org/".$row->BattleTag.".png";
				} else {
					$avatar = $row->Avatar;
				}

				// Disse IF statements bruges på i modal til edit af melmed
				if( $row->Trainer == "true") {
					$membertype = "Trainer";
				}
				if( $row->Player == "true") {
					$membertype = "Player";
				}

				$team["players"][$arrayline] = array(
					"BattleTag" => $row->BattleTag,
					"ProfileID" => $row->ProfileID,
					"Class" => $row->Class,
					"Avatar" => $avatar,
					"Editor" => $row->Editor,
					"Badge" => 4,
					"SR" => $row->SR,
					"MemberType" => $membertype
				);
				$arrayline++;
			}
		}

		return $team;
	}

	/*
	 *
	 */ 
	public function get_teamid_by_profileid($profileid = 0 ) {
		if( $profileid == 0 ) {
			$profileid = $this->get_profileid_by_userid();
		}
		$query = $this->db->query("SELECT * FROM `Overwatch_Team_Profile` WHERE `ProfileID` = '".$profileid."' LIMIT 1");

		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {
				$teamid = $row->TeamID;
			}
		} else {
			$teamid = false;
		}

		return $teamid;

	}


	/*
	 * Hent profil info ud fra det søgte felt
	 */ 
	public function get_profile($key = "", $val = "") {
		if( $key == "" ) {
			$key = "User_ID";
			$val = $this->user_model->get_userid();
		}

		$sql = "SELECT * FROM `Overwatch_Profile` WHERE `".$key."` = '".$val."' ORDER BY 'BattleTag'	";
		$query = $this->db->query($sql);

		if( $query->num_rows() != 0 ) {

			foreach( $query->result() as $row ) {
				$profile = array(
					"ProfileID" => $row->ProfileID,
					"UserID" => $row->User_ID,
					"BattleTag" => $row->BattleTag,
					"Avatar" => $row->Avatar,
					"SR" => $row->SR
				);
			}


			return $profile;

		} else {
			return false;
		}
	}

	/*
	 * Tilføj spiller til et hold
	 */
	public function add_player_to_team($insert) {
		$profile = $this->get_profile();

		$default = array(
			"TeamID" => NULL,
			"ProfileID" => NULL,
			"Trainer" => "false",
			"Player" => "false",
			"Substitute" => "false",
			"Editor" => "false",
			"DateAdded" => date("Y-m-d H:i:s"),
			"AddedBy" => $profile["UserID"],
			"Sort" => 6
		);

		$insert = array_merge($default,$insert);

		$this->db->insert("Overwatch_Team_Profile",$insert);


	}


	/*
	 *
	 */ 
	public function delete_profile_from_team($TeamID = "", $ProfileID = "") {

		$sql = "DELETE FROM `Overwatch_Team_Profile` WHERE `TeamID` = '".$TeamID."' AND `ProfileID` = '".$ProfileID."'";
		$query = $this->db->query($sql);

		return $query;
		
	}

	public function update_team($TeamID , $ProfileID  , $update ) {

		$sql = "UPDATE `Overwatch_Team_Profile` SET ";


		// Tæl hvor mange ting som skal ændres
		$count = count($update)-1;

		// $i bruges til at tælle hvor mange gange der er loopet igennem $update for at sætte , (komma) efter hver enkelt, så sql virker
		$i = 0;

		// Gennemløb $update array
		foreach( $update as $key => $val ) {
			$sql .= "`".$key."` = '".$val."'";
			if( $i != $count ) {
				$sql .= ", ";
			}


			$i++;
		}

		$sql .= " WHERE `ProfileID` = '".$ProfileID."' AND `TeamID` = '".$TeamID."'";

		$query = $this->db->query($sql);
		

	//	UPDATE `Overwatch_Team_Profile` SET `Trainer` = 'true', `Editor` = 'false' WHERE `Overwatch_Team_Profile`.`ID` = 8;



	}

}

