<?php
require "connectDB.php";

if (isset($_POST) && !empty($_POST)){
  if(isset($_POST["email"]) && !empty($_POST["email"])){
    $email = $_POST["email"];
    $req = "SELECT EXISTS(SELECT * from subscription WHERE address=:email)";
    $statement = $bddConnect->prepare($req);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch();
    //var_dump($result);
    if ($result[0]==="1") {
      header("location:form.php?message=L'email existe déjà");
    }else{
      $reqInsert = "INSERT INTO subscription (address) value (:email)";
      $statInsert = $bddConnect->prepare($reqInsert);
      $statInsert->bindValue(":email", $email, PDO::PARAM_STR);
      $statInsert->execute();
      header("location:form.php?message=L'email à bien été pris en compte");
    }

  }else {
    header("location:form.php?message=");
  }
}
 ?>
