<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrim extends CI_Controller {

    public function __construct() {
        parent::__construct();

        
        // Tjek om brugeren er logget ind, hvis ikke sendes brugeren til login siden.
        $this->load->model("user_model");
        $this->user_model->is_user_logged_in();

    }


    public function index() {
        header("Location: /scrim/finder");
    }


    public function finder() {
        $data = array("sitetitle" => "PlusPlanner - Scrim Finder");
        $this->load->view("header", $data);
        $this->load->view("scrim/finder");
        $this->load->view("footer");

    }


    public function create() {



    }


    public function view() {



    }

    public function delete() {


    }

}
