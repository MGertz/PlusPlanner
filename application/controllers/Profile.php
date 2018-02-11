<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();

		
		// Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
		$this->load->model("user_model");
		$this->user_model->is_user_logged_in();

		$this->load->model("overwatch");

	}



	public function index() {

		$profileID = $this->overwatch->get_profileid_by_userid();
		
		if( $profileID == false ) {

			echo "ProfileID: ". $profileID;
			header("Location: /profile/create");
			exit;
		}




		$data = array("sitetitle" => "PlusPlanner - Profile Page");
		$this->load->view("header", $data);
		$this->load->view("profile/index");
		$this->load->view("footer");
	}


	public function create() {

		$post = array("BattleTag" => "");

		if( $_SERVER["REQUEST_METHOD"] == "POST") {



			$post = array_merge($post , $_POST );

			$this->load->library("form_validation");

			// setup all validation checks
			$this->form_validation->set_rules('BattleTag', 'BattleTag' , 'required|max_length[255]|is_unique[Overwatch_Profile.BattleTag]');
            
           if( $this->form_validation->run() ) {
                $this->overwatch->add_profile($post);

                header("Location: /profile/");
                exit;


            } else {
                $data = array("sitetitle" => "PlusPlanner - Profile Create");
                $data["post"] = $post;
                $this->load->view("header", $data);
                $this->load->view("profile/create", $data);
                $this->load->view("footer");
            }



		} else {
			$data = array("sitetitle" => "PlusPlanner - Profile Create");
			$data["post"] = $post;
			$this->load->view("header", $data);
			$this->load->view("profile/create", $data);
			$this->load->view("footer");




		}
	}


}