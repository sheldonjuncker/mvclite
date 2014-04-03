<table width="100%" border="1">
<tr>
<th>Heading</th>
</tr>
<?php

foreach($data as $o)
{
	print "<tr>";
	print "<td>{$o[0]}</td>";
	print "</tr>";
}

?>
</table>