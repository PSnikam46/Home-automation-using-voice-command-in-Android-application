<?php
	system("gpio -g mode 17 out");
	system("gpio -g write 17 1");
	echo "<script>alert('Done'); document.location='index.php';</script>";
?>