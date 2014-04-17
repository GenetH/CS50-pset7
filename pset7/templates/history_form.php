<!-- This form displays a table with all your history transactions -->
<div>
    <table id="overview">
		<?php
			print("<tr>");
				print("<th>Transaction</th>");
				print("<th>Date/Time</th>");
				print("<th>Symbol</th>");
				print("<th>Shares</th>");
				print("<th>Price</th>");
			print("</tr>");
				  
			foreach ($history as $history)
			{	  
				print("<tr>");
				print("<td>" . $history["status"] . "</td>");
				print("<td>" . $history["date"] . "</td>");
				print("<td>" . $history["symbol"] . "</td>");
				print("<td>" . $history["shares"] . "</td>");
				print("<td>" . $history["price"] . "</td>");
				print("</tr>");
			}
		?>
	</table>
</div>
