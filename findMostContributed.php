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


    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    $findMostContributed=oci_parse($connection,'SELECT RECIPE_AUTHOR,COUNT(*) FROM RECIPE WHERE RECIPE_AUTHOR IS NOT NULL GROUP BY RECIPE_AUTHOR ORDER BY COUNT(*) ASC');
   
    oci_execute($findMostContributed);

    while (($row = oci_fetch_object($findMostContributed))) {
        var_dump($row);
    }

  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($statement);
  oci_close($connection);
?>
