<?php

// configuration
require("../includes/config.php");

// if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["username"])||empty($_POST["password"])||$_POST["password"] != $_POST["confirmation"])
	{
		if(empty($_POST["username"]))
		{
			apologize("Username is required");
		}
		else if(empty($_POST["password"]))
		{
			apologize("Password is required");
		}
		else if($_POST["password"] != $_POST["confirmation"])
		{
			apologize("Password doesn't equal the confirmation");
		}
	}else{

		if(query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"])) === false)
		{
			echo('Username already exists');
		}else
		{
			$rows = query("SELECT LAST_INSERT_ID() AS id");
			$id = $rows[0]["id"];
			$_SESSION["id"] = $id; 
			redirect("index.php");
		}
	}
}
else
{
  // else render form
  render("register_form.php", ["title" => "Register"]);
}

?>
