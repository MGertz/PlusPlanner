<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model("User_model");
	}

	public function index() {
		
	}


	public function login() {
		// Tjek om brugeren er logget ind
		if( $this->session->has_userdata("LoggedIn") ) {
			header("Location: /team");
		}

		if( $_SERVER["REQUEST_METHOD"] == "POST" ) {


			$email = $_POST["Email"];
			$password = $_POST["Password"];


			$user = $this->User_model->get_user_by_email($email);

			if( $user ) {

				if( password_verify($password , $user["Password"])) {
					// Perform the session save informations about user.

					$new_session = array(
						"UserID" => $user["UserID"],
						"Admin" => FALSE,
						"LoggedIn" => TRUE
					);

					$this->session->set_userdata($new_session);

					header("Location: /OverWatch/TeamView");




				} else  {
					// Show a message that the password is wrong.	
				}

			} else {
				//SHow a message that tells the user that there is no user with that email, and asks him to create one.
			}




			
		}




		$data = array("sitetitle" => "Login");

		$this->load->view("header",$data);
		$this->load->view("user_login",$data);
		$this->load->view("footer",$data);

	}

	public function signup() {
        // array that is posted into the forms
        $post = array('Username' => '','Firstname' => '','Lastname' => '','Email' => '','Zipcode' => '','Birthday' => '','Gender' => '');


		if( $_SERVER["REQUEST_METHOD"] == "POST") {

            // Merge empty array with the posted informations
            $post = array_merge( $post, $_POST);

            // Print the posted array
			#echo "<pre>";
			#print_r($_POST);
			#echo "</pre>";
			
				
			// load form_validation class
			$this->load->library("form_validation");

			// setup all validation checks
			$this->form_validation->set_rules('Username', 'Brugernavn' , 'required|max_length[255]|is_unique[Users.Username]');
            $this->form_validation->set_rules('Firstname', 'Fornavn' , 'required|max_length[255]');
            $this->form_validation->set_rules('Lastname', 'Efternavn' , 'required|max_length[255]');
            $this->form_validation->set_rules('Password' , 'Kodeord' , 'required|min_length[8]|max_length[255]');
            $this->form_validation->set_rules('Passconf' , 'Kodeord gentag' , 'required|matches[Password]');
            $this->form_validation->set_rules('Email' , 'Email' , 'required|max_length[255]|valid_email|is_unique[Users.Email]');
            $this->form_validation->set_rules('Zipcode' , 'Post nummer' , 'required|numeric');
            $this->form_validation->set_rules('Gender' , 'Køn' , 'required');
            $this->form_validation->set_rules('Birthday' , 'Fødselsdag' , 'required');

            // run the rules compared to the rules
			if( $this->form_validation->run() ) {
                // Lav sql statement som opretter brugeren.

                $insert_id = $this->User_model->add_user($post);

                $data["sitetitle"] = "Signup OK";
        
                $this->load->view("header",$data);
                $this->load->view("user/signup_ok",$data);
                $this->load->view("footer",$data);

            } else {
                $data["sitetitle"] = "Signup";
                $data["post"] = $post;
        
                $this->load->view("header",$data);
                $this->load->view("user/signup",$data);
                $this->load->view("footer",$data);
        
            }
		} else {

            $data["sitetitle"] = "Signup";
            $data["post"] = $post;
    
            $this->load->view("header",$data);
            $this->load->view("user/signup",$data);
            $this->load->view("footer",$data);
        }
        

	}

	public function logout() {
		$unset = array("UserID","Admin","LoggedIn");

		$this->session->unset_userdata($unset);

		header("Location: /");
		exit;
	}



}

?>
