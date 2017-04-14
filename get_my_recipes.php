<?php
  $customerName = $_POST['username'];


    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');
    $possibleRecipes= oci_parse($connection, "SELECT RECIPE_CONSISTS_OF.RECIPE_NAME,COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME, COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on UPPER(RECIPE_CONSISTS_OF.INGREDIENTNAME) LIKE ('%' ||UPPER(CUSTOMER_OWNS.INGREDIENTNAME)||'%') WHERE ACCOUNTNAME=:bv_customerName GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME");
    // $possibleRecipes= oci_parse($connection, "SELECT RECIPE_CONSISTS_OF.RECIPE_NAME,COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME,COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on UPPER(RECIPE_CONSISTS_OF.INGREDIENTNAME)=UPPER(CUSTOMER_OWNS.INGREDIENTNAME)WHERE ACCOUNTNAME=:bv_customerName GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME");

    oci_bind_by_name($possibleRecipes, ":bv_customerName", $customerName);

    oci_execute($possibleRecipes);
    while ($row = oci_fetch_object($possibleRecipes)) {
        // $previousRecipeName=$row->RECIPE_NAME;
          echo $row->RECIPE_NAME.'|';

    }
  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($possibleRecipes);
  oci_close($connection);
?>
