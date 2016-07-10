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
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/vendor/foundation.min.js"></script>
    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>
    <script src="js/jquery-1.10.2.js"></script>
    
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
          var dataTable = $('#report').DataTable( {
            "columnDefs":[
                  {"width":"75%","targets": 0}
              ],
              "order":[[0,"desc"]],
              "processing": true,
              "serverSide": true,
              "ajax":{
                  url :"reporttable.php", // json datasource
                  type: "post",  // method  , by default get
                  error: function(){  // error handling
                      $(".report-error").html("");
                      $("#report").append('<tbody class="sample-data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                      $("#report_processing").css("display","none");
                      
                  }
              }
          } );
      } );
  </script>

<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>   

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
    	<div class=" panel callout secondary medium">
        <form id="searchform" action="" method="POST" enctype="multipart/form-data">
<?php
$string="";
if(isset($_REQUEST['search'])){
  $string="clicked";
}
?>
          <div class="row column center">
              <div class="columns medium-6">
                <label>Search Start</label>
                <input id="datestart" type="date" name="datestart" required>
              </div>
              <div class="columns medium-6">
                <label>Search End</label>
                <input id="dateend" type="date" name="dateend" required>
              </div>
              <div class="columns medium-12">
                <a href="#" type="submit" id="search" class="button expanded" name="search" onclick="valueShow()">Search</a>
              </div>
              <?php echo $string;?>
              <hr>
          </div>
        </form>

<form id="dataform" action="" method="POST" enctype="multipart/form-data" style="display:none;">
  <ul class="tabs" data-tabs id="example-tabs">
    <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Graphical</a></li>
    <li class="tabs-title"><a href="#panel2">Timeline</a></li>
    <li class="tabs-title"><a href="#panel3">Table</a></li>
  </ul>
  <div class="tabs-content" data-tabs-content="example-tabs">
    <div class="tabs-panel is-active" id="panel1">
      <div id="container" style="min-width: 85%; height: 400px; max-width: 120%; margin: 0 auto"></div>
    </div>
    <div class="tabs-panel" id="panel2">
      <div class="text-center" style="border: 1px solid #ccc;height:500px;width:400px;" id="chart_div"></div>
    </div>
    <div class="tabs-panel" id="panel3">
      <table id="report"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
      <thead>
          <tr>
              <th>Room</th>
              <th>Event Name</th>
              <th>Booker</th>
              <th>Floor</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>Room</th>
              <th>Event Name</th>
              <th>Booker</th>
              <th>Floor</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
          </tr>
      </tfoot>
    </table>
    </div>
  </div>
</form>

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
<script type="text/javascript" src="charts/loader.js"></script>

<script>
  $(document).foundation();
</script>

<?php 

echo"
<script type='text/javascript'>
function valueShow()
{  
  $('#dataform').show();

  $(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Bookings for the Period'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Bookings',
                colorByPoint: true,
                data: [
                  ";

    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="APPROVED";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "{ name: '".$status."', y:".$approved."},";

    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="DISAPPROVED";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "{ name: '".$status."', y:".$approved."},";

    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="PENDING";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "{ name: '".$status."', y:".$approved."},";


                    echo"]
            }]
        });
    });
});
}
</script>";
?>

<?php
    echo"<script type='text/javascript'>

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Bookings');
        data.addRows([";
    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="APPROVED";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "['".$status."',".$approved."],";

    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="DISAPPROVED";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "['".$status."',".$approved."],";

    include_once("bookingsclass.php");
    $get= new bookingsclass();
    $status="PENDING";
    $getbooks= $get-> getBookings($status);
    $getrow=$get->fetch();
    $r=0;

    while($getrow){;
      $allstatus[$r]=$getrow['BOOKER'];
      $r++;
      $getrow=$get->fetch();
    } 
    $approved=$r;
 
    echo "['".$status."',".$approved."],";

          echo"
        ]);

        // Set chart options
        var options = {
                      'legend':'bottom',
                      'title':'Usage Statistics',
                      'pieHole': 0.2,
                       'width':800,
                       //'is3D':true,
                       'height':500,
                      'pieSliceText': 'label',
                    };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>";
    ?>

<?php /*

echo "
    <script type='text/javascript'>
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Bookings for the Period'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Bookings',
                colorByPoint: true,
                data: [{
                    name: 'Pending',
                    y: 1
                }, { name: 'Approved',
                     y: 1
                }, { name: 'Disapproved',
                    y: 1
                }]
            }]
        });
    });
});
    </script>";*/
?>

  </body>
<html>
