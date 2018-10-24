<?php
  $stmt = "SELECT * FROM staff WHERE ".$type." LIKE '".$query_string."'";
  $result = $db->query($stmt);
  if (!$result->num_rows){
    echo"No results matched your search!</tbody>";

    exit (0);
  }
  while ($row = $result->fetch_assoc()) {
    $form = "<form method= 'POST' action='update_info.php'/>\n";
      $form .= "<button type='submit' class='btn btn-primary' value = '".$row["S_ID"]."'name='edit'><span class='glyphicon glyphicon-pencil'></span></button></form>";
      echo "<tr><td>".$form."</td><td>".$row['Status']."</td><td>" . $row["S_ID"]. "</td><td>" . $row["First_Name"]. "</td><td>" . $row["Last_Name"]. "</td><td>".$row["Email"]."</td><td>"
      .$row["Telephone"]."</td><td>".$row["Job"]."</td></tr><br>";
    }
  ?>