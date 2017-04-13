<?php
  $customerName= $_POST['username'];

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $getRecipeFavorite=oci_parse($connection,'SELECT RECIPE_NAME FROM CUSTOMER_FAVORITES WHERE ACCOUNTNAME=:bv_customerName');

  oci_bind_by_name($getRecipeFavorite, ":bv_customerName", $customerName);

  oci_execute($getRecipeFavorite);
  while (($row = oci_fetch_object($getRecipeFavorite))) {
      echo $row->RECIPE_NAME. "|";
  }

//
// VERY important to close Oracle Database Connections and free statements!
//
oci_free_statement($getRecipeFavorite);
oci_close($connection);
?>
