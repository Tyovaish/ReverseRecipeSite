<?php
  $rm_ingredient = $_POST['remove'];

  echo $rm_ingredient;

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $getUserIngredients=oci_parse($connection,'SELECT INGREDIENTNAME FROM CUSTOMER_OWNS');

  oci_execute($getUserIngredients);
  $row=oci_fetch_object($getUserIngredients);
  while (($row = oci_fetch_object($getUserIngredients))) {
      echo $row->INGREDIENTNAME . ",";
  }
  oci_free_statement($getUserIngredients);
  oci_close($connection);
?>
