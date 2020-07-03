
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Home</title>
	<link rel="stylesheet" type="text/css" href="css/userhome.css">
	<script type="text/javascript" src="js/userhome.js"></script>
</head>

<body>
  <?php include "userSlide.php"; ?>
  	<div style="margin-left: 220px; margin-top: 60px; margin-right: 50px; margin-bottom: 70px;">
<!------------------------------------------------------------------------------------  -->
	<div class="container">
			<p><b>User Home</b></p>
	</div>

	<div class="container">
			<hr class="hr">
	</div>
<!-- ----------------------------------------------------------------------------------- -->
 <div style="margin-left: 200px;margin-right: 20px;">
  <div class="row">
<!-- -------------------------------------------------------------- -->
<?php

  $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "dbphp";
  $con = mysqli_connect($host,$dbusername,$dbpassword,$dbname);

  if (!$con) {
          # code...
          die("connection fail....".mysqli_connect_error());
      }
?>
<!-- ----------------------student detail---------------------------------------------- -->
  	<form action="userHome.php" method="Post">
  	<div class="column" onclick="studetail()">
      <div >
        <label class="a"><a href="userDetail.php"> Student detail</a></label>
       </div> 
    </div>
    <div class="search">
    	<div class="space">
    			<label style="height: 40px;"><input type="text" name="search" placeholder="Enter exam rollno"></label>
    			<button type="submit" name="submit">Search</button>
    	</div>
    </div>
		</form>

  </div> 	
 
</div>

<!-- -------------------------------------------------- -->
<div style=" margin-top: 180px;">
	<hr class="hr">
</div>
  
<!-- ----------------------------------------------------- -->
 <!-- ------------------------------ -->
    <?php 
     if (isset($_POST['submit'])){ 
        $erol=$_POST['search'];

        $block=0;
        $room=0;
        $sql="SELECT * FROM seatplan WHERE '$erol' BETWEEN start1 AND end1";
        $result = mysqli_query($con,$sql);
       $row=mysqli_num_rows($result);
         if ($row>0) {
                 while($row = mysqli_fetch_array($result)){
                     $id=$row['id'];    
                     $block=$row['block'];
                     $room=$row['roomno'];
                   }
              }
            
        $sql="SELECT * FROM seatplan WHERE '$erol' BETWEEN start2 AND end2";
        $result = mysqli_query($con,$sql);
       $row=mysqli_num_rows($result);
         if ($row>0) {
                 while($row = mysqli_fetch_array($result)){
                     $id=$row['id'];
                     $block=$row['block'];
                     $room=$row['roomno'];
                }
            }
          ?>
          <div style="margin-left: 30%; font-size: 15px;"><h3>
            <label> Exam Roll : <?php  echo $erol."  ";?> </label><br>
             <label > Block : <?php  echo $block."  ";?> </label><br>
              <label > Room no : <?php  echo $room."  ";?> </label>
             </h3>
          </div>

          <?php
      }
    ?>
  <!-- ------------------------------ -->
<!-- ---------------------------------------------------- -->
<div style="margin-top: 20px;">
<?php 
//////////////////////////////////////////////////////////////////
    $roll=$_SESSION['uname']; 

    		$detailsql="SELECT * FROM stuData WHERE roll='$roll'";
    		$run=mysqli_query($con,$detailsql);
            $rowdetail=mysqli_num_rows($run);
            if($rowdetail>0){
            	while($rowdetail = mysqli_fetch_array($run)){
            		$dep=$rowdetail['dep'];
            	}
        }
           
