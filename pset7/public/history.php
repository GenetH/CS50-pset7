<?php

    // configuration
    require("../includes/config.php"); 
	
	$id = $_SESSION["id"];
	$history = query("SELECT symbol, status, shares, price, date FROM history WHERE id = $id");
	
    // render portfolio
    render("history_form.php", ["title" => "History", "history" => $history]);

?>
