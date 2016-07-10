<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Platform </title>
    <link rel="shortcut icon" type="image/png" href="NCA.png"/>

    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="css/foundation-datepicker.css">
    <link rel="stylesheet" href="foundation/fonts/foundation-icons.css"> 

    <link href="css/font-awesome-1.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/foundation-icons.css" rel="stylesheet">

    <meta charset='utf-8' />
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />

    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">



    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>

    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>

    <script type="text/javascript">
    $('#calendar').fullCalendar({
      schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
    });
    </script>

    <script type="text/javascript">
    var moment = $('#calendar').fullCalendar('getDate');
    var calDate = moment.format('YYYY-MM-DD');
    </script>

    <script src="dist/sweetalert.min.js"></script>

     <script>
      $(document).ready(function() { 

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          }, 
          defaultDate: calDate,
          nowIndicator:true,
          businessHours: true, // display business hours
          editable: false,
          selectable: true,
          selectHelper: true,
          dayClick: function(date, jsEvent, view) {
            var dateinfo= date.format();
            var linkurl="bookroom.php?calendarDate="+dateinfo;
            swal({ 
              title: "Choose this date?", 
              text: "You have selected "+dateinfo,   
              type: "success",   
              showCancelButton: true },   
              function() {
              // Redirect the user
              window.location.href = linkurl;   
            });
          },
          eventLimit: true,
          events: {
            url: 'retrieveBookings.php',
            dataType: 'json'
          },
          eventClick: function(event, jsEvent, view) { //for mouse click option
            var eventtitle=event.title;
            swal({   
              title: "Event Details",   
              text: "Event: "+eventtitle,  
              type: "info",   
              showConfirmButton: false,
              allowEscapeKey: true,  
              allowOutsideClick: true  });
          },

          /*eventMouseover: function(event, jsEvent, view ) {
            var eventtitle=event.title;
            swal({   
              title: "Event Details",   
              text: "Event: "+eventtitle,  
              type: "info",   
              showConfirmButton: false,
              allowEscapeKey: true,  
              allowOutsideClick: true  });
          },
          eventMouseout: function( event, jsEvent, view ) {
          }*/
          
        });
        
      });

    </script>

<style>
  #calendar {
    max-width: 100%;
    margin: 0 auto;
  }

</style>

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

    <div class="callout primary small">
      <div class="row column text-center">
        <h1>Meeting Room Booking Platform</h1>
        <p class="lead">National Communication Authority Room Booking Platform. For speedy and convenient use.</p>
      </div>
    </div>
    <div class="callout primary medium">
      <div class="row" style="width:70%;">
        <div>
          <div id='calendar'></div>
        </div>
      </div>
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
  
    
    <script src="js/foundation.min.js"></script>
    <script src="js/foundation-datepicker.js"></script>
    <script>
      $(document).foundation();
    </script>

  </body>
</html>


    