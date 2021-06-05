<?php
session_start();

        include 'includes/dbconnection.php';

        if(isset($_POST['chooseConf']))
         {
           $configID = $_POST['chooseConf'];
           $configID = rtrim($configID);

           $sql = "SELECT labelname FROM labels WHERE SwitchConfig= $configID";

           $result = $conn->query($sql);

           if ($result->num_rows > 0)
           {
             echo "<div class='labels'><p class='tfirstcol'>$result</p>";
             echo "</div>"
           }else{
              echo "<div class='noReturn'><p>There are no site admins listed.";
              echo "</p></div>";
           }

         }
$conn->close();

?>
