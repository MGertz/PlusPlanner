<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


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


            $this->load->model("User_model");

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

                    header("Location: /team/index");




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


    public function logout() {
        $unset = array("UserID","Admin","LoggedIn");

        $this->session->unset_userdata($unset);

        header("Location: /");
        exit;
    }



}

?>