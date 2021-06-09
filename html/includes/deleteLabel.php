<?php
       require 'dbconnection.php';
       if (isset($_POST['cfg']))
        {

		$cfgID = $_POST['cfg'];
        }
        else
        {       header('Location: ../labels.php');
                exit();
        }



        // Delete assign site  from database
        $sql = "DELETE FROM labels WHERE switchConfig= $cfgID";
        $rs = $conn->query($sql);

        // Close connection
        $conn->close();
        unset($rs, $conn);

        // Go back to previous page
        header('Location: ../labels.php');
        exit();
?>
