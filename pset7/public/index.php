<?php

    // configuration
    require("../includes/config.php"); 	
	
    $id = $_SESSION["id"];
    // Retrieve all the shares this users owns
	$rows = query("SELECT id, symbol, shares FROM portfolio WHERE id = $id");
				
	// A positions array which stores all the information about the shares
	$positions = [];
	foreach ($rows as $row)
	{
	  $stock = lookup($row["symbol"]);
	  if ($stock !== false)
	  {
		  $positions[] = [
		  "name" => $stock["name"],
		  "price" => $stock["price"],
		  "shares" => $row["shares"],
		  "symbol" => $row["symbol"],
		  "total" => sprintf("%.2f", $row["shares"]*$stock["price"])
		  ];
	  }
	}
	  
	// This is the balance of the user
	$cash = query("SELECT username, cash FROM users WHERE id = $id");
    // render portfolio
    render("portfolio.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);

?>
