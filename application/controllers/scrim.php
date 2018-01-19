<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrim extends CI_Controller {

  

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