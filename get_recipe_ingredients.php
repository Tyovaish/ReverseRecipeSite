<?php
  $recipeName= $_POST['recipe'];

    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    $possibleRecipes= oci_parse($connection, 'SELECT INGREDIENTNAME FROM RECIPE_CONSISTS_OF WHERE RECIPE_NAME=:bv_recipeName ORDER BY INGREDIENTNAME');

    oci_bind_by_name($possibleRecipes, ":bv_recipeName", $recipeName);

    oci_execute($possibleRecipes);

$row = oci_fetch_object($possibleRecipes);
    while ($row) {

          echo $row->INGREDIENTNAME.'|';
          $row=oci_fetch_object($possibleRecipes);
  }

  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($possibleRecipes);
  oci_close($connection);
?>
