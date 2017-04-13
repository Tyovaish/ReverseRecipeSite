<?php
  $recipeName = $_POST['recipeName'];
  $customerName = $_POST['username'];
  $description = $_POST['description'];

  echo $recipeName;

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  $addRecipeToDatabase=oci_parse($connection,'INSERT INTO RECIPE(RECIPE_AUTHOR,RECIPE_NAME,DIRECTIONS) VALUES (:bv_customerName,:bv_recipeName,:bv_description)');
  oci_bind_by_name($addRecipeToDatabase,':bv_customerName',$customerName);
  oci_bind_by_name($addRecipeToDatabase,':bv_recipeName',$recipeName);
  oci_bind_by_name($addRecipeToDatabase,':bv_description',$description);
  oci_execute($addRecipeToDatabase);
  $getUserIngredients=oci_parse($connection,'SELECT INGREDIENTNAME FROM CUSTOMER_OWNS WHERE ACCOUNTNAME=:bv_customerName');
  oci_bind_by_name($getUserIngredients,':bv_customerName',$customerName);
  oci_execute($getUserIngredients);
  $row=oci_fetch_object($getUserIngredients);
  while($row){
      $ingredient=$row->INGREDIENTNAME;
      $insertIngredientsToRecipe=oci_parse($connection,'INSERT INTO RECIPE_CONSISTS_OF(RECIPE_NAME,INGREDIENTNAME) VALUES (:bv_recipeName,:bv_ingredient)');
      oci_bind_by_name($insertIngredientsToRecipe,':bv_recipeName',$recipeName);
      oci_bind_by_name($insertIngredientsToRecipe,':bv_ingredient',$ingredient);
      oci_execute($insertIngredientsToRecipe);
      $row=oci_fetch_object($getUserIngredients);
      echo $row->INGREDIENTNAME;
  }
  echo "Added to database";
  oci_free_statement($getUserIngredients);
  oci_close($connection);
?>
