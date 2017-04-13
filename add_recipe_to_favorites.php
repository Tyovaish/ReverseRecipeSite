<?php

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
  $recipeToFavoriteName= $_POST['recipe'];
  $customerName= $_POST['username'];


    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    $addRecipeToFavorite=oci_parse($connection,'INSERT INTO CUSTOMER_FAVORITES(ACCOUNTNAME,RECIPE_NAME) VALUES (:bv_customerName,:bv_recipeToFavoriteName)');

    oci_bind_by_name($addRecipeToFavorite, ":bv_recipeToFavoriteName", $recipeToFavoriteName);
    oci_bind_by_name($addRecipeToFavorite, ":bv_customerName", $customerName);

    oci_execute($addRecipeToFavorite);

    echo $recipeToFavoriteName;

  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($addRecipeToFavorite);
  oci_close($connection);
?>
