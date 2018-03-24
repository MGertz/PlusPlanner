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
	public function TeamView($id = 0) {
		$data = array("sitetitle" => "PlusPlanner - Team Page");
        $this->load->view("header", $data);
        $this->load->view("OverWatch/TeamView");
        $this->load->view("footer");
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
				$this->load->view("Overwatch/TeamCreate",$data);
				$this->load->view("footer");
			}


		} else {
			$data["post"] = $post;
			$this->load->view("header",$data);
			$this->load->view("Overwatch/TeamCreate",$data);
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




}