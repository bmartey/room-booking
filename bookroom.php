<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Booking</title>
    <link rel="shortcut icon" type="image/png" href="NCA.png"/>

    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="css/foundation-datepicker.css">
    <link rel="stylesheet" href="foundation/fonts/foundation-icons.css">
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <script src="dist/sweetalert.min.js"></script>

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
  </style>

  </head>
  <body>

    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li><a href='http://intranet.nca.org.gh/' target="_blank"><img class="circular" src="NCA logo.jpg" alt="NCA logo.jpg"></a></li>
          <li class="menu-text">NCA Room Booking Platform</li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="index.php" class="button">Home</a></li>
          <li><a href="bookroom.php" class="button">Book Room</a></li>
          <li><a href="admin.php" class="button">Admin Access</a></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->

    <br>
    <div class="row large-centered">
      
      <div class=" panel callout secondary medium">
        <form  id="formId" action="sendInfo.php" method="POST" enctype="multipart/form-data">
          <div class="row column center">
              <h3>Book You Room Below:</h3>
              <div class="columns medium-6">
                <label>Name</label>
                <input id="personname" type="text" name="personname" required placeholder="eg. Brian Martey..">
                <label>Email</label>
                <input id="email" type="email" name="email" required placeholder="eg. maxwell@nca.org.gh..">
                <label>Floor:</label>
                <select id="floor" name="floor" required onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
                <?php
                    include_once("bookingsclass.php");
                    $floor= new bookingsclass();
                    $floors = $floor-> getFloors();

                    $row=$floor->fetch();
                    $i=0;

                    echo"<option value=''>Select Floor</option>";
                    while($row){
                      echo"<option value='{$row['NAME']}''>{$row['NAME']}</option>";
                      $i++;
                      $row=$floor->fetch();
                    }
                    ?>
                </select>
                <label>Room:</label>
                <script type="text/javascript" language="JavaScript">
                document.write('<select name="room" required id="room"><option value="">Select Floor first</option></select>')
                </script>
                <noscript>
                <select id="room1" name="status">
                    <option value="open">Select Room</option>
                </select>
                </noscript>
                <?php
                  $caldate="";
                  $reststr="";
                  if (isset($_REQUEST['calendarDate'])) {
                    $variable="T";
                    $tcheck=$_REQUEST['calendarDate'];
                    $pos = strpos($tcheck, $variable);
                    if ($pos !== false) {
                      $substr=substr($tcheck,0,$pos);
                      $reststr=substr($tcheck,$pos+1);
                      $caldate=$substr;
                      $caltime=$reststr;
                    } else {
                      $caldate=$_REQUEST['calendarDate'];
                      $caltime="";
                    }
                  } else {
                    $caldate="";
                    $caltime="";
                  }
                ?>
                <input id="morethan1day" type="checkbox" onchange="valueShow()"><label for="morethan1day">Select for Booking multiple continuous days</label>
                <div id="shows1" >
                  <label>Choose Date</label>
                  <input type="text" class="span2" id="dp1" name="date" value="<?php echo $caldate ?>" placeholder="Choose Date">
                </div>
                <div id="shows2" style="display:none;"> 
                <div class="row">
                  <div class="columns medium-6">
                    <label>Start Date</label>
                    <input type="text" class="span2" id="dpd1" name="startdate" placeholder="Start Date">
                  </div>
                  <div class="columns medium-6">
                    <label>End Date</label>
                    <input type="text" class="span2" id="dpd2" name="enddate" placeholder="End Date">
                  </div>
                </div>
                </div>
              </div>
              <div class="columns medium-6">
                <label>Event Name</label>
                <input id="name" type="text" name="name" required placeholder="eg. IT meeting..">
                <label>Description</label>
                <textarea id="description" name="description" style="height:173px;" required placeholder="Description for the event.."></textarea>
                <div class="row">
                  <label>Items Needed</label>
                  <?php
                    include_once("itemsclass.php");
                    $thing= new itemsclass();
                    $things = $thing-> getItems();

                    $thinglist=$thing->fetch();
                    $i=0;
                    while($thinglist){
                      echo"<input id='item' name='items[]' value='{$thinglist['NAME']}' type='checkbox'><label for='checkbox1'>{$thinglist['NAME']}</label>";
                      $i++;
                      $thinglist=$thing->fetch();
                    }
                    ?>
                </div>
                <div class="row">
                  <div class="columns medium-6">
                    <label>Start Time</label>
                    <input type="text" class="span2" id="d1" required name="starttime" value="<?php echo $reststr?>" placeholder="Start Time">
                  </div>
                  <div class="columns medium-6">
                    <label>End Time</label>
                    <input type="text" class="span2" id="d2" required name="endtime" placeholder="End Time">
                  </div>
                </div>
              </div>
            
          </div>
          <input id="submit" type="submit" class="button expanded" name="submit" value="Submit">
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

    <script>
    /*$('#submit').on('click', function(e){
      e.preventDefault();
      var form = $(this).parents('form');
      swal({ 
          title: "Send for Approval?",
          text: "Please Fill all required fields to continue",  
          type: "info",   
          showCancelButton: true,
          showConfirmButton: true,
          closeOnConfirm: false,
          allowOutsideClick: true },
          function(isConfirm) {
            if(e.isDefaultPrevented){
              swal({
                title: "Sending",
                type: "success",
                timer:1000,
                showConfirmButton: false 
              });
              };
            });   
            
        });*/
    </script>

    <script type="text/javascript">
    function sendbooking(){
      var submit="submit";
      var name=document.getElementById("name").value;
      var floor=document.getElementById("floor").value;
      var description=document.getElementById("description").value;
      var room=document.getElementById("room").value;
      var date=document.getElementById("dp1").value;
      var startdate=document.getElementById("dpd1").value;
      var email=document.getElementById("email").value;
      var enddate=document.getElementById("dpd2").value;
      var starttime=document.getElementById("d1").value;
      var endtime=document.getElementById("d2").value;
      var personname=document.getElementById("personname").value;
      var items=document.getElementById("item").value;

      var linkurl="sendInfo.php?submit="+submit+"&name="+name+"&floor="+floor+"&description="+description+"&room="+room+"&date="+date+"&email="+email+"&startdate="+startdate+"&enddate="+enddate+"&starttime="+starttime+"&endtime="+endtime+"&personname="+personname+"&items="+items;
      var form=$("#formId");
        swal({ 
          title: "Send for Approval?",
          text: "Please Fill all required fields to continue",  
          type: "info",   
          showCancelButton: true,
          showConfirmButton: true,
          closeOnConfirm: false,   
          closeOnCancel: false },   
          function(isConfirm) {
            if(isConfirm){
              // Redirect the user
              window.location.href = linkurl;
            }else{
              swal("Cancelled", "Your booking was not sent", "error");
            }   
        });
    }
    </script>

    <script src="js/foundation-datepicker.js"></script>

    <script>
      $(document).foundation();
    </script>

    <script>
    $(function(){
      $('#dp1').fdatepicker({
        format: 'yyyy-mm-dd',
        disableDblClickSelection: true,
        language: 'en',
        pickTime: false,
        onRender: function (date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
        } 
      });
    });
    </script>

    <script type="text/javascript">
    // implementation of disabled form fields
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('#dpd1').fdatepicker({
      format: 'yyyy-mm-dd',
      onRender: function (date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function (ev) {
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.update(newDate);
      }
      checkin.hide();
      $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').fdatepicker({
      format: 'yyyy-mm-dd',
      onRender: function (date) {
        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function (ev) {
      checkout.hide();
    }).data('datepicker');
    </script>

    <script>
    $(function(){
      $('#d1').fdatepicker({
        format: 'hh:ii',
        disableDblClickSelection: true,
        language: 'en',
        pickTime: true,
        startView: 1,
        minView:0,
        maxView:1,
      });
    });

    $(function(){
      $('#d2').fdatepicker({
        format: 'hh:ii',
        disableDblClickSelection: true,
        disableDheader: true,
        language: 'en',
        pickTime: true,
        startView: 1,
        minView:0,
        maxView:1,
      });
    });
    </script>

<script type="text/javascript">
 $(function () {
     $('#shows2').removeClass('hidden');
 });
</script>

<script type="text/javascript">
function valueShow()
{
  if($('#morethan1day').is(":checked")){   
    $("#shows2").show();
    $("#shows1").hide();
    document.getElementById('dp1').value="";
    }
  else{
    $("#shows2").hide();
    $("#shows1").show();
    document.getElementById('dpd1').value="";
    document.getElementById('dpd2').value="";
    }
}
</script>

<?php

  include_once("bookingsclass.php");

  $book= new bookingsclass();
  $floorid= new bookingsclass();

    //get floor ids and rooms with those ids
    $floors = $floorid->getFloors();
  $floorrow = $floorid->fetch();
  $j=0;

  $cases="<script language='javascript' type='text/javascript'>
    function dynamicdropdown(listindex)
    {
      switch (listindex)
      {";

  echo"";

  while($floorrow){
    $floorsnames[$j]=$floorrow['NAME'];
    $floorss[$j]=$floorrow['FLOOR_ID'];
    $cases.=" case '".$floorsnames[$j]."' : ";

    $bookings = $book-> getRooms($floorss[$j]);
    $roomrow=$book->fetch();
    $k=0; 

    $cases.= "document.getElementById('room').options[0]=new Option('Select Room','');";

    while($roomrow){
      $books[$k]=$roomrow['ROOM_NAME'];
      $l=$k+1;
      $cases.="document.getElementById('room').options[$l]=new Option('$books[$k]','$books[$k]');";
      $k++;
      $roomrow=$book->fetch();
    }
    $cases.="break;";

    $j++;
    $floorrow = $floorid->fetch();
  }

  $cases.="}
      return true;
    }
  </script>";

  echo $cases;
?>


  </body>
<html>
