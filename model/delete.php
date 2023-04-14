<?php

function deleteUser($pk){
    include('connection.php');
     $query = "DELETE FROM ifo_user
               WHERE userID = :pk";
     $query_params = array(":pk" => $pk);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
  }


?>