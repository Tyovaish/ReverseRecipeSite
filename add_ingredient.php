<?php
  $ingredientToAdd = $_POST['recipe'];
  $customerName = $_POST['username'];

    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    // $statement = oci_parse($connection, 'SELECT * FROM RECIPE');
    $addIngredientToDatabase=oci_parse($connection,'INSERT INTO INGREDIENT(INGREDIENTNAME) VALUES(:bv_ingredient)');
    $addIngredientToUser=oci_parse($connection,'INSERT INTO CUSTOMER_OWNS(INGREDIENTNAME,ACCOUNTNAME,INGREDIENTAMOUNTOWNED) VALUES(:bv_ingredient,:bv_customer,5)');
    // $possibleRecipes= oci_parse($connection, "SELECT RECIPE_CONSISTS_OF.RECIPE_NAME,COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME, COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on UPPER(RECIPE_CONSISTS_OF.INGREDIENTNAME) LIKE ('%' ||UPPER(CUSTOMER_OWNS.INGREDIENTNAME)||'%') WHERE ACCOUNTNAME=:bv_customerName GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME");
    // $possibleRecipes= oci_parse($connection, "SELECT RECIPE_CONSISTS_OF.RECIPE_NAME,COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME, COUNT(RECIPE_CONSISTS_OF.RECIPE_NAME) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on UPPER(RECIPE_CONSISTS_OF.INGREDIENTNAME)=UPPER(CUSTOMER_OWNS.INGREDIENTNAME) WHERE ACCOUNTNAME=:bv_customerName GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME");



    //oci_bind_by_name($possibleRecipes, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToUser, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToDatabase, ":bv_ingredient", $ingredientToAdd);

    oci_bind_by_name($possibleRecipes, ":bv_customerName", $customerName);
    oci_bind_by_name($addIngredientToUser, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredientToDatabase, ":bv_customer", $customerName);



    oci_execute($addIngredientToDatabase);
    oci_execute($addIngredientToUser);
    // oci_execute($possibleRecipes);
    // $row = oci_fetch_object($possibleRecipes);
    // while ($row && $recipeCount<=$numberOfRecipesToDisplay) {
    //     $previousRecipeName=$row->RECIPE_NAME;
    //       echo $previousRecipeName.'|';
    //     while($previousRecipeName===$row->RECIPE_NAME){
    //       // echo $row->INGREDIENTNAME.',';
    //       $row=oci_fetch_object($possibleRecipes);
    //     }
    // }



  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($addIngredientToDatabase);
  oci_free_statement($addIngredientToUser);
  oci_free_statement($possibleRecipes);
  oci_close($connection);
?>
