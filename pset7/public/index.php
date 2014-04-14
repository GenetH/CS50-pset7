<?php

    // configuration
    require("../includes/config.php"); 	
	
	
    $id = $_SESSION["id"];
	$rows = query("SELECT id, symbol, shares FROM portfolio WHERE id = $id");
				
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
		  "total" => $row["shares"]*$stock["price"]
		  ];
	  }
	}
	  
	$cash = query("SELECT username, cash FROM users WHERE id = $id");
    
    // render portfolio
    render("portfolio.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);

?>
