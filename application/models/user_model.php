<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This class is used to collect data from database regarding users.
 */


class User_model extends CI_model {



    public function get_user_by_email($email) {

        $sql = "SELECT * FROM `Users` WHERE `Email` = '" . $email . "'";

        $query = $this->db->query($sql);

        if( $query->num_rows() != 0 ) {

            foreach( $query->result() as $row ) {
                $user["UserID"] = $row->UserID;
                $user["Username"] = $row->Username;
                $user["Email"] = $row->Email;
                $user["Password"] = $row->Password;
                $user["Birthday"] = $row->Birthday;
            }
            return $user;
        } else {
            return false;
        }
    }














}