<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OverWatch extends CI_Controller {

	public function __construct() {
		parent::__construct();

		
		// Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
		$this->load->model("user_model");
		$this->user_model->is_user_logged_in();

		$this->load->model("OverwatchModel");

	}

	/* Function is used to make sure / is catched and directed to /OverWatch/ProfileView */
	public function index() {
		header("Location: /OverWatch/ProfileView");
		exit;
	}

	/* PORTED */
	public function TeamView($id=0) {
		if( $id == 0 ) {
			$teamid = $this->OverwatchModel->get_teamid_by_profileid();

			if( $teamid != false ) {
				header("Location: /OverWatch/TeamView/".$teamid);
				exit;
			} else {
				echo "Brugeren er ikke medlem af et team endnu";
				exit;
			}
		}

		$team = $this->OverwatchModel->getteam($id);

		if( $team == false ) {
			header("Location: /OverWatch/TeamCreate");
			exit;
		}




		$data = array("sitetitle" => "PlusPlanner - Team Page", "team" => $team);
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

	public function TeamSearch() {

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

	public function ProfileSearch() {

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