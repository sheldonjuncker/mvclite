<?php

$base_path = "framework";

require("$base_path/mvc.php");

$m = new MVC($base_path);

$max = "<br />" . (memory_get_peak_usage(true) / (1024 * 1024)) . " MB";

print $max;

?>