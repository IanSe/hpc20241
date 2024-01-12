<?php
$conn=mysqli_init(); 
mysqli_ssl_set($conn, NULL, NULL, "./../conn/DigiCertGlobalRootG2.crt.pem", NULL, NULL); 
if(!mysqli_real_connect($conn, "dinadb.mysql.database.azure.com", "dinamita@dinadb", "azure12_", "form", 3306)){
    die("Connect Error: " . mysqli_connect_error());
}
?>