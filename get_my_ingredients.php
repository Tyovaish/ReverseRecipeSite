<?php
  $customerName = $_POST['username'];

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $getUserIngredients=oci_parse($connection,'SELECT INGREDIENTNAME FROM CUSTOMER_OWNS WHERE ACCOUNTNAME=:bv_customerName');

  oci_bind_by_name($getUserIngredients,':bv_customerName',$customerName);
  oci_execute($getUserIngredients);
  while (($row = oci_fetch_object($getUserIngredients))) {
      echo $row->INGREDIENTNAME . "|";
  }
  oci_free_statement($getUserIngredients);
  oci_close($connection);
?>
