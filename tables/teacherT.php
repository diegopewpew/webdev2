<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  see all students
</button>


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
                                                          $sql3 = "SELECT * from account WHERE account_id=".$_SESSION['users'][$_SESSION['loggedIn']]['id']."";
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
                                                                <td>
                                                                
                                                                
                                                                
                                                                </td>
                                                                </tr>    ";
                                                        }
                                                    } else {
                                                        echo "<td> create time first <td>";
                                                    }
                                                ?>
                                                </table>
       

      <table class="table table-hover">
                      <tr class="table-active">
                          <th scope="row">id</th>
                          <th>subject</th>
                          <th>course code</th>
                          <th>group num</th>
                      </tr>
        <?php
        $sql = "SELECT * FROM  class WHERE faculty_id=".$_SESSION['users'][$_SESSION['loggedIn']]['id'].""; 
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $sql6 = "SELECT * FROM schedule WHERE class_id=".$row['class_id']."";
                  $result6 = $conn->query($sql6);
                  $row6 = $result6->fetch_assoc();
                   $sql1 = "SELECT * FROM account WHERE account_id=".$row6['student_id']."";
                  $result1 = $conn->query($sql1);
                  $row1 = $result1->fetch_assoc();
                 
                  echo "
                      <tr>
                          <td>".$row1['account_id']."</td>
                          <td>".$row1['fname']."</td>
                          <td>".$row1['lname']."</td>
                      </tr>
                  ";
              }
            
        } else {
            echo "<td> create subject first <td>";
        }
         ?>   
         </table>
      </div>
      