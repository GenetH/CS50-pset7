<?php

// configuration
require("../includes/config.php");

// if form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$_POST = lookup($_POST["symbol"]);
	 if($_POST === false)
	 {
	 	apologize("No such stock available");
	 }
	 render("../templates/quote.php", ["title" => "Quote"]);
}
else
{
  // else render form
  render("quote_form.php", ["title" => "Quote"]);
}


?>
