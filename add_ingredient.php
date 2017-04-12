<?php
  $ingredientToAdd = $_POST['recipe'];
  $customerName = $_POST['username'];

    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    // $statement = oci_parse($connection, 'SELECT * FROM RECIPE');
    $addIngredientToDatabase=oci_parse($connection,'INSERT INTO INGREDIENT(INGREDIENTNAME) VALUES(:bv_ingredient)');
    $addIngredientToUser=oci_parse($connection,'INSERT INTO CUSTOMER_OWNS(INGREDIENTNAME,ACCOUNTNAME,INGREDIENTAMOUNTOWNED) VALUES(:bv_ingredient,:bv_customer,5)');
    // $possibleRecipes= oci_parse($connection, 'SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on RECIPE_CONSISTS_OF.INGREDIENTNAME=CUSTOMER_OWNS.INGREDIENTNAME GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME');

    $possibleRecipes= oci_parse($connection, 'SELECT * FROM RECIPE_CONSISTS_OF ORDER BY RECIPE_NAME');

    oci_bind_by_name($possibleRecipes, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToUser, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToDatabase, ":bv_ingredient", $ingredientToAdd);

    oci_bind_by_name($possibleRecipes, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredientToUser, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredientToDatabase, ":bv_customer", $customerName);



    oci_execute($addIngredientToDatabase);
    oci_execute($addIngredientToUser);
    oci_execute($possibleRecipes);
    oci_execute($customerOwns);
$row = oci_fetch_object($possibleRecipes);
    while ($row) {
        $previousRecipeName=$row->RECIPE_NAME;
        echo $previousRecipeName.',';
        while($previousRecipeName===$row->RECIPE_NAME){
          // echo $row->INGREDIENTNAME.',';
          $row=oci_fetch_object($possibleRecipes);
        }
    }



  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($addIngredientToDatabase);
  oci_free_statement($addIngredientToUser);
  oci_free_statement($possibleRecipes);
  oci_free_statement($customerOwns);
  oci_close($connection);
?>
