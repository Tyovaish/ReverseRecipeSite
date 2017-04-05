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
  $search = '%' . $_POST['ingredient'] . '%';
  echo $search;


  if(isset($_POST['ingredient']) === true && empty($_POST['ingredient']) === false) {
    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');
    // $statement = oci_parse($connection, 'SELECT * FROM RECIPE');
    $statement = oci_parse($connection, 'SELECT RECIPE_NAME, DIRECTIONS FROM RECIPE WHERE UPPER(RECIPE_NAME) LIKE UPPER(:bv_ingredient)');

    oci_bind_by_name($statement, ":bv_ingredient", $search);

    oci_execute($statement);

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
