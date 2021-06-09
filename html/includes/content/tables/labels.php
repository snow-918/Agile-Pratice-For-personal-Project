<?php
    require 'dbconnection.php';
    if (isset($_POST['cfg'])
    {
        $cfgID = $_POST['cfg'];

        $sql = "SELECT labelName FROM labels WHERE switchConfig=$cfgID";
         
       $rs = $conn->query($sql);
       if ($rs->num_rows > 0)
       {
         
         while ($row = $rs->fetch_assoc())
        {
          $labelName = $row['labelName'];
         
         echo "<div class='listlabel'>";
         echo "<p class='tmidcol'>$</p>";
         echo "<form action='includes/deletelabels.php' ";
         echo "class='actionForm' method='post' onsubmit='return confirm(\"Are you sure you want to unassign $labelName\")'>";
         echo "<input type='submit' value='Delete Label' />";
         echo "</form></div>";
         }
       }
    }

?>
