<div class="btn-group btn-group-toggle m-10" data-toggle="buttons">
  <label class="btn btn-secondary btn-lg">
    <input type="checkbox" checked="" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#addsubj"> Add subject.
  </label>
  </div>

  <table class="table table-hover">
    <tr class="table-light">
    <H1 class="p-50">SCHEDULES</H1><br>

    <th scope="row">scheduel code </th>
            <th>subject</th>
            <th> group number</th>
            <th>days of the week</th>               
            <th>start</th>        
            <th>end</th>  
            <th>teacher</th>  
            <th>student</th>  
            <th>delete</th> 

            </tr>
            
            <?php
                                                    $sql = "SELECT * from schedule
                                                     ";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                          $_SESSION['id'] = $row['class_id'];
                                                          $sql2 = "SELECT * from class WHERE class_id=".$row['class_id']."";
                                                          $result2 = $conn->query($sql2);
                                                          $row2 = $result2->fetch_assoc();
                                                          $sql3 = "SELECT * from account WHERE account_id=".$row2['faculty_id']."";
                                                          $result3 = $conn->query($sql3);
                                                          $row3 = $result3->fetch_assoc();
                                                          $sql4 = "SELECT * from time WHERE time_id=".$row2['time_id']."";
                                                          $result4 = $conn->query($sql4);
                                                          $row4 = $result4->fetch_assoc();
                                                          $sql5 = "SELECT * from subjects WHERE subject_id=".$row2['subject_id']."";
                                                          $result5 = $conn->query($sql5);
                                                          $row5 = $result5->fetch_assoc();
                                                          $sql6 = "SELECT * from account WHERE account_id=".$_SESSION['users'][$_SESSION['loggedIn']]['id']."";
                                                          $result6 = $conn->query($sql6);
                                                          $row6 = $result6->fetch_assoc();
                                                          
                                                          ?>
                                                          <tr class="table-light">
                                                          <?php
                                                            echo "
                                                            
                                                                <td>".$row['schedule_id']."</td>
                                                                <td>".$row5['subject_name']."</td>
                                                                <td>".$row5['group_num']."</td>
                                                                
                                                                
                                                                <td>";
                                                                if($row4['monday']==='1'){
                                                                  echo"M ,";
                                                                }
                                                                if($row4['tuesday']==='1'){
                                                                  echo"T ,";
                                                                }
                                                                if($row4['wednesday']==='1'){
                                                                  echo"W ,";
                                                                }
                                                                if($row4['thursday']==='1'){
                                                                  echo"TH ,";
                                                                }
                                                                if($row4['friday']==='1'){
                                                                  echo"F ";
                                                                }
                                                                echo"</td>
                                                                <td>".$row4['start_time']."</td>
                                                                <td>".$row4['end_time']."</td>
                                                                <td>".$row3['fname']." ".$row3['lname']."</td>
                                                                <td>".$row6['fname']." ".$row6['lname']."</td>
                                                            
                                                            <td>
                                                            <form action='wazap.php' method='POST'>
                                                                <button name='delete' value='".$row['schedule_id']."'>Delete</button>
                                                                </form>
                                                                </td>
                                                                </tr>    ";
                                                        }
                                                    } else {
                                                        echo "<td> create time first <td>";
                                                    }
                                                ?>
       


       <?php
if(isset($_POST['delete'])){
                echo $_POST['delete']."hello";
                $sql = "DELETE FROM schedule WHERE schedule_id=".$_POST['delete'];
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
            ?>



    </table> 


  <div class="modal fade" id="addsubj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">add subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="wazap.php" method="post">
                        <label for="female">subject</label>
                                <select id="cars" name="classcode" >
                                <?php
                                                $sql = "SELECT * FROM class ";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                      $sql2 = "SELECT * FROM subjects WHERE subject_id=".$row['subject_id']."";
                                                      $result2 = $conn->query($sql2);
                                                      $row2 = $result2->fetch_assoc();
                                                        echo "
                                                        <option value=".$row['class_id'].">".$row2['course_code']." - ".$row2['group_num']."</option>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<td> create time first <td>";
                                                }
                                            ?>
                                </select><br>
                                <label for="female">student</label>
                                <select id="cars" name="addstud" >
                                  
                                </select> <br>
            
                                <button type="submit" name="yes">Register</button>
      </fourm>
                      <?php
                      if(isset($_POST['yes'])){
                        $classid = $_POST['classcode'];
                        $studid = $_SESSION['users'][$_SESSION['loggedIn']]['id'];
                        $tval = 1;
                          $sql = "SELECT * FROM schedule WHERE student_id='$studid'";
                          $result = $conn->query($sql);
                          $sql3 = "SELECT * FROM class WHERE class_id='$classid'";
                          $result3 = $conn->query($sql3);
                          $row3 = $result3->fetch_assoc();
                          $sql5 = "SELECT * FROM time WHERE time_id= ".$row3['time_id']."";
                          $result5 = $conn->query($sql5);
                          $row5 = $result5->fetch_assoc();
                          if($row3['max_studnum']>$row3['stud_count']){
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                $sql2 =  "SELECT * FROM  class WHERE class_id=".$row['class_id']."";
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                $sql4 =  "SELECT * FROM  time WHERE time_id=".$row2['time_id']."";
                                $result4 = $conn->query($sql4);
                                $row4 = $result4->fetch_assoc();
                                if(($row5['monday']=='1'&& $row4['monday']=='1')||($row5['tuesday']=='1'&& $row3['tuesday']=='1')||($row5['wednesday']=='1'&& $row3['wednesday']=='1')||($row5['thursday']=='1'&& $row3['thursday']=='1')||($row5['friday']=='1'&& $row3['friday']=='1')){
                                    if(($row5['start_time']< $row4['start_time'] && $row5['end_time']< $row4['start_time'])|| $row5['start_time']< $row4['end_time'] ){

                                    }else{
                                      $tval = 0;
                                    }

                                }
                                
                                }
                              
                                
                              
                              }
                            }
                            if($tval==1){
                                $addnew="INSERT INTO schedule(class_id,student_id)
                                VALUES('$classid', '$studid')";

                                if(mysqli_query($conn, $addnew)){
                                $sql2 =  "SELECT * FROM  class WHERE class_id='$classid'";
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                $row2['stud_count']= $row2['stud_count'] + 1;
                              } else {
                                  echo "Error: ".$sql."<br>".mysqli_error($conn);
                              }
                          }
                      }
                        ?>



             
      </div>
      
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

