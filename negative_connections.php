<?php
  $ingredient1= trim($_POST['ingredient1']);
  $ingredient2=trim($_POST['ingredient2']);

  echo $ingredient1;
  echo $ingredient2;


  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

                            $decreaseConnection=oci_parse($connection,"UPDATE INGREDIENT_CONNECTIONS SET NUMBEROFCONNECTIONS=NUMBEROFCONNECTIONS-1 WHERE INGREDIENT1_NAME=:bv_ingredient1 AND INGREDIENT2_NAME=:bv_ingredient2");


  oci_bind_by_name($decreaseConnection, ":bv_ingredient1",$ingredient1);
  oci_bind_by_name($decreaseConnection, ":bv_ingredient2",$ingredient2);
  oci_execute($decreaseConnection);
oci_free_statement($decreaseConnection);
      $decreaseConnection=oci_parse($connection,"UPDATE INGREDIENT_CONNECTIONS SET NUMBEROFCONNECTIONS=NUMBEROFCONNECTIONS-1 WHERE INGREDIENT1_NAME=:bv_ingredient1 AND INGREDIENT2_NAME=:bv_ingredient2");

    oci_bind_by_name($decreaseConnection, ":bv_ingredient1",$ingredient2);
      oci_bind_by_name($decreaseConnection, ":bv_ingredient2",$ingredient1);
      oci_execute($decreaseConnection);

//
// VERY important to close Oracle Database Connections and free statements!
//
oci_free_statement($decreaseConnection);
oci_close($connection);
?>
