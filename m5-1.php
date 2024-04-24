<!DOCTYPE html>
<html lang="jp">
    
     <head>
     <meta charset="UTF-8">
     <title>mission_3-5</title>
 </head>
   
    <body>
        
           <?php

            $comment="";
            $edit_num="";
            $pass="";
            $editname="";

           if(!empty($_POST["comment"])){
              $comment= $_POST["comment"]; 
           }
           if(!empty($_POST["name"])){
               $name=$_POST["name"];
           }
            
            if(!empty($_POST["delete_num"])){
                $delete=$_POST["delete_num"];
            }
            
          if(!empty($_POST["edit"])){
              $edit=$_POST["edit"];
          } 
            
            if(!empty($_POST["pass"])){
                $pass=$_POST["pass"];
            }
            
            
            $filename="mission_5-1.txt";  
         $date = date("Y年m月d日　H時i分s秒");
          if(file_exists($filename)){
          $lines = file($filename,FILE_IGNORE_NEW_LINES);
              $end=end($lines);
              $end_explode=explode("<>",$end);
              $num= (int)$end_explode[0]+1;
     }else{
         $num=1;
     }
   
    if(isset($_POST["edit_num"]) && !empty($_POST["edit_num"])){
      $num = $_POST["edit_num"];
        
}
      $dsn = 'mysql:dbname=tb250573db;host=localhost';
$user = 'tb-250573';
$password = 'GZuFhxhz2u'; 
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "CREATE TABLE IF NOT EXISTS tb5_11"
 ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name CHAR(32),"
    . "comment TEXT,"
    . "password TEXT"
    .");";
    $stmt = $pdo->query($sql);
       
 if(!empty($_POST["comment"]) && !empty($_POST["name"])){
             if(!empty($_POST["edit_number"])){
                 $id = $_POST["edit_number"];
                   $sql = 'UPDATE tb5_11 SET name=:name,comment=:comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
           $edit_pass= $_POST["pass"];
            $edit_num = $_POST["edit_num"];

             }else{
 $sql = "INSERT INTO tb5_11 (name, comment,password) VALUES (:name, :comment, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
    $stmt->execute();
 }}else if(!empty($_POST["delete_num"])&& !empty($_POST["pass"]) and !empty($_POST["delete"])){
$id = $delete;
$sql = 'SELECT * FROM tb5_11';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
 foreach ($results as $row){
         $rowpass=$row['password'];
 
 }
 
         if($rowpass == $pass){
      $sql = 'delete from tb5_11 where id=:id';
 $stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
}

}

         
if(isset($_POST["edit"]) && !empty($_POST["edit_num"]) &&!empty($_POST["pass"])){
       $edit_num=$_POST["edit_num"];  
$id = $_POST["edit_num"];
$sql = 'SELECT * FROM tb5_11 where id=:id';
 $stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll();
 foreach ($results as $row){
         
         $rowpass=$row['password'];
 }
    
 
         if($rowpass == $pass){
    foreach($results as $row){
        $editname=$row['name'];
        $comment=$row['comment'];
    }


 }

        }
        


  
      
     
     ?>

      <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力" value="<?php if(isset($_POST["edit_num"]) && !empty($_POST["edit_num"])){echo $editname;}?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php      if(isset($_POST["edit_num"]) && !empty($_POST["edit_num"])){echo $comment;}?>" >
      <input type="hidden" name="edit_number" value="<?php echo $edit_num;?>" <input type="<?php echo $edit_num; ?>" name='edit_num' value="<?php echo $number; ?>" readonly>  
       <input type="password"  name="pass" placeholder="パスワード" >
        <input type="submit" name="<?php if(isset($edit_num)&&($value[0]==$edit_num)){echo "編集済み";}?>" >
        <input type="number" name="delete_num" placeholder="削除対象番号">
        <input type="submit" name="delete" value="削除">
          <input type="number" name="edit_num" placeholder="編集番号">
        <input type="submit" name="edit" value="編集">
        
    </form>
        
    </body>
    </html>
    <?php
    $sql = 'SELECT * FROM tb5_11';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
 foreach ($results as $row){
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
 }
   
       
       ?>