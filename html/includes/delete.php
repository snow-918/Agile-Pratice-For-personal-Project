<?php
	require 'dbconnection.php';

	if (isset($switch) && isset($switchName) && isset($siteName))
	{
		$option = 1;
	}
	elseif (isset($siteName) && isset($configName) && isset($switchName) && isset($cfg))
	{
		$option = 2;
		$path = "$siteName/$switchName/$configName";
	}
	else
	{
		header('Location: '.$previousPage);
		exit();
	}

	// Move to file location
	$oldPath = getcwd();
	chdir('/home/ubuntu/project/Switch/');

	// Delete all files and folder at path
	shell_exec("rm $path");

	// Move back when finished
	chdir($oldPath);

	// Interact with database
	switch ($option)
	{
		case 1:
			// Delete configs from database
			$sql = "DELETE FROM switchConfigs WHERE switch = $switch";
			$rs = $conn->query($sql);

			// Delete switch from database
			$sql = "DELETE FROM switches WHERE switchID = $switch";

			break;
		case 2:
			// Delete config from database
			$sql = "DELETE FROM switchConfigs WHERE configID = $cfg";
			break;
		default:
	}

	// Execute query
	$rs = $conn->query($sql);

	// Close connection
	$conn->close();
	unset($rs, $conn);
?>