<?php
	system("gpio -g mode 17 in");
	echo "<script>alert('Done'); document.location='index.php';</script>";
?>