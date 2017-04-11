<?php
  $rm_ingredient = $_POST['remove'];

  echo $rm_ingredient;

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $removeIngredient=oci_parse($connection,'DELETE FROM CUSTOMER_OWNS WHERE INGREDIENTNAME=:bv_rm_ingredient');
  oci_bind_by_name($removeIngredient, ":bv_rm_ingredient", $rm_ingredient);
  oci_execute($removeIngredient);
  $customerOwns=oci_parse($connection,'SELECT * FROM CUSTOMER_OWNS');
  oci_execute($customerOwns);
  while (($row = oci_fetch_object($customerOwns))) {
      var_dump($row);
  }
  oci_free_statement($removeIngredient);
  oci_close($connection);
?>
