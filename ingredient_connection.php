
<?php
  // SELECT INGREDIENT2_NAME FROM ( SELECT INGREDIENT2_NAME FROM INGREDIENT_CONNECTIONS
  // ORDER BY dbms_random.value ) where rownum=1;
  // SELECT INGREDIENTNAME FROM ( SELECT INGREDIENTNAME FROM INGREDIENT
  // ORDER BY dbms_random.value ) where rownum=1;
  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');
$ingredient1FromIngredientTable=false;
$ingredient2FromIngredientTable=false;
  if(rand(0,10)==0){
  $getFirstIngredient=oci_parse($connection,'SELECT INGREDIENTNAME FROM (SELECT INGREDIENTNAME FROM INGREDIENT ORDER BY dbms_random.value ) where rownum=1');
  $ingredient1FromIngredientTable=true;
  } else {
    $getFirstIngredient=oci_parse($connection,'SELECT INGREDIENT2_NAME FROM (SELECT INGREDIENT2_NAME FROM INGREDIENT_CONNECTIONS ORDER BY dbms_random.value ) where rownum=1');
  }
  if(rand(0,10)==0){
  $getSecondIngredient=oci_parse($connection,'SELECT INGREDIENTNAME FROM (SELECT INGREDIENTNAME FROM INGREDIENT ORDER BY dbms_random.value ) where rownum=1');
    $ingredient2FromIngredientTable=true;
} else {
    $getSecondIngredient=oci_parse($connection,'SELECT INGREDIENT2_NAME FROM (SELECT INGREDIENT2_NAME FROM INGREDIENT_CONNECTIONS ORDER BY dbms_random.value ) where rownum=1');
}
  oci_execute($getFirstIngredient);
  oci_execute($getSecondIngredient);
  $ingredient1=oci_fetch_object($getFirstIngredient);

  $INGREDIENT1_NAME;
  if($ingredient1FromIngredientTable){
  $INGREDIENT1_NAME=trim($ingredient1->INGREDIENTNAME);
  echo $ingredient1->INGREDIENTNAME.'|';
} else {
    $INGREDIENT1_NAME=trim($ingredient1->INGREDIENT2_NAME);
    echo $ingredient1->INGREDIENT2_NAME.'|';
}
  $ingredient2=oci_fetch_object($getSecondIngredient);
  $INGREDIENT2_NAME;

if($ingredient2FromIngredientTable){
    $INGREDIENT2_NAME=trim($ingredient2->INGREDIENTNAME);
  echo $ingredient2->INGREDIENTNAME.'|';
} else {
    $INGREDIENT2_NAME=trim($ingredient2->INGREDIENTNAME);
    echo $ingredient2->INGREDIENT2_NAME.'|';
}

  $insertIntoRelation=oci_parse($connection,'INSERT INTO INGREDIENT_CONNECTIONS(INGREDIENT1_NAME,INGREDIENT2_NAME) VALUES (:bv_ingredient1,:bv_ingredient2)');
  oci_bind_by_name($insertIntoRelation,':bv_ingredient1',$INGREDIENT1_NAME);
  oci_bind_by_name($insertIntoRelation,':bv_ingredient2',$INGREDIENT2_NAME);
  oci_execute($insertIntoRelation);
  $insertIntoRelation2=oci_parse($connection,'INSERT INTO INGREDIENT_CONNECTIONS(INGREDIENT1_NAME,INGREDIENT2_NAME) VALUES (:bv_ingredient1,:bv_ingredient2)');
  oci_bind_by_name($insertIntoRelation2,':bv_ingredient1',$INGREDIENT2_NAME);
  oci_bind_by_name($insertIntoRelation2,':bv_ingredient2',$INGREDIENT1_NAME);
  oci_execute($insertIntoRelation2);
//
// VERY important to close Oracle Database Connections and free statements!
//
oci_free_statement($getFirstIngredient);
oci_free_statement($getSecondIngredient);
oci_free_statement($insertIntoRelation);
oci_free_statement($insertIntoRelation2);
oci_close($connection);
?>
