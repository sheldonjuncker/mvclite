<h1>{table_name}</h1>
<table border="1" width="100%">
<tr>
<th>Owner Number</th>
<th>Last Name</th>
<th>First Name</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
</tr>

<?php

foreach($owners as $o)
{
	print "<tr>";
	print "<td>{$o['0']}</td>";
	print "<td>{$o['1']}</td>";
	print "<td>{$o['2']}</td>";
	print "<td>{$o['3']}</td>";
	print "<td>{$o['4']}</td>";
	print "<td>{$o['5']}</td>";
	print "<td>{$o['6']}</td>";
	print "</tr>";
}

?>
</table>