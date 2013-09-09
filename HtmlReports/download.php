<?php

	if (!isset($_GET['file']) || empty($_GET['file']))
	{
		exit();
	}
	else
	{
		$file = $_GET['file'];
		header("Content-disposition: attachment; filename=$file");
		header("Content-type: application/octet-stream");
		readfile($file);
	}
 
?>