<?php
  echo "PHP is running      ";

  // $content = [];
  // $doc = new DOMDocument();
  // $doc->loadHTMLFile("index.php");
  // $items = $doc->getElementsByTagName('li');
  // if(count($items) > 0) {
  //   foreach ($items as $li) {
  //     $content[] .= $li->nodeValue;
  //   }
  // }
  // else {
  //   $content[] = $doc->saveHTML();
  // }
  // echo $content[0];

  // echo $_POST['ingredient'];
  $ingredientToAdd = $_POST['ingredient'];
  $customerName='tyovaish';

  if(isset($_POST['ingredient']) === true && empty($_POST['ingredient']) === false) {
    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    // $statement = oci_parse($connection, 'SELECT * FROM RECIPE');
    $addIngredientToDatabase=oci_parse($connection,'INSERT INTO INGREDIENT(INGREDIENTNAME) VALUES(:bv_ingredient)');
    $addIngredientToUser=oci_parse($connection,'INSERT INTO CUSTOMER_OWNS(INGREDIENTNAME,ACCOUNTNAME,INGREDIENTAMOUNTOWNED) VALUES(:bv_ingredient,:bv_customer,5)');
    $customerOwns=oci_parse($connection,'SELECT * FROM CUSTOMER_OWNS');
    $possibleRecipe= oci_parse($connection, 'SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name INTERSECT SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on RECIPE_CONSISTS_OF.INGREDIENTNAME=CUSTOMER_OWNS.INGREDIENTNAME GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME');

    oci_bind_by_name($possibleRecipe, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToUser, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredientToDatabase, ":bv_ingredient", $ingredientToAdd);

    oci_bind_by_name($possibleRecipe, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredientToUser, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredientToDatabase, ":bv_customer", $customerName);



    oci_execute($addIngredientToDatabase);
    oci_execute($addIngredientToUser);
    oci_execute($possibleRecipes);
    oci_execute($customerOwns);

    while (($row = oci_fetch_object($customerOwns))) {
        var_dump($row);
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
