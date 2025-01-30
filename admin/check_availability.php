<?php 
require_once("includes/config.php");
//code check email
if(!empty($_POST["isbn"])) {
$isbn=$_POST["isbn"];
$sql ="SELECT id FROM tblbooks WHERE ISBNNumber=:isbn";
$query= $dbh -> prepare($sql);
$query-> bindParam(':isbn', $isbn, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0){
    //AQUI EU SETO O TEXTO QUE VOU RETORNAR
echo "<span style='color:red'> ISBN já pertence a outro livro.</span>"; 
//AQUI EU DESABILITO O BOTÃO GRAVAR
echo "<script>$('#add').prop('disabled',true);</script>";
} else { echo "<script>$('#add').prop('disabled',false);</script>";}
}