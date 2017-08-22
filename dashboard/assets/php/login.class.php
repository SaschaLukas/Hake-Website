<?php
class login {
	
	var $connection;
	var $users;
	var $groups;
	var $errors;
	var $exits;
	var $session;
	var $timestamp;
	var $database;
	
	public function __construct($errors = false, $exits = false, $session = true){
		
		date_default_timezone_set("Europe/Berlin");
		$this->timestamp = date("[d.m.Y - H:i:s]",time());
		
		$this->errors = $errors;
		$this->exits = $exits;
		$this->session = $session;
		if($session == true){
			session_start();
			session_regenerate_id();
		}
	}
	
	
	private function error($tag){
		if($this->errors == true){
			$perm_name = "TimoPerm";
			$perm_vers = "0.1";
			echo "\n\n";
			echo "[".$perm_name." - ".$perm_vers."] ERROR: ";
			switch($tag){
				case "Database":
					echo "Es konnte keine Verbindung zur Datenbank hergestellt werden";
				break;
				case "TableExist":
					echo "Die Tabelle(n) existieren bereits";
				break;
				case "vars":
					echo "Es wurden nicht alle Erforderlichen Variablen angegeben";
				break;
				case "noTables":
					echo "Es wurden nicht alle erforderlichen MySQL Tabellen gefunden";
				break;
				case "userExist":
					echo "Es existiert bereits ein User mit diesem Namen";
				break;
				case "userNotExist":
					echo "Es existiert kein ein User mit diesem Namen";
				break;
			}
			echo "!<br>\n";
		}
		if($this->exits == true){
			exit;
		}
	}
	
	public function setMYSQL($host = "", $user = "", $pw = "", $database = ""){
		if($host != "" AND $user != "" AND $database != ""){
			@$this->connection = new mysqli($host, $user, $pw, $database);
			$this->database = $database;
			if($this->connection->connect_error){
				$this->error("Database");
			}
		}else{
			$this->error("vars");
		}
	}
	
	private function checkTables(){
		$array = array();
		$query = $this->connection->query("SHOW TABLES FROM ".$this->database)->fetch_all();
		foreach($query as $tables){
			array_push($array, $tables[0]);
		}
		if(in_array("list", $array) AND in_array("groups", $array)){
			return true;
		}
	}
	
