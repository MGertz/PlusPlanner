<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This class is used to collect data from database regarding users.
 */


class Overwatch extends CI_model {

	function __construct() {
		parent::__construct();

		//Load user_model
        $this->load->model("user_model");

	}



	public function get_profileid_by_userid($userid = "") {
		
		if ( $userid == "" ) {
			$userid = $this->user_model->get_userid();
		}

		$sql = "SELECT * FROM `Overwatch_Profile` WHERE `User_ID` = '" . $userid . "'";
		$query = $this->db->query($sql);

		if( $query->num_rows() != 0 ) {
			
			foreach( $query->result() as $row) {
				$profileID = $row->ID;
			}
		} else {
			$profileID = false;
		}


		return $profileID;
	}


	public function add_profile($profile) {


		$profile["User_ID"] = $this->user_model->get_userid();

		$this->db->insert( "Overwatch_Profile" , $profile );
		



	}














}
