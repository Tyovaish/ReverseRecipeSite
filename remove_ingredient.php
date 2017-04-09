<?php

  echo "Removing ingredient";

  $rm_ingredient = $_POST['remove'];

  echo $rm_ingredient;

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');


  while (($row = oci_fetch_object($remove))) {
      var_dump($row);
  }
  oci_free_statement($remove);
  oci_close($connection);
?>
