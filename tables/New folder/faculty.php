<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<h1>WELCOME</h1>

<input type="button" onclick = "schedule.php" placeholder="click me">
<?php


     $conn = new mysqli("localhost","root","","ismis");

             $conn = new mysqli('localhost', "root", "", "ismis") or die("Unable to connect.");

            //  $sql = "SELECT * FROM account WHERE account =" . "'".$row['account_id']."'";
            //     $result = $conn->query($sql);
                $sql3 = "SELECT * FROM schedule";
                     $results3 = $conn->query($sql3);
                
                if($results3->num_rows > 0){
                  $row3 = $result3->fetch_assoc();
                  echo"this is your schedule so far".$row["fname"];
                  echo '
                      <table class="table">
                       <thead>
                          <tr>
                          <th scope="col">Monday</th>
                          <th scope="col">Tuesday</th>
                          <th scope="col">Wednesday</th>
                          <th scope="col">Thursday</th>
                          <th scope="col">Friday</th>
                          </tr>
                      </thead>
                      ';
                      while($row = $result->fetch_assoc()){
                        $subjectId = $row['subject_id'];
                     $startTime = $row['start_time'];
                     $endTime = $row['end_time'];
                     $sql2 = "SELECT * FROM subjects WHERE subject_id = $subjectId";
                     $result2 = $conn->query($sql2);
                     
                     $sql4 = "SELECT * FROM time WHERE time_id = $time_id";
                     
                      if($result2->num_rows > 0){
                        $row2 = $result2->fetch_assoc();
                        $subname =$row2["subject_name"];
                         
                          if($row4["monday"]=1){
                            echo "$subname."-".$startTime." - ".$endTime";
                          }else if($row4["tuesday"]=1){
                            echo "$subname."-".$startTime." - ".$endTime";
                          }else if($row4["wednesday"]=1){
                            echo "$subname."-".$startTime." - ".$endTime";
                          }else if($row4["thursday"]=1){
                            echo "$subname."-".$startTime." - ".$endTime";
                          }else if($row4["friday"]=1){
                            echo "$subname."-".$startTime." - ".$endTime";
                          } 
                          
                        
                        
                      }
                      }
                    }
?>
<label for="subject">show the students in what subject</label> 
<label>input the subject</label>
<form action="#">
<input type="text" id="subject" name="subject">
<button type="submit">  
</form>
<?php
 
// select all data
$query = "SELECT * FROM schedule ORDER BY stud_id DESC";
$sql = "SELECT * FROM class";
$sql2 = "SELECT * FROM account";

$result = $conn->prepare($sql);
$result->execute();

$result2 = $conn->prepare($sql2);
$result2->execute();

$stmt = $conn->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();

 
// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
 
//check if more than 0 record found
if($num>0){
 
    // data from database will be here
    $row2 = $result->fetch(PDO::FETCH_ASSOC);
    echo"class{$row2["class_id"]}";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($row3 = $result2->fetch(PDO::FETCH_ASSOC)){
        echo$stud_id." - ".$fname." ".$lname." ( " .$account_type.")";
      }
    } 
 
// if no records found
  }else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
</body>
</html>