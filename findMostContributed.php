<?php
    $connection = oci_connect($username = 'keanu',
                              $password = 'h1llY3s!',
                              $connection_string = '//oracle.cise.ufl.edu/orcl');

    $findMostContributed=oci_parse($connection,'SELECT RECIPE_AUTHOR,COUNT(*) FROM RECIPE WHERE RECIPE_AUTHOR IS NOT NULL GROUP BY RECIPE_AUTHOR ORDER BY COUNT(*) DESC');

    oci_execute($findMostContributed);

    while (($row = oci_fetch_object($findMostContributed))) {
      echo $row->RECIPE_AUTHOR . '|';
    }

  //
  // VERY important to close Oracle Database Connections and free statements!
  //
  oci_free_statement($statement);
  oci_close($connection);
?>
