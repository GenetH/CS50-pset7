<?php

// configuration
require("../includes/config.php");

// if form was submitted 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	 if(empty($_POST["stock"]) || empty($_POST["shares"]) || !preg_match("/^\d+$/", $_POST["shares"]) ||
	  								($_POST["shares"] < 0 ))
	 {
	 	if(empty($_POST["stock"]))
	 	{
	 		apologize("You need to specify a stock to buy");
	 	}
	 	else if(empty($_POST["shares"]) || !preg_match("/^\d+$/", $_POST["shares"]) || 
	 								($_POST["shares"] < 0 ))
	 	{
	 		apologize("You need to specify whole amounts of shares.");
	 	}
	 }else
	 {
	 	$symbol = strtoupper($_POST["stock"]);
	 	$id = $_SESSION["id"];
	 	$shares = $_POST["shares"];
	 	$stock = lookup($symbol);
	 	$price = $stock["price"];
	 	$cash = query("SELECT cash FROM users WHERE id = $id");
	 	$cost = $price*$_POST["shares"];
	 	
	 	// If the cost is more then the balanc of the user, an error message is displayed
	 	if($cost > $cash[0]["cash"])
	 	{
	 		apologize("You don't have enough money to buy ". $shares . " shares from " . $stock["name"] . ".");
	 	}else
	 	{
	 		query("INSERT INTO portfolio (id, symbol, shares) VALUES($id, '$symbol', $shares) 
	 		ON DUPLICATE KEY UPDATE shares = shares + $shares");
	 		query("UPDATE users SET cash = cash - $cost WHERE id = $id");
	 		query("INSERT INTO history (id, symbol, status, shares, price) VALUES($id, '$symbol', 'BUY', $shares, $price)");
	 		render("../templates/buy.php", ["title" => "Buy", "stock" => $stock, "cost" => $cost, "shares" => $shares]);
	 	}
	 }
} 
else
{
  // else render form
  render("buy_form.php", ["title" => "Buy"]);
}


?>
