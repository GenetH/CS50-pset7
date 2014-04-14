<?php

// configuration
require("../includes/config.php");

// if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	 if(empty($_POST["stock"]))
	 {
	 	apologize("You need to specify which stock to sell.");
	 }else{
	 	$id = $_SESSION["id"];
	 	$stock = $_POST["stock"];
	 	if(!$shares = query("SELECT shares FROM portfolio WHERE id = $id AND symbol = '$stock'")){
	 		apologize("You don't own any shares of this stock");
	 	}else{
		 	$value = lookup("$stock");
		 	$profit = $shares[0]["shares"]*$value["price"];
		 	query("DELETE FROM portfolio WHERE id = $id AND symbol = '$stock'");
		 	query("UPDATE users SET cash = cash + $profit WHERE id = $id");
		 	render("../templates/sell.php", ["title" => "Sell", "value" => $value , "profit" => $profit]);
		 }
	 }
}
else
{
  // else render form
  render("sell_form.php", ["title" => "Sell"]);
}


?>
