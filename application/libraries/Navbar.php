<?php

Class Navbar {

	function __construct() {
		$this->ci =& get_instance();
		$this->ci->load->model("User_model");
	}



	function build() {
		echo $this->ci->user_model->get_userid();
	}











}