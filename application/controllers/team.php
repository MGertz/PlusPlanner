<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class team extends CI_Controller {


    public function index() {
        $data = array("sitetitle" => "PlusPlanner - Team Page");
        $this->load->view("header", $data);
        $this->load->view("team/index");
        $this->load->view("footer");
    }




}