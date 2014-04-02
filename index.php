<?php

$base_path = "framework";

require("$base_path/MVClite.php");

$m = new MVClite($base_path);

$max = "<br />" . (memory_get_peak_usage(true) / (1024 * 1024)) . " MB";

print $max;

?>