	public function createTables(){
		if($this->connection != NULL){
			$array = array();
			$query = $this->connection->query("SHOW TABLES FROM ".$this->database)->fetch_all();
			foreach($query as $tables){
				array_push($array, $tables[0]);
			}
			if(!in_array("list", $array) AND !in_array("groups", $array)){
				$this->connection->query("CREATE TABLE `groups` (
																	`group_name` varchar(40) NOT NULL,
																	`permissions` text NOT NULL,
																	`child` text NOT NULL
																	) ENGINE=InnoDB Praktiakant CHARSET=latin1;");
				$this->connection->query("CREATE TABLE `list` (
																		`user` varchar(40) NOT NULL,
																		`pw` text NOT NULL,
																		`permissions` text NOT NULL,
																		`group_name` text NOT NULL,
																		`blocked` varchar(5) NOT NULL
																	) ENGINE=InnoDB Praktiakant CHARSET=latin1;");
				$this->connection->query("ALTER TABLE `groups`
																		ADD UNIQUE KEY `group_name` (`group_name`);");
				$this->connection->query("ALTER TABLE `list`
																		ADD UNIQUE KEY `user` (`user`);");
				$this->connection->query("INSERT INTO groups (group_name, permissions, child) VALUES ('Praktiakant', '[]', 'NULL')");
			}else{
				$this->error("TableExist");
			}
		}else{
			$this->error("Database");
		}
	}
	
	public function getData(){
		if($this->connection != NULL){
			if($this->checkTables()){
				$user = $this->connection->query("SELECT * FROM `list`");
				foreach ($user->fetch_all() as $inhalt) {
					$this->users[$inhalt[0]]['name'] = $inhalt[0];
					$this->users[$inhalt[0]]['pw'] = $inhalt[1];
					$this->users[$inhalt[0]]['perm'] = json_decode($inhalt[2]);
					$this->users[$inhalt[0]]['group'] = $inhalt[3];
					$this->users[$inhalt[0]]['blocked'] = $inhalt[4];
				}
				
				$group = $this->connection->query("SELECT * FROM `groups`");
				foreach ($group->fetch_all() as $inhalt) {
					$this->groups[$inhalt[0]]['group'] = $inhalt[0];
					$this->groups[$inhalt[0]]['perm'] = json_decode($inhalt[1]);
					$this->groups[$inhalt[0]]['child'] = $inhalt[2];
				}
				
			}else{
				$this->error("noTables");
			}
		}else{
			$this->error("Database");
		}
	}
	
	public function createUser($user_1 = "", $pw_1= ""){
		$user = $this->connection->real_escape_string($user_1);
		$pw = $this->connection->real_escape_string($pw_1);
		if($user != "" AND $pw != ""){
			if($this->connection != NULL){
				if($this->checkTables()){
					if(in_array($user, $this->getAllUser())){
						$this->error("userExist");
					}else{
						$pw = password_hash($pw, PASSWORD_BCRYPT);
						$query = $this->connection->query("INSERT INTO list (user, pw, permissions, group_name, blocked) VALUES ('".$user."', '".$pw."', '[]', 'Praktiakant', 'false')");
						$this->users[$user]['name'] = $user;
						$this->users[$user]['pw'] = $pw;
						$this->users[$user]['perm'] = "[]";
						$this->users[$user]['group'] = "Praktiakant";
						$this->users[$user]['blocked'] = "false";
					}
				}else{
					$this->error("noTables"); 
				}
			}else{
				$this->error("Database");
			}
		}else{
			$this->error("vars");
		}
	}
	
	public function deleteUser($user_1 = ""){
		$user = $this->connection->real_escape_string($user_1);
		if($user != ""){
			if($this->connection != NULL){
				if(in_array($user, $this->getAllUser())){
					$query = $this->connection->query("DELETE FROM `list` WHERE user = '".$user."'");
					unset($this->users[$user]);
				}else{
					$this->error("userNotExist");
				}
			}else{
				$this->error("Database");
			}
		}else{
			$this->error("vars");
		}
	}
	
	public function resetUser($user_1){
		$user = $this->connection->real_escape_string($user_1);
		if(@$user != "" OR @$user != NULL){
			if(in_array($user, $this->getAllUser())){
				$this->connection->query("UPDATE `list` SET `pw` = 'NULL', `permissions` = '[]', `group_name` = 'Praktiakant', `blocked` = 'false' WHERE `user` = '".$user."' LIMIT 1");
				$this->users[$user]['pw'] = "NULL";
				$this->users[$user]['perm'] = "[]";
				$this->users[$user]['group'] = "Praktiakant";
				$this->users[$user]['blocked'] = "false";
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}

	public function getAllUser(){
		if($this->connection != NULL){
			$result = array();
			$list = $this->users;
			foreach($list as $user){
				array_push($result, $user['name']);
			}
			return $result;
		}else{
			$this->error("");
		}
	}

	public function getAllUserWithGroup($group){
		if($this->connection != NULL){
			$result = array();
			$list = $this->users;
			foreach($list as $user){
				if($user['group'] == $group){
					array_push($result, $user['name']);
				}
			}
			return $result;
		}else{
			$this->error("");
		}
	}
	
	public function getAllData(){
		if($this->connection != NULL){
			$result = array();
			$list = $this->users;
			foreach($list as $user){
				array_push($result, $user);
			}
			return $result;
		}else{
			$this->error("");
		}
	}	
	
	public function getUserData(){
		global $_SESSION;
		if($this->connection != NULL){
			$result = array();
			$list = $this->users[$_SESSION['login-user']];
			foreach($list as $user){
				array_push($result, $user);
			}
			return $result;
		}else{
			$this->error("");
		}
	}
	
	public function hasPerm($user_1, $perm_1){
		$user = $this->connection->real_escape_string($user_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$user != "" OR @$user != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if(in_array($perm, $this->users[$user]['perm'])){
						return true;
					}elseif(in_array($perm, $this->groups[$this->users[$user]['group']]['perm'])){
						return true;
					}elseif(in_array('*', $this->users[$user]['perm'])){
						return true;
					}elseif(in_array('*', $this->groups[$this->users[$user]['group']]['perm'])){
						return true;
					}else{
						return false;
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
				$this->error("");
		}
	}
	
	public function getPerms($user_1){
		$user = $this->connection->real_escape_string($user_1);
		if(@$user != "" OR @$user != NULL){
			if($this->connection != NULL){
				return $this->users[$user]["perm"];
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function addPerm($user_1, $perm_1){
		$user = $this->connection->real_escape_string($user_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$user != "" OR @$user != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if($this->hasPerm($user, $perm)){
						$this->error("");
					}else{
						array_push($this->users[$user]['perm'], $perm);
						$insert = json_encode($this->users[$user]['perm']);
						$this->connection->query("UPDATE `list` SET `permissions` = '".$insert."' WHERE `user` = '".$user."' LIMIT 1");
					}
				}else{
						$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function removePerm($user_1, $perm_1){
		$user = $this->connection->real_escape_string($user_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$user != "" OR @$user != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if($this->hasPerm($user, $perm)){
						unset($this->users[$user]['perm'][array_search($perm, $this->users[$user]['perm'])]);
						$insert = json_encode($this->users[$user]['perm']);
						$this->connection->query("UPDATE `list` SET `permissions` = '".$insert."' WHERE `user` = '".$user."' LIMIT 1");
					}else{
						$this->error("");
					}
				}else{
						$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function setGroup($user_1, $group_1){
		$user = $this->connection->real_escape_string($user_1);
		$group = $this->connection->real_escape_string($group_1);
		if(@$user != "" OR @$user != NULL){
			if(@$group != "" OR @$group != NULL){
				if($this->connection != NULL){
					if(in_array($group, $this->getAllGroups())){
						$this->connection->query("UPDATE `list` SET `group_name` = '".$group."' WHERE `user` = '".$user."' LIMIT 1");
						$this->users[$user]['group'] = $group;
					}else{
						$this->error("");
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function blockUser($user_1){
		$user = $this->connection->real_escape_string($user_1);
		if(@$user != "" OR @$user != NULL){
			if($this->connection != NULL){
				$this->connection->query("UPDATE `list` SET `blocked` = 'true' WHERE `user` = '".$user."' LIMIT 1");
				$this->users[$user]['blocked'] = "true";
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function setPW($user_1, $pw_1){
		$user = $this->connection->real_escape_string($user_1);
		$pw = $this->connection->real_escape_string($pw_1);
		if(@$user != "" OR @$user != NULL){
			if(@$pw != "" OR @$pw != NULL){
				if($this->connection != NULL){
					$pw = password_hash($pw, PASSWORD_BCRYPT);
					$this->connection->query("UPDATE `list` SET `pw` = '".$pw."' WHERE `user` = '".$user."' LIMIT 1");
					$this->users[$user]['pw'] = $pw;
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function unblockUser($user_1){
		$user = $this->connection->real_escape_string($user_1);
		if(@$user != "" OR @$user != NULL){
			if($this->connection != NULL){
				$this->connection->query("UPDATE `list` SET `blocked` = 'false' WHERE `user` = '".$user."' LIMIT 1");
				$this->users[$user]['blocked'] = "false";
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function blocked($user_1){
		$user = $this->connection->real_escape_string($user_1);
		if(@$user != "" OR @$user != NULL){
			if($this->connection != NULL){
				if($this->users[$user]['blocked'] == "false"){
					return false;
				}else{
					return true;
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function getAllGroups(){
		if($this->connection != NULL){
			$groups = array();
			$list = $this->groups;
			foreach(@$list as $group){
				array_push($groups, $group['group']);
			}
			return $groups;
		}else{
			$this->error("");
		}
	}
	
	public function createGroup($group_1){
		$group = $this->connection->real_escape_string($group_1);
		if(@$group != "" OR @$group != NULL){
			if($this->connection != NULL){
				if(in_array($group, $this->getAllGroups())){
					$this->error("");
				}else{
					$query = $this->connection->query("INSERT INTO groups (group_name, permissions, child) VALUES ('".$group."', '[]', 'NULL')");
					$this->groups[$group]['group'] = $group;
					$this->groups[$group]['perm'] = "[]";
					$this->groups[$group]['child'] = "NULL";
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function deleteGroup($group_1){
		$group = $this->connection->real_escape_string($group_1);
		if(@$group != "" OR @$group != NULL){
			if($this->connection != NULL){
				if(in_array($group, $this->getAllGroups())){
					$query = $this->connection->query("DELETE FROM `groups` WHERE group_name = '".$group."'");
					unset($this->groups[$group]);
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function addGroup($group_1, $perm_1){
		$group = $this->connection->real_escape_string($group_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$group != "" OR @$group != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if($this->hasGroup($group, $perm)){
						$this->error("");
					}else{
						array_push($this->groups[$group]['perm'], $perm);
						$insert = json_encode($this->groups[$group]['perm']);
						$this->connection->query("UPDATE `groups` SET `permissions` = '".$insert."' WHERE `group_name` = '".$group."' LIMIT 1");
					}
				}else{
						$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function hasGroup($group_1, $perm_1){
		$group = $this->connection->real_escape_string($group_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$group != "" OR @$group != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if(in_array($perm, $this->groups[$group]['perm'])){
						return true;
					}else{
						return false;
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
				$this->error("");
		}
	}
	
	public function removeGroup($group_1, $perm_1){
		$group = $this->connection->real_escape_string($group_1);
		$perm = $this->connection->real_escape_string($perm_1);
		if(@$group != "" OR @$group != NULL){
			if(@$perm != "" OR @$perm != NULL){
				if($this->connection != NULL){
					if($this->hasGroup($group, $perm)){
						unset($this->groups[$group]['perm'][array_search($perm, $this->groups[$group]['perm'])]);
						$insert = json_encode($this->groups[$group]['perm']);
						$this->connection->query("UPDATE `groups` SET `permissions` = '".$insert."' WHERE `group_name` = '".$group."' LIMIT 1");
					}else{
						$this->error("");
					}
				}else{
						$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function resetGroup($group_1){
		$group = $this->connection->real_escape_string($group_1);
		if(@$group != "" OR @$group != NULL){
			if($this->connection != NULL){
				if(in_array($group, $this->getAllGroups())){
					$this->connection->query("UPDATE `groups` SET `permissions` = '[]', `child` = 'NULL' WHERE `group_name` = '".$group."' LIMIT 1");
					$this->groups[$group]['perm'] = "[]";
					$this->groups[$group]['child'] = "NULL";
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function login($user_1, $pw_1){
		$user = $this->connection->real_escape_string($user_1);
		$pw = $this->connection->real_escape_string($pw_1);
		if(@$user != "" OR @$user != NULL){
			if(@$pw != "" OR @$pw != NULL){
				if($this->connection != NULL){
					if($this->session == true){
						if(password_verify($pw, @$this->users[$user]['pw'])){
                            if($this->blocked($user) == false){
                                $_SESSION['login-user'] = $user;
                                $_SESSION['login-pw'] = $pw;
                                return true;
                            }else{
                                return false;
                            }
						}else{
							return false;
						}
					}else{
						$this->error("");
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function session_check($url_1){
		$url = $this->connection->real_escape_string($url_1);
		if(@$url != "" OR @$url != NULL){
			if($this->connection != NULL){
				if($this->session == true){
					if(isset($_SESSION['login-user']) AND isset($_SESSION['login-pw'])){
						if(password_verify($_SESSION['login-pw'], $this->users[$_SESSION['login-user']]['pw'])){
                            if($this->blocked($_SESSION['login-user']) == true){
                                $this->logout();
                                header("Location:".$url);
                                exit();
                            }
							header("Location:".$url);
							exit();
						}
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function login_check($url_1){
		$url = $this->connection->real_escape_string($url_1);
		if(@$url != "" OR @$url != NULL){
			if($this->connection != NULL){
				if($this->session == true){
					if(isset($_SESSION['login-user']) AND isset($_SESSION['login-pw'])){
                        if($this->blocked($_SESSION['login-user']) == true){
                            $this->logout();
                            header("Location:".$url);
							exit();
                        }
						if(!password_verify($_SESSION['login-pw'], $this->users[$_SESSION['login-user']]['pw'])){
							header("Location:".$url);
							exit();
						}
					}else{
						header("Location:".$url);
						exit();
					}
				}else{
					$this->error("");
				}
			}else{
				$this->error("");
			}
		}else{
			$this->error("");
		}
	}
	
	public function logout(){
		if($this->session == true){
			$_SESSION['login-pw'] = NULL;
			$_SESSION['login-user'] = NULL;
			session_destroy();
		}else{
			$this->error("");
		}
	}
	
}

?>