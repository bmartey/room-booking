<?php
  session_start();
  
  $sessname=$_SESSION['USERNAME'];
  $sessfirstname=$_SESSION['FNAME'];
  $sesslastname=$_SESSION['LNAME'];
  $sessemail=$_SESSION['EMAIL'];

  if(!isset($_SESSION['USERNAME'])){
    header("Location: admin.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
    <title>Admin Access</title>
    <link rel="shortcut icon" type="image/png" href="NCA.png"/>

    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="foundation/fonts/foundation-icons.css">
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">  
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/vendor/foundation.min.js"></script>
    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="dist/sweetalert.min.js"></script>
    <script type="text/javascript">
    function approvenotification(rowId){

      var linkurl="change.php?approve="+rowId;
            swal({ 
              title: "Approve Booking?",   
              text: "You have opted to approve this booking ",   
              type: "info",   
              showCancelButton: true },   
              function() {
              // Redirect the user
              window.location.href = linkurl;   
            });
    }
    </script>

    <script type="text/javascript">
    function disapprovenotification(rowId){

      var linkurl="change.php?disapprove="+rowId;
            swal({ 
              title: "Reject Booking?",   
              text: "You have opted to reject this booking",   
              type: "warning",   
              showCancelButton: true },   
              function() {
              // Redirect the user
              window.location.href = linkurl;   
            });
    }
    </script>

    <script type="text/javascript">
    function bookingdelete(rowId){ 
      var linkurl="delete.php?delete="+rowId;
      swal({   title: "Are you sure?",   text: "Delete this booking?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){   swal("Deleted!", "Your booking has been deleted.", "success"); window.location.href=linkurl;});
    }
    </script>

    <style type="text/css">
      .circular {
      width: 30px;
      height: 30px;
      border-radius: 30px;
      -webkit-border-radius: 30px;
      -moz-border-radius: 70px;
      box-shadow: 0 0 20px rgba(30,144,255, .9);
      -webkit-box-shadow: 0 0 20px rgba(30,144,255, .9);
      -moz-box-shadow: 0 0 20px rgba(30,144,255, .9);
    }
      #tabs{
        font-size: 12px;
      }
    </style>
  
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
  <script type="text/javascript" language="javascript" src="js/jquery.js"></script> 
  <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
  <script src="js/jquery-ui.js"></script>

  <script type="text/javascript" language="javascript" >
      $(document).ready(function() {
          var dataTable = $('#pending').DataTable( {
            "columnDefs":[
                  {"width":"5%","targets": 0}
              ],
              "order":[[0,"desc"]],
              "processing": true,
              "serverSide": true,
              "ajax":{
                  url :"datapending.php", // json datasource
                  type: "post",  // method  , by default get
                  error: function(){  // error handling
                      $(".pending-error").html("");
                      $("#pending").append('<tbody class="sample-data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                      $("#pending_processing").css("display","none");
                      
                  }
              }
          } );
      } );
  </script>

  <script type="text/javascript" language="javascript" >
      $(document).ready(function() {
          var dataTable = $('#approve').DataTable( {
            "columnDefs":[
                  {"width":"15%","targets": 0}
              ],
              "order":[[0,"desc"]],
              "processing": true,
              "serverSide": true,
              "ajax":{
                  url :"dataapproved.php", // json datasource
                  type: "post",  // method  , by default get
                  error: function(){  // error handling
                      $(".approve-error").html("");
                      $("#approve").append('<tbody class="sample-data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                      $("#approve_processing").css("display","none");
                      
                  }
              }
          } );
      } );
  </script>

  <script type="text/javascript" language="javascript" >
      $(document).ready(function() {
          var dataTable = $('#disapprove').DataTable( {
            "columnDefs":[
                  {"width":"15%","targets": 0}
              ],
              "order":[[0,"desc"]],
              "processing": true,
              "serverSide": true,
              "ajax":{
                  url :"datadisapproved.php", // json datasource
                  type: "post",  // method  , by default get
                  error: function(){  // error handling
                      $(".disapprove-error").html("");
                      $("#disapprove").append('<tbody class="sample-data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                      $("#disapprove_processing").css("display","none");
                      
                  }
              }
          } );
      } );
  </script>

  </head>
  <body>

    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li><a href='http://intranet.nca.org.gh/' target="_blank"><img class="circular" src="NCA logo.jpg" alt="NCA logo.jpg"></a></li>
          <li class="menu-text">NCA Room Booking Platform</li>
          <li>
            <?php
            echo "Welcome <b style='color:#1E90FF'>".$sessfirstname."</b>";
            ?>
          </li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="bookinglist.php" class="button">Home</a></li>
          <li><a href="bookroomadmin.php" class="button">Room</a></li>
          <li><a href="report.php" class="button">Report</a></li>
          <li><a href="logout.php" class="button">Log Out</a></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->
    <br>
    <div class="row large-centered">
      <form action="change.php" method="POST" enctype="multipart/form-data">
        <ul class="tabs" data-tabs id="example-tabs">
          <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Pending</a></li>
          <li class="tabs-title"><a href="#panel2">Approve</a></li>
          <li class="tabs-title"><a href="#panel3">Deny</a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1" style="background-color:#00BFFF;">
            <table id="pending"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Booker</th>
                    <th>Event Name</th>
                    <th>Room</th>
                    <th>Intended Start Date</th>
                    <th>Intended End Date</th>
                    <th>Intended Start Time</th>
                    <th>Intended End Time</th>
                    <th>Items Needed</th>
                    <th>Approve</th>
                    <th>Deny</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Booking ID</th>
                    <th>Booker</th>
                    <th>Event Name</th>
                    <th>Room</th>
                    <th>Intended Start Date</th>
                    <th>Intended End Date</th>
                    <th>Intended Start Time</th>
                    <th>Intended End Time</th>
                    <th>Items Needed</th>
                    <th>Approve</th>
                    <th>Deny</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
          </table>
          </div>
          <div class="tabs-panel" id="panel2" style="background-color:#90EE90;">
            <table id="approve"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                  <tr>
                      <th>Booking ID</th>
                      <th>Booker</th>
                      <th>Event Name</th>
                      <th>Room</th>
                      <th>Intended Start Date</th>
                      <th>Intended End Date</th>
                      <th>Intended Start Time</th>
                      <th>Intended End Time</th>
                      <th>Items Needed</th>
                      <th>Deny</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>Booking ID</th>
                      <th>Booker</th>
                      <th>Event Name</th>
                      <th>Room</th>
                      <th>Intended Start Date</th>
                      <th>Intended End Date</th>
                      <th>Intended Start Time</th>
                      <th>Intended End Time</th>
                      <th>Items Needed</th>
                      <th>Deny</th>
                      <th>Delete</th>
                  </tr>
              </tfoot>
            </table>
          </div>
          <div class="tabs-panel" id="panel3" style="background-color:#F08080;">
            <table id="disapprove"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
              <thead>
                  <tr>
                      <th>Booking ID</th>
                      <th>Booker</th>
                      <th>Event Name</th>
                      <th>Room</th>
                      <th>Intended Start Date</th>
                      <th>Intended End Date</th>
                      <th>Intended Start Time</th>
                      <th>Intended End Time</th>
                      <th>Items Needed</th>
                      <th>Approve</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>Booking ID</th>
                      <th>Booker</th>
                      <th>Event Name</th>
                      <th>Room</th>
                      <th>Intended Start Date</th>
                      <th>Intended End Date</th>
                      <th>Intended Start Time</th>
                      <th>Intended End Time</th>
                      <th>Items Needed</th>
                      <th>Approve</th>
                      <th>Delete</th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
        </div>
      </form>
      </div>

      <hr>

    <div class="row column">
      <ul class="vertical medium-horizontal menu expanded text-center">

        <li><a href="#"><div class="stat">
        <?php
        include_once("bookingsclass.php");
        $bookings= new bookingsclass();
        $reserves = $bookings-> getBookings();
        $bookingNumber[]="";

        $row=$bookings->fetch();
        $i=0; 

        if (!$row) {
          $bookingNumber=0;
        } else {
          while($row){
            $reservations[$i]=$row['BOOKING_ID'];
            $i++;
            $row=$bookings->fetch();
          }
          $bookingNumber=count($reservations);
        }
        echo $bookingNumber;
        ?></div><span>Total Bookings</span></a></li>
        <li><a href="#"><div class="stat">
        <?php
        include_once("bookingsclass.php");
        $book= new bookingsclass();
        $bookings = $book-> getRooms();

        $row=$book->fetch();
        $i=0; 

        while($row){
          $books[$i]=$row['ROOM_NAME'];
          $i++;
          $row=$book->fetch();
        }
        $roomNumber=count($books);
        echo $roomNumber;
        ?>
        </div><span>Total Number of Rooms</span></a></li>
        <li><a href="#"><div class="stat">
        <?php
        include_once("bookingsclass.php");
        $pendbookings= new bookingsclass();
        $pendingreserves = $pendbookings-> getBookings('PENDING');
        $pendreservations[]="";

        $row=$pendbookings->fetch();
        $i=0; 
        if (!$row) {
          $pendbookingNumber=0;
        } else {
          while($row){
            $pendreservations[$i]=$row['BOOKING_ID'];
            $i++;
            $row=$pendbookings->fetch();
          }
          $pendbookingNumber=count($pendreservations);
        } 
        echo $pendbookingNumber;
        ?></div><span>Pending Requests</span></a></li>
      </ul>

    </div>
       
    <hr>

    <div class="row column">
      <ul class="menu">
        <li><a href="intranet.nca.org.gh" target="_blank">Intranet Portal Home</a></li>
      </ul>
    </div>
    
    </div>

    <script src="js/foundation.min.js"></script>
    <script src="js/foundation-datepicker.js"></script>
    <script>
      $(document).foundation();
    </script>
    

  </body>
<html>
