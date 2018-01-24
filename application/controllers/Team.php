<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

    public function __construct() {
        parent::__construct();

        
        // Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
        $this->load->model("user_model");
        $this->user_model->is_user_logged_in();

    }

    public function index() {
        $data = array("sitetitle" => "PlusPlanner - Team Page");
        $this->load->view("header", $data);
        $this->load->view("team/index");
        $this->load->view("footer");
    }

}