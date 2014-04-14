<?php

// configuration
require("../includes/config.php");

// if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	 if(empty($_POST["stock"]) || empty($_POST["stock"]))
	 {
	 	if(empty($_POST["stock"]))
	 	{
	 		apologize("You need to specify a stock to buy");
	 	}
	 	else if(empty($_POST["shares"]) || preg_match("/^\d+$/", $_POST["shares"]))
	 	{
	 		apologize("You need to specify the whole amounts of shares.");
	 	}
	 	$id = $_SESSION["id"];
	 	$cash = query("SELECT cash FROM users WHERE id = $");
	 	$stock = lookup($_POST["stock"]);
	 	$cost = $stock["price"]*$_POST["shares"];
	 	else if($cost > $cash)
	 	{
	 		apologize("You don't have enough money to buy". $_POST["shares"] . "shares from" . $stock["name"] . ".");
	 	}
	 }else
	 {
	 	
	 }
}
else
{
  // else render form
  render("buy_form.php", ["title" => "Buy"]);
}


?>
