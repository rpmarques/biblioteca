<?php
require_once("includes/config.php");
if (!empty($_POST["studentid"])) {
  $studentid = strtoupper($_POST["studentid"]);

  $sql = "SELECT FullName,Status,EmailId,MobileNumber FROM tblstudents WHERE StudentId=:studentid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      if ($result->Status == 0) {
        echo "<span style='color:red'> Estudante bloqueado, verifique no cadastro. </span>" . "<br />";
        echo "<b>Student Name-</b>" . $result->FullName;
        echo "<script>$('#submit').prop('disabled',true);</script>";
      } else {
        echo 'Nome: '.htmlentities($result->FullName) . "<br />";
        echo 'Email: '.htmlentities($result->EmailId) . "<br />";
        echo 'Fone: '.htmlentities($result->MobileNumber);
        echo "<script>$('#submit').prop('disabled',false);</script>";
      }
    }
  } else {
    echo "<span style='color:red'> Credencial Inválida, verifique .</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}
?>
