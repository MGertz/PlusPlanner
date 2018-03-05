<?php

Class Navbar {

	function __construct() {
		$this->ci =& get_instance();
		$this->ci->load->model("User_model");
	}

	function dbcall() {
		$sql = "SELECT * FROM `Navbar_Games` ORDER BY `Sort`";
		$query = $this->ci->db->query($sql);
		$navbar[0] = array('Text' => "Spil" , 'Title' => 'Vælg et spil på listen', 'URL' => "/");
		foreach( $query->result() as $row ) {
			#$games[] = array('Text'=>$row->Text, 'Title' => $row->Title , 'URL' => $row->URL );
			$navbar[0]["SubMenu"][] = array('Text'=>$row->Text, 'Title' => $row->Title , 'URL' => $row->URL );
		}

	
		$sql = "SELECT * FROM `Navbar_Menu` WHERE `GameID` = '1' AND `ParentID` = '0' ORDER BY `Sort`";
		$query = $this->ci->db->query($sql);
		foreach( $query->result() as $row ) {
			$navbar[$row->Sort] = array('Text' => $row->Text , 'Title' => $row->Title , 'URL' => $row->URL);
	
			$query2 = $this->ci->db->query("SELECT * FROM `Navbar_Menu` WHERE `ParentID` = $row->MenuID");
			if( $query2->num_rows() != 0 ) {
				foreach( $query2->result() as $row2 ) {
					$navbar[$row->Sort]["SubMenu"][$row2->Sort] = array('Text' => $row2->Text , 'Title' => $row2->Title, 'URL' => $row2->URL);
				}
			}
	
		}


		$query = $this->ci->db->query("SELECT * FROM `Navbar_Menu` WHERE `GameID` = '0' AND `ParentID` = '0' ORDER BY `Sort`");
		foreach( $query->result() as $row ) {
			$menu[$row->Sort] = array('Text' => $row->Text , 'Title' => $row->Title , 'URL' => $row->URL);
	
			$query2 = $this->ci->db->query("SELECT * FROM `Navbar_Menu` WHERE `ParentID` = $row->MenuID");
			if( $query2->num_rows() != 0 ) {
				foreach( $query2->result() as $row2 ) {
					$menu[$row->Sort]["SubMenu"][$row2->Sort] = array('Text' => $row2->Text , 'Title' => $row2->Title, 'URL' => $row2->URL);
				}
			}
	
		}
		$navbar = array_merge($navbar,$menu);

		return $navbar;
	}



	function build() {
		#echo $this->ci->user_model->get_userid();


		$navbar = $this->dbcall();

		foreach( $navbar as $nav) {

			
			
			if( isset($nav["SubMenu"])   ) {
				echo "<li class='nav-item dropdown'>";
				echo "<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>".$nav["Text"]."</a>";
				echo "<div class='dropdown-menu'>";
					foreach($nav["SubMenu"] as $sub ) {
						echo "<a class='dropdown-item' href='".$sub["URL"]."'>".$sub["Text"]."</a>"; 

					}
				echo "</div>";


			} else {
				echo "<li class='nav-item'>";
				echo "<a class='nav-link' href='".$nav["URL"]."'>".$nav["Text"]."</a>";
			}
			
			
			
			echo "</li>";

		}


/*

		

			
				<li class="nav-item active">
					<a class="nav-link" href="/">Forside</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/scrim/finder">Scrim Finder</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/team/index">Team</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/profile">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/user/logout">Logout</a>
				</li>
		


		*/
	}











}