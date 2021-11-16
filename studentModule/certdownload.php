<?php
session_start();
include('includes/config.php'); 
$docno = $_GET['docno'];
$sql = "SELECT * FROM bonafide_cert WHERE DocumentNumber=:docno";
$query = $dbh->prepare($sql);
// $query->bindParam(':admno',$admno,PDO::PARAM_STR);
$query->bindParam(':docno',$docno,PDO::PARAM_STR);
$query->execute();  
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach($results as $result)
    {
         header('Content-Type:'.$result->mime);
         header("Content-Disposition: attatchment; filename=bonafide-cert.pdf");
         echo $result->pdf_file;
    }
}
