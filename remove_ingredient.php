<?php
  $rm_ingredient = $_POST['remove'];
  $customerName = $_POST['username'];

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $removeIngredient=oci_parse($connection,'DELETE FROM CUSTOMER_OWNS WHERE INGREDIENTNAME=:bv_rm_ingredient AND ACCOUNTNAME=:bv_customerName');
  oci_bind_by_name($removeIngredient, ":bv_rm_ingredient", $rm_ingredient);
  oci_bind_by_name($removeIngredient, ":bv_customerName", $customerName);
  oci_execute($removeIngredient);
  $customerOwns=oci_parse($connection,'SELECT * FROM CUSTOMER_OWNS WHERE ACCOUNTNAME=:bv_customerName');
  oci_bind_by_name($customerOwns, ":bv_customerName", $customerName);
  oci_execute($customerOwns);
  oci_free_statement($removeIngredient);
  oci_free_statement($customerOwns);
  oci_close($connection);
?>
