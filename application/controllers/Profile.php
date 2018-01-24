<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();

        
        // Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
        $this->load->model("user_model");
        $this->user_model->is_user_logged_in();

    }



    public function index() {
        $data = array("sitetitle" => "PlusPlanner - Profile Page");
        $this->load->view("header", $data);
        $this->load->view("profile/index");
        $this->load->view("footer");
    }


}