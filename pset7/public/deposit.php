<?php

// configuration
require("../includes/config.php");

// if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["amount"]))
	 {
	 	apologize("You need to specify how much money you want to deposit.");
	 }else{
	 	$id = $_SESSION["id"];
	 	$amount = $_POST["amount"];
	 	
	 	// If the amount is not a valid numeric number an error message is displayed
	 	if($amount < 0 || !is_numeric($amount)){
	 		apologize("Not a valid amount.");
	 	}else{
		 	query("UPDATE users SET cash = cash + $amount WHERE id = $id");
		 	query("INSERT INTO history (id, status, price) VALUES($id, 'DEPOSIT', $amount)");
		 	render("../templates/deposit.php", ["title" => "Deposit", "amount" => $amount]);
		 }
	 }
}
else
{
  // else render form
  render("deposit_form.php", ["title" => "Deposit"]);
}


?>
