<?php
  $customerUsername=$_POST['username']; // Fetching Values from URL.
  $customerPassword= $_POST['password']; // Password Encryption, If you like you can also leave sha1.

  $connection = oci_connect($username = 'keanu',
                            $password = 'h1llY3s!',
                            $connection_string = '//oracle.cise.ufl.edu/orcl');

  // echo $customerUsername;
  $login=oci_parse($connection,'SELECT * FROM CUSTOMER WHERE ACCOUNTNAME=:bv_uname');
  oci_bind_by_name($login,':bv_uname',$customerUsername);
  oci_execute($login);
  $row=oci_fetch_object($login);
  if($row->PASSWORD==$customerPassword) {
      echo 'SUCCESS!';
  }
  else {
    $newUser=oci_parse($connection,'INSERT INTO CUSTOMER(ACCOUNTNAME,PASSWORD) VALUES (:bv_uname,:bv_password)');
    oci_bind_by_name($newUser,':bv_uname', $customerUsername);
    oci_bind_by_name($newUser,':bv_password', $customerPassword);
    oci_execute($newUser);
    echo 'Added New User!';
  }
  oci_free_statement($login);
  oci_free_statement($newUser);
  oci_close($connection);
?>
