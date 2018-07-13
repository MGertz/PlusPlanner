<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OverWatch extends CI_Controller {

	public function __construct() {
		parent::__construct();

		
		// Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
		$this->load->model("user_model");
		$this->user_model->is_user_logged_in();

		$this->load->model("OverwatchModel");

		// Hent de hold som brugeren er med i.
		$this->ProfileID = $this->OverwatchModel->get_profileid_by_userid();


	}

	/* Function is used to make sure / is catched and directed to /OverWatch/ProfileView */
	public function index() {
		header("Location: /OverWatch/ProfileView");
		exit;
	}

	/* PORTED */
	public function TeamView($TeamID=0) {
		if( $TeamID == 0 ) {
			// Sæt denne streng for senere at kunne tjekke
			$TeamID = 0;

			// Tjek om der er postet til siden eller ej.
			if( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["ChangeTeam"] == "true"  ) {
				// Hvis det er postet til siden, så hent det nye teamid fra $_POST.
				#print_r($_POST);
							
				$TeamID = $_POST["TeamID"];
				
			} else {
				// Hvis siden er hentet via get, så hent TeamID ud fra brugeren som er logget på
				$TeamID = $this->OverwatchModel->get_teamid_by_profileid();
			}
			
			if( $TeamID != false ) {
				header("Location: /OverWatch/TeamView/".$TeamID);
				exit;
			} else {
				echo "Brugeren er ikke medlem af et team endnu";
				exit;
			}
		}

		// OVerfør teamID til frontend
		$data["TeamID"] = $TeamID;


		// Hent info om hvorvidt brugeren må redigere i holdet.
		$sql = "SELECT * FROM `Overwatch_Team_Profile` WHERE `ProfileID` = '".$this->ProfileID."' AND `TeamID` = '".$TeamID."' AND `Editor` = true";
		$query = $this->db->query($sql);
		if( $query->num_rows() != 0 ) {
			$data["Editor"] = true;
		} else {
			$data["Editor"] = false;
		}





		$team = $this->OverwatchModel->getteam($TeamID);

		if( $team == false ) {
			header("Location: /OverWatch/TeamCreate");
			exit;
		}


		$sql = "SELECT * FROM `Overwatch_Team_Profile` INNER JOIN `Overwatch_Teams` ON `Overwatch_Team_Profile`.`TeamID` = `Overwatch_Teams`.`ID` WHERE `Overwatch_Team_Profile`.`ProfileID` = '".$this->ProfileID."'";

		$query = $this->db->query($sql);
		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {
				$teams[] = array(
					"TeamID" => $row->TeamID,
					"Name" => $row->Name
				);
			}
		}
	
		$data["sitetitle"] = "Plusplanner - Team Page";
		$data["team"] = $team;
		$data["Teams"] = $teams;
        $this->load->view("header", $data);
        $this->load->view("OverWatch/TeamView");
        $this->load->view("footer");
	}

	public function TeamEdit() {
		if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
			echo "<pre>";
			print_r($_POST);
			

			$post = $_POST;

			$function = $post["function"];


			/*
			 * Denne del af funktionen tilføjer en spiller til holdet
			 */
			if( $function == "addplayer") {
				$BattleTag = $post["BattleTag"];

				// Hent profil data på den profil som skal tilmeldes holdet
				$profile = $this->OverwatchModel->get_profile("BattleTag", $BattleTag );

				// Tjek om spilleren allerede er medlem at holdet.



				// Tilføj spilleren til holdet
				$insert = array(
					"ProfileID" => $profile["ProfileID"],
					"TeamID" => $post["TeamID"],
					"Player" => "true"

				);
				$this->OverwatchModel->add_player_to_team($insert);

				header("Location: /OverWatch/TeamView/".$post["TeamID"]);
				exit;

			}



			/*
			 * Denne function redigerer en bruger på holdet
			 */
			if( $function == "EditMember") {
				
				$update = array(
					"Class" => "Offense",
					"Trainer" => "false",
					"Player" => "false",
					"Substitute" => "false",
					"Editor" => "false"
				);

				$update["Editor"] = $post["Editor"];
				$update["Class"] = $post["Class"];

				if( $post["MemberType"] == "Player") {
					$update["Player"] = "true";
				}
				if( $post["MemberType"] == "Trainer") {
					$update["Trainer"] = "true";
				}

				


				$this->OverwatchModel->update_team($post["TeamID"] , $post["ProfileID"] , $update);

				header("Location: /OverWatch/TeamView/".$post["TeamID"]);
				exit;

			}

			/*
			 * Denne function gemmer beskrivelsen af holdet
			 */

			if( $function == "EditDescription") {
				$teamid = $post["TeamID"];

				$description = $this->db->escape_str($post["description"]);


				$update = "UPDATE `Overwatch_Teams` SET `Description` = '".$description."' WHERE `Overwatch_Teams`.`ID` = '".$teamid."'";
				$this->db->query($update);

				header("Location: /OverWatch/TeamView/".$teamid);
				exit;
				
			}


			/*
			 * Denne function sletter en bruger fra holdet
			 */
			if( $function == "DeleteMember") {
				$teamid = $post["TeamID"];
				$profileid = $post["ProfileID"];

				$result = $this->OverwatchModel->delete_profile_from_team($post["TeamID"] , $post["ProfileID"]);

				header("Location: /OverWatch/TeamView/".$post["TeamID"]);
				exit;


			}




		






		} else {
			header("Location: /OverWatch/Teamview");
			exit;
		}

	}

	public function TeamSearch( $search = "" ) {
		// Set array så det senere kan sendes.
		$teams = array();

		if( $_SERVER["REQUEST_METHOD"] == "POST" )  {
			$search = trim($_POST["search"]);
			

			header("Location: /Overwatch/TeamSearch/".$search);
			exit;
		}

		if( $search != "" ) {

			$search = $this->db->escape_like_str($search);

			$sql = "SELECT * FROM `Overwatch_Teams` WHERE `Name` LIKE '%".$search."%'";

			$query = $this->db->query($sql);
			if( $query->num_rows() != 0 ) {
				foreach( $query->result() as $row ) {
					$teams[$row->ID] = array(
						"TeamID" => $row->ID,
						"Name" => $row->Name
					);
				}
			}
		}


		$data["Search"] = $search;
		$data["Teams"] = $teams;
		$data["sitetitle"] = "Plusplanner - Team Search";
		$this->load->view("header",$data);
		$this->load->view("Overwatch/TeamSearch",$data);
		$this->load->view("footer");

	}

	public function TeamCreate() {

		$post = array("TeamName" => "");
		$data = array("sitetitle" => "PlusPlanner - Team Create");


		if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
			$post = array_merge($post , $_POST);

			$this->load->library("form_validation");

			// Setup validation checks
			$this->form_validation->set_rules("TeamName", "Holdnavn" , "required|max_length[255]|is_unique[Overwatch_Teams.Name]");

			if( $this->form_validation->run() ) {
				$teamid = $this->OverwatchModel->add_team($post["TeamName"]);
				header("Location: /OverWatch/TeamView?id=".$teamid);
				exit;
			} else {
				$data["post"] = $post;
				$this->load->view("header",$data);
				$this->load->view("OverWatch/TeamCreate",$data);
				$this->load->view("footer");
			}


		} else {
			$data["post"] = $post;
			$this->load->view("header",$data);
			$this->load->view("OverWatch/TeamCreate",$data);
			$this->load->view("footer");
		}
	}

	/* PORTED */
	public function ScrimSearch() {
        $data = array("sitetitle" => "PlusPlanner - Scrim Finder");
        $this->load->view("header", $data);
        $this->load->view("OverWatch/ScrimSearch");
        $this->load->view("footer");
	}

	public function ScrimCreate() {
		// TJek om der postes til siden, og lav så opret koden
		if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
			echo "<pre>";
			print_r($_POST);

			$TeamID = $_POST["TeamID"];
			$starttime = $_POST["starttime"];
			$playtime = $_POST["playtime"];
			$SRmax = $_POST["SRmax"];
			$SRmin = $_POST["SRmin"];
			$Comment = $_POST["Comment"];



			// Beregn slut tid.
			$tid = explode(",", $playtime);

			$date = new DateTime($starttime);
			if( count($tid) == 1 ) {
				$date->add( new DateInterval('PT'.$tid[0].'H'));
			} else {
				$date->add( new DateInterval('PT'.$tid[0].'H30M'));
			}
			$endtime = $date->format("Y-m-d H:i:s");


			// Tjek om holdet allerede har en kamp igang i det tidspum.
			$sql = "SELECT * FROM `Overwatch_Scrim_Team`
					INNER JOIN `Overwatch_Scrim` ON `Overwatch_Scrim_Team`.`Scrim_ID` = `Overwatch_Scrim`.`Scrim_ID`
					WHERE `Overwatch_Scrim_Team`.`Team_ID` = ".$TeamID."
			";
			/* DENNE FUNKTON ER ENDNU IKKE LAVET FÆRDIGT!
			*/
			
			$insert = array(
				"Time_Start" => $starttime,
				"Time_End" => $endtime,
				"SR_Min" => $SRmin,
				"SR_Max" => $SRmax,
				"Type" => "5vs5",
				"Comment" => $Comment,
				"Status" => "Planned",
				"Created" => date("Y-m-d H:i:s"),
				"Created_By_Profile_ID" => $this->ProfileID
			);

			$this->db->insert("Overwatch_Scrim", $insert);

			$ScrimID = $this->db->insert_id();

			$insert = array(
				"Scrim_ID" => $ScrimID,
				"Team_ID" => $TeamID,
				"Status" => "Owner",
				"Time" => date("Y-m-d H:i:s"),
				"Created_By_Team_ID" => $TeamID
			);

			$this->db->insert("Overwatch_Scrim_Team",$insert);

			header("Location: /Overwatch/Scrims");
			exit;


		}





		$data = array("sitetitle" => "PlusPlanner - Scrim Opret");

		// Hent de hold som brugeren er med i.
		$profileID = $this->OverwatchModel->get_profileid_by_userid();

		$sql = "SELECT * FROM `Overwatch_Team_Profile`
				INNER JOIN Overwatch_Teams ON Overwatch_Team_Profile.TeamID = Overwatch_Teams.ID
				WHERE `Overwatch_Team_Profile`.`ProfileID` = '".$this->ProfileID."' AND `Overwatch_Team_Profile`.`Editor` = 'true' ;";

		$query = $this->db->query($sql);

		if( $query->num_rows() != 0 ) {
			foreach( $query->result() as $row ) {

				$teams[$row->TeamID] = $row->Name;

			}
		}

		$data["teams"] = $teams;


		$this->load->view("header", $data);
		$this->load->view("OverWatch/ScrimCreate", $data);
		$this->load->view("footer", $data);






	}

	public function Scrims() {


		$sql = "SELECT * FROM `Overwatch_Scrim` 
				INNER JOIN `Overwatch_Scrim_Team` ON `Overwatch_Scrim_Team`.`Scrim_ID` = `Overwatch_Scrim`.`Scrim_ID`
				WHERE `Time_End` >= '".date("Y-m-d H:i:s")."' AND `Overwatch_Scrim_Team`.`Status` = 'Owner'";
		//echo $sql;
		$query = $this->db->query($sql);

		if( $query->num_rows() != 0 ) {

			foreach( $query->result() as $row) {

				$sql2 = "SELECT * FROM `Overwatch_Teams` WHERE `ID` = '".$row->Team_ID."'";
				$query2 = $this->db->query($sql2);
				foreach( $query2->result() as $row2 ) {
					$TeamName = $row2->Name;
				}
				



				$scrims[] = array(
					"Scrim_ID" => $row->Scrim_ID,
					"Time_Start" => $row->Time_Start,
					"Time_End" => $row->Time_End,
					"Status" => $row->Status,
					"TeamName" => $TeamName
				);
			}
		}


		$data = array('sitetitle' => 'OverWatch Scrims');
		$data["Scrims"] = $scrims;
		$this->load->view('header', $data);
		$this->load->view("OverWatch/Scrims",$data);
		$this->load->view('footer');



	}

	/* PORTED */
	public function ProfileView($id = 0) {

		$profileID = $this->OverwatchModel->get_profileid_by_userid();
		
		if( $profileID == false ) {

			echo "ProfileID: ". $profileID;
			header("Location: /OverWatch/ProfileCreate");
			exit;
		}




		$data = array("sitetitle" => "PlusPlanner - Profile Page");
		$this->load->view("header", $data);
		$this->load->view("OverWatch/ProfileView");
		$this->load->view("footer");

		

	}

	public function ProfileSearch($search = "" ) {
		// Set array så det senere kan sendes.
		$profiles = array();

		if( $_SERVER["REQUEST_METHOD"] == "POST" )  {
			$search = trim($_POST["search"]);
			

			header("Location: /Overwatch/ProfileSearch/".$search);
			exit;
		}

		if( $search != "" ) {

			$search = $this->db->escape_like_str($search);

			$sql = "SELECT * FROM `Overwatch_Profile` WHERE `BattleTag` LIKE '%".$search."%'";

			$query = $this->db->query($sql);
			if( $query->num_rows() != 0 ) {
				foreach( $query->result() as $row ) {
					$profiles[$row->ProfileID] = array(
						"ProfileID" => $row->ProfileID,
						"BattleTag" => $row->BattleTag,
						"SR" => $row->SR
					);
				}
			}
		}


		$data["Search"] = $search;
		$data["Profiles"] = $profiles;
		$data["sitetitle"] = "Plusplanner - Profile Search";
		$this->load->view("header",$data);
		$this->load->view("Overwatch/ProfileSearch",$data);
		$this->load->view("footer");
	}

	/* PORTED */
	public function ProfileCreate() {

		$post = array("BattleTag" => "");

		if( $_SERVER["REQUEST_METHOD"] == "POST") {



			$post = array_merge($post , $_POST );

			$this->load->library("form_validation");

			// setup all validation checks
			$this->form_validation->set_rules('BattleTag', 'BattleTag' , 'required|max_length[255]|is_unique[Overwatch_Profile.BattleTag]');
            
           if( $this->form_validation->run() ) {
                $this->OverwatchModel->add_profile($post);

                header("Location: /OverWatch/ProfileView");
                exit;


            } else {
                $data = array("sitetitle" => "PlusPlanner - Profile Create");
                $data["post"] = $post;
                $this->load->view("header", $data);
                $this->load->view("OverWatch/ProfileCreate", $data);
                $this->load->view("footer");
            }



		} else {
			
			$data = array("sitetitle" => "PlusPlanner - Profile Create");
			$data["post"] = $post;
			$this->load->view("header", $data);
			$this->load->view("OverWatch/ProfileCreate", $data);
			$this->load->view("footer");




		}

		
	}


	public function api_get_battletags($search = "") {
		header('Content-Type: application/json');
		if( strlen($search) <= 2 ) {
			
			echo "[]";
		} else {
				

			$sql = "SELECT * FROM `Overwatch_Profile` WHERE `BattleTag` LIKE '%".$search."%' ORDER BY `Overwatch_Profile`.`BattleTag` ASC";
			$query = $this->db->query($sql);

			if( $query->num_rows() != 0 ) {

				foreach( $query->result() as $row ) {
					$option[] = $row->BattleTag;
				}

				#return $option;
			} else {
				$option[] = "";
			}

			
			echo json_encode($option);
		}

	}




}