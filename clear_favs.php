<?php
  $customerName= $_POST['username'];

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $clearFavs=oci_parse($connection,'DELETE FROM CUSTOMER_FAVORITES WHERE ACCOUNTNAME=:bv_customerName');

  oci_bind_by_name($clearFavs, ":bv_customerName", $customerName);

  oci_execute($clearFavs);

//
// VERY important to close Oracle Database Connections and free statements!
//
oci_free_statement($clearFavs);
oci_close($connection);
?>
