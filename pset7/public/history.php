<?php

    // configuration
    require("../includes/config.php"); 
	
	$id = $_SESSION["id"];
	
	// Retrieves all the transactions from the database
	$history = query("SELECT symbol, status, shares, price, date FROM history WHERE id = $id");
	
    // render portfolio
    render("history_form.php", ["title" => "History", "history" => $history]);

?>
