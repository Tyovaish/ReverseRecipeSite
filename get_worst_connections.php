<?php
  $customerName= $_POST['username'];

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $getWorstConnections=oci_parse($connection,'SELECT INGREDIENT1_NAME,SUM(NUMBEROFCONNECTIONS) FROM INGREDIENT_CONNECTIONS GROUP BY INGREDIENT1_NAME ORDER BY SUM(NUMBEROFCONNECTIONS) ASC');


  oci_execute($getWorstConnections);
  while ($row = oci_fetch_object($getWorstConnections)) {
      echo $row->INGREDIENT1_NAME. "|";
  }

//
// VERY important to close Oracle Database Connections and free statements!
//
oci_free_statement($getWorstConnections);
oci_close($connection);
?>
