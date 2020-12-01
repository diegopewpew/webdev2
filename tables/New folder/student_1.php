<!DOCTYPE html>
<html>
<head> </head>
<body>

    <div class="modal fade" id="addsubj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">add subject</h5>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group"><br><br>
                <form method="post">
                                <label>subject</label><br>
                                <input type="text" class="form-control" name="subject"><br><br>
                                <label>course code</label><br>
                                <input type="text" class="form-control" name="course_code"><br><br>
                                <label>group num</label><br>
                                <input type="text" class="form-control" name="groupnum"><br><br>
                                <button type="submit" name="register">Register</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        <?php

         $conn = new mysqli('localhost', "root", "", "ismis") or die("Unable to connect.");

         $sql = "SELECT * from schedule";
         $result = $conn->query($sql);                                                     
          if ($result->num_rows > 0) {                                                            
            while($row = $result->fetch_assoc()) {                                                         
              $_SESSION['id'] = $row['class_id'];                                                          
              $sql2 = "SELECT * from class WHERE class_id=".$row['class_id']."";                                                         
              $result2 = $conn->query($sql2);                                                         
              $row2 = $result2->fetch_assoc();                                                       
              $sql4 = "SELECT * from time WHERE time_id=".$row2['time_id']."";                                                         
              $result4 = $conn->query($sql4);                                                          
              $row4 = $result4->fetch_assoc();                                                          
  
              if($result4->num_rows > 0){
                while($row4 = $result->fetch_assoc()){
                //compare inputted $start and database $tstart
                $tstart = $row4['start_time'];
                $tend= $row4['end_time'];
        
                //if $start and $end is less than database $tstart then it fits in the sched,
                //or if $start is after database $tend
                  if(($row4["start_time"] < $tstart && $row4["end_time"]<$tstart) || $row4["start_time"] > $tend){
                    if(isset($_POST['register'])){

                      $sql = "SELECT * FROM subjects";
                      $results = $conn->query($sql);

                      if($results->num_rows > 0){
                        $row = $result->fetch_assoc();

                        $subject = $_POST['subject'];
                        $course_code = $_POST['course_code'];
                        $groupnum = $_POST['group_num'];                              
                        $sql = "INSERT INTO subjects(subject_name, course_code, group_num)
                        VALUES('$subject', '$course_code', '$groupnum')";
                    
                        if(mysqli_query($conn, $sql)){
                        } else {
                            echo "Error: ".$sql."<br>".mysqli_error($conn);
                        }
                      }
                    }
                  }
              }
              }else{
                  echo"your subject conflicts with one of the subjects you already enrolled in";
              }
            }       
            if(mysqli_query($conn, $sql)){
            } else {
                echo "Error: ".$sql."<br>".mysqli_error($conn);
            }
          }
        
        
    ?> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- delteting a record -->


<!-- <?php 
try {
    $sql = "SELECT * FROM subjects";
    $results = $conn->query($sql);

    $id=isset($_GET['$course_code']) ? $_GET['$course_code'] : die('ERROR: Course Code ID not found.');
 
    // delete query
    $query = "DELETE FROM subjects WHERE course_code = $id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
        echo"subject deleted";
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?> -->
    
</body>
</html>