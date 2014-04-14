<div>

	 <?php
	 	print("Hello, ". $cash[0]["username"] .". Your current balance is " . $cash[0]["cash"].".");
	 ?>
     <table id="overview">
      <?php
	
          foreach ($positions as $position)
          {
          	  print("<tr>");
				print("<th>Symbol</th>");
				print("<th>Name</th>");
				print("<th>Shares</th>");
				print("<th>Price</th>");
				print("<th>Total</th>");
			  print("</tr>");
			  
              print("<tr>");
              print("<td>" . $position["symbol"] . "</td>");
              print("<td>" . $position["name"] . "</td>");
              print("<td>" . $position["shares"] . "</td>");
              print("<td>" . $position["price"] . "</td>");
              print("<td>" . $position["total"] . "</td>");
              print("</tr>");
          }
	
      ?>
  </table>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