//////////////////////////////////////////////////////////////////////

      if (isset($_POST['submit'])){ 
        $erol=$_POST['search'];

        
///////////////------------------first part-------------------//////
    		$sql="SELECT * FROM seatplan WHERE '$erol' BETWEEN start1 AND end1";
    		$result = mysqli_query($con,$sql);
    	 $row=mysqli_num_rows($result);
      
     		 if ($row>0) {
               	 while($row = mysqli_fetch_array($result)){
                 	   $id=$row['id'];
                 	   $block=$row['block'];
                 	   $room=$row['roomno'];
                     $semester=$row['sem'];
                     $subject=$row['sub'];
                     $dep1=$row['dep1'];
                     $start_roll1=$row['start1'];
                     $end_roll1=$row['end1'];
                     $dep2=$row['dep2'];
                     $start_roll2=$row['start2'];
                     $end_roll2=$row['end2'];
                     $sem=explode(",", $semester);
                     $sub=explode(" & ", $subject);


  
 // /////////////////////////////seat plan  inifo table/////////////
     ?>  
          <div style="margin-left: 400px;">
                <p><b>Seat Arangement</b></p>
          </div>
            <div class="seat">
              <div style="margin-left: 50px; margin-top: 20px;margin-bottom: 20px;">
                <table border="2" class="table" >
                    <tr>
                        <td colspan="2" align="center" class="td">Block : <?php echo "$block"; ?>; Roll no = <?php echo $room; ?>; DEP = <?php echo $dep1; ?> & <?php echo $dep2; ?>; 
                          semester = <?php echo $sem[0]; ?> & <?php echo $sem[1]; ?> </td>
                    </tr>
                    <tr>
                        <td >column 1</td>
                        <td >column 2</td>
                    </tr>
                </table>
            <div style="float: left;">

<?php

  $col=2;
  $sql4="SELECT * FROM room where roomno=$room ";
  $result4 = mysqli_query($con,$sql4);
  $row4=mysqli_num_rows($result4);  
 if ($row4>0) {
                while($row4 = mysqli_fetch_array($result4)){
                    $room=$row4['roomno'];
                    $row=$row4['row'];
         }
   }
  // end if (row4) room 

$sql1="SELECT * FROM `stuData` WHERE sem LIKE $sem[0] AND dep LIKE '%$dep1[0]%' ";
$sql2="SELECT * FROM `stuData` WHERE sem LIKE $sem[1] AND dep LIKE '%$dep2[1]%' ";

  $result1 =  mysqli_query($con,$sql1);
  $result2 =  mysqli_query($con,$sql2);

  $row1=mysqli_num_rows($result1);
  $row2=mysqli_num_rows($result2);
 

 /////////////////////////column=1//////////////////////////////////
     for( $i=1; $i<=$row; $i++ ) {
        for( $j=1; $j<=$col; $j++ ) {
            if ($j==1){
          ?>  
                <table  class="box" >
                    <tr>
                        <td > 
         <?php    
              if ( $erol==$start_roll1) {
                   echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
               }
              if ($start_roll1!=$end_roll1+1) {
                   echo $start_roll1++." ".$sub[0]." ".$dep1."<pre></pre>";
              }

          
            }
          else{  
        
         ?>
              </td>
              <td style="float: right;">
         <?php

              if ( $erol==$start_roll2) {
                echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
              }
              if ($start_roll2!=$end_roll2+1) {
                   echo $start_roll2++." ".$sub[1]." ".$dep2."<pre></pre>";
              }
         ?> 
                    </td>          
                 </tr>
              </table>
         <?php  
             }
            }
            //END for loop(j - columw)  closw
        ?>
            <br>
            <br>
        <?php
        }
          //END FOR loop( i - row) close
        ?>
          </div>
        <?php
  //////////////////////////column=2//////////////////////////////////////////////
         for( $i=1; $i<=$row; $i++ ) {
        for( $j=1; $j<=$col; $j++ ) {
            if ($j==1){
          ?>  
                <table  class="box" >
                    <tr>
                        <td > 
         <?php     
              if ( $erol==$start_roll1) {
                echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
              }
              if ($start_roll1!=$end_roll1+1) {
                   echo $start_roll1++." ".$sub[0]." ".$dep1."<pre></pre>";
              }
            }
          else{  
         ?>
                </td>
                <td style="float: right;">
         <?php
             if ( $erol==$start_roll2) {
              echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
            }
              if ($start_roll2!=$end_roll2+1) {
                   echo $start_roll2++." ".$sub[1]." ".$dep2."<pre></pre>";
              }
         ?> 
                    </td>          
                 </tr>
            </table>
         <?php  
             }
            }
            //END for loop(j - columw)  closw
        ?>  
            <br>
            <br>
        <?php
        }
          //END FOR loop( i - row) close
  ///////////////////////////////column=1 and 2 end///////////////////////////////////////
    ?>     
          </div>

        </div>

      <div style="margin-top: 40px;">
          <hr class="hr">
      </div>
    <?php             		 
                 }
         		}
            //end if ,while ....first part 

///////////////////---------second part---------------------///////////////////
       $sql="SELECT * FROM seatplan WHERE '$erol' BETWEEN start2 AND end2";
        $result = mysqli_query($con,$sql);
       $row=mysqli_num_rows($result);
       
        echo "<br>";
         if ($row>0) {
                 while($row = mysqli_fetch_array($result)){
                     $id=$row['id'];
                     $block=$row['block'];
                     $room=$row['roomno'];
                     $semester=$row['sem'];
                     $subject=$row['sub'];
                     $dep1=$row['dep1'];
                     $start_roll1=$row['start1'];
                     $end_roll1=$row['end1'];
                     $dep2=$row['dep2'];
                     $start_roll2=$row['start2'];
                     $end_roll2=$row['end2'];
                     $sem=explode(",", $semester);
                     $sub=explode(" & ", $subject);

   //                   echo $id." ".$block." ".$room;
   //         echo "<br>";
   // echo " sem=".$sem[0]."  ".$sem[1]." sub=".$sub[0]." ".$sub[1]." ".$dep1." ".$start_roll1." ".$end_roll1." ".$dep2." ".$end_roll2." ".$end_roll2;
   //                    echo "--------2--------";
   //                    echo "<br>";
//-------------------------------------------------------------

 // /////////////////////////////seat plan  info table/////////////
     ?>  
          <div style="margin-left: 400px;">
                <p><b>Seat Arangement</b></p>
          </div>
            <div class="seat">
              <div style="margin-left: 50px; margin-top: 20px;margin-bottom: 20px;">
                <table border="2" class="table" >
                    <tr>
                        <td colspan="2" align="center" class="td">Block : <?php echo "$block"; ?>; Roll no = <?php echo $room; ?>; DEP = <?php echo $dep1; ?> & <?php echo $dep2; ?>; 
                          semester = <?php echo $sem[0]; ?> & <?php echo $sem[1]; ?> </td>
                    </tr>
                    <tr>
                        <td >column 1</td>
                        <td >column 2</td>
                    </tr>
                </table>
            <div style="float: left;">

<?php

  $col=2;
  $sql4="SELECT * FROM room where roomno=$room ";
  $result4 = mysqli_query($con,$sql4);
  $row4=mysqli_num_rows($result4);  
 if ($row4>0) {
                while($row4 = mysqli_fetch_array($result4)){
                    $room=$row4['roomno'];
                    $row=$row4['row'];
         }
   }
  // end if (row4) room 

$sql1="SELECT * FROM `stuData` WHERE sem LIKE $sem[0] AND dep LIKE '%$dep1[0]%' ";
$sql2="SELECT * FROM `stuData` WHERE sem LIKE $sem[1] AND dep LIKE '%$dep2[1]%' ";

  $result1 =  mysqli_query($con,$sql1);
  $result2 =  mysqli_query($con,$sql2);

  $row1=mysqli_num_rows($result1);
  $row2=mysqli_num_rows($result2);
 

 /////////////////////////column=1//////////////////////////////////
     for( $i=1; $i<=$row; $i++ ) {
        for( $j=1; $j<=$col; $j++ ) {
            if ($j==1){
          ?>  
                <table  class="box" >
                    <tr>
                        <td > 
         <?php    
              if ( $erol==$start_roll1) {
                echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
              }
              if ($start_roll1!=$end_roll1+1) {
               echo $start_roll1++." ".$sub[0]." ".$dep1."<pre></pre>";
              }
            }
          else{  
         ?>
              </td>
              <td style="float: right;">
         <?php

              if ( $erol==$start_roll2) {
                echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
              }
               if ($start_roll2!=$end_roll2+1) {
                echo $start_roll2++." ".$sub[1]." ".$dep2."<pre></pre>";
              }
         ?> 
                    </td>          
                 </tr>
              </table>
         <?php  
             }
            }
            //END for loop(j - columw)  closw
        ?>
            <br>
            <br>
        <?php
        }
          //END FOR loop( i - row) close
        ?>
          </div>
        <?php
  //////////////////////////column=2//////////////////////////////////////////////
         for( $i=1; $i<=$row; $i++ ) {
        for( $j=1; $j<=$col; $j++ ) {
            if ($j==1){
          ?>  
                <table  class="box" >
                    <tr>
                        <td > 
         <?php     
                if ( $erol==$start_roll1) {
                  echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
                }
               if ($start_roll1!=$end_roll1+1) {
                   echo $start_roll1++." ".$sub[0]." ".$dep1."<pre></pre>";
              }
            }
          else{  
         ?>
                </td>
                <td style="float: right;">
         <?php
             if ( $erol==$start_roll2) {
              echo "<h4 align='center' style=background-color:yellow font-family=cursive;>$erol</h4> ";
            }
              if ($start_roll2!=$end_roll2+1) {
                   echo $start_roll2++." ".$sub[1]." ".$dep2."<pre></pre>";
              }
         ?> 
                    </td>          
                 </tr>
            </table>
         <?php  
             }
            }
            //END for loop(j - columw)  closw
        ?>  
            <br>
            <br>
        <?php
        }
          //END FOR loop( i - row) close
  ///////////////////////////////column=1 and 2 end///////////////////////////////////////
    ?>     
          </div>
        </div>

      <div style="margin-top: 40px;">
          <hr class="hr">
      </div>
    <?php  
                   }
            }
///-------------------------------second part end------------------//
    }
    //end  if (isset($_POST['submit']))

 ?>

<!-- --------------------------------------------------------------------------- -->
        </div>
	</div>
</body>
</html>