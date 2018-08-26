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

    /*
     * This functions add user to database.
     */
    public function add_user($user = array() ) {

        unset($user["Passconf"]);
        unset($user["EULA"]);


        if( isset($user["Newsletter"]) && $user["Newsletter"] == true) {
            $user["EmailSubscription"] = "true";
        } else {
            $user["EmailSubscription"] = "false";
        }

        $user["LastLogin"] = "0000-00-00 00:00:00";


        $user["Password"] = password_hash($user["Password"],PASSWORD_BCRYPT);

        $this->db->insert('Users',$user);

        $id = $this->db->insert_id();

        return $id;


    }

    /*
     * Function checks weather a user is logged in or not.
     * If Not, user is forwarded to /user/login
     */
    public function is_user_logged_in() {
        // Tjek om brugeren er logget ind
           if( $this->session->has_userdata("LoggedIn") == false ) {
            header("Location: /User/Login");
            exit;
        }
    }

    /*
     * Function to get UserID from the user whos logged in.
     * If no user is logged in, it will return false.
     */
    public function get_userid() {
        if( $this->session->has_userdata("UserID") == false ) {
            return false;
        } else {
            return $this->session->userdata("UserID");
        }
    }

    
    public function get_user_by_id($id = "")  {
        if( $id == "" ) {
            $id = $this->get_userid();
        }

        return $id;

    }










}