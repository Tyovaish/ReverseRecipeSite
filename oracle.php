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
  $customerName='tyovaish'
	
  if(isset($_POST['ingredient']) === true && empty($_POST['ingredient']) === false) {
    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');
    // $statement = oci_parse($connection, 'SELECT * FROM RECIPE');
    $addIngredient=oci_parse($connection,'INSERT INTO CUSTOMER_OWNS(INGREDIENTNAME,ACCOUNTNAME,INGREDIENTAMOUNTOWNED) VALUES(:bv_ingredient,:bv_customerName,5)');
    $possibleRecipes= oci_parse($connection, '(SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF GROUP BY recipe_Name) INTERSECT (SELECT RECIPE_CONSISTS_OF.RECIPE_NAME as recipe_Name, COUNT(*) FROM RECIPE_CONSISTS_OF JOIN CUSTOMER_OWNS on RECIPE_CONSISTS_OF.INGREDIENTNAME=CUSTOMER_OWNS.INGREDIENTNAME GROUP BY RECIPE_CONSISTS_OF.RECIPE_NAME)');
    oci_bind_by_name($possibleRecipe, ":bv_ingredient", $ingredientToAdd);
    oci_bind_by_name($addIngredient, ":bv_ingredient", $ingredientToAdd);
     oci_bind_by_name($possibleRecipe, ":bv_customer", $customerName);
    oci_bind_by_name($addIngredient, ":bv_customer", $customerName);
 
    oci_execute($addIngredient);
    oci_execute($possibleRecipes);


    while (($row = oci_fetch_object($statement))) {
        var_dump($row);
    }
  }

  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($statement);
  oci_close($connection);
?>
