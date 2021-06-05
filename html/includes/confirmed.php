<?php
ob_start();
session_start(); 

// Variables
$first = $_SESSION['input1'];

if (isset($_SESSION['input2']))
{
	$second = $_SESSION['input2'];
}

if (isset($_SESSION['input3']))
{
	$third = $_SESSION['input3'];
}

if (isset($_SESSION['input4']))
{
	$fourth = $_SESSION['input4'];
}

if (isset($_SESSION['input5']))
{
	$fifth = $_SESSION['input5'];
}

$table = $_SESSION['table'];

// Connect to database
require 'dbconnection.php';

// Try the following
try 
{
	// Create query based on which $table is used
	switch ($table)
	{
		case "siteAgents":
			$sql = "INSERT INTO $table (siteName) VALUES ('$first')";
			break;
		case "admins":
			$sql = "INSERT INTO $table (username, email, password, adminType) ";
			$sql .= "VALUES ('$first', '$second', '$third', 'Site Admin')";
			break;
		case 'switches':
			$sql = "INSERT INTO $table (switchName, ipAddress, connectionMode, authenticationString, siteAgent) ";
			$sql .= "VALUES ('$first', '$second', '$third', ";
			
			if (isset($_SESSION['input4']))
			{
				$sql .= "'$fourth', ";
			}
			else
			{
				$sql .= "NULL, ";
			}

			$sql .= "'$fifth')";

			break;
		case "labels":
			$sql = "INSERT INTO $table(labelName, switchConfig) VALUES ( ";

                        if (isset($_SESSION['input1']))
			{
				$sql .="'$first', ";
			}
			else
			{
				$sql .= "NULL, ";
			}

			$sql .= "'$second')";
			break;
		default:
			unset($sql);
	}
}
catch (Exception $e)
{
	$_SESSION['message'] = 'An error has occurred during submission.';

	// Close the connection
	$conn->close();
	unset($rs, $conn);

	header('Location: '.$_SESSION['page']);
	exit();
}

// Execute query
if (isset($sql))
{
	$rs = $conn->prepare($sql);
	$rs->execute();
}

// Close the connection
$rs->close();
$conn->close();
unset($rs, $conn);

// Redirect back and exit
$_SESSION['message'] = 'Submission successful.';
header('Location: '.$_SESSION['page']);
exit();

ob_end_flush();
?>
