                        <?php
                          $stmt = "SELECT * FROM staff WHERE ".$type." LIKE '".$query_string."'";
                          $result = $db->query($stmt);
                          $num_rows = $result->fetchColumn();
                          if ($num_rows == 0){
                            echo"No results matched your search!</tbody>";

                            exit (0);
                          }
                          foreach($dbcon->query($stmt) as $row)  {
                            $form = "<form method= 'POST' action='update_info.php'/>\n";
                              $form .= "<button type='submit' class='btn btn-primary btn-lg btn-block' value = '".$row["ID"]."'name='edit'><span class='glyphicon glyphicon-pencil'></span> Edit Status</button></form>";
                              echo "<tr><td>".$form."</td><td>".$row['Status']."</td><td>" . $row["ID"]. "</td><td>" . $row["First_Name"]. "</td><td>" . $row["Last_Name"]. "</td><td>".$row["Email"]."</td><td>"
                              .$row["Telephone"]."</td><td>".$row["Job"]."</td><td>".$row["Glass_User"]."</td></tr><br>";
                            }
                          ?>