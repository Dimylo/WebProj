<!DOCTYPE html>
<?php include 'checkmainuser1.php';?>
<html lang="en" dir="ltr">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<head>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>



    <meta charset="utf-8">
    <title>WEBDEV CREATIONS</title>
    <link rel="stylesheet" type="text/css" href="admin4.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"> </script>
    <script src="heat.js"></script>
  </head>

  <body>

<!-- <input type="hidden" id="hdnSession" value="@Request.RequestContext.HttpContext.Session['id']" />    <button class="w3-btn" id="gather">HeatMap</button> -->

    <div class="logout" >
        <a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
        <a href="mainP.html" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Upload File
        </a>
    </div>



    <div class="title">
      <h1>
        welcome @<?php print_r($_SESSION['username']); ?>

      </h1>
    </div>


    <form  id = "table_date" method="post">

      <input type = "month" class = "Date_date" id = "start" name = "start">
      <input type = "month" class = "Date_date2" id = "last" name ="last">

      <input type="submit" class = "Date_date1" name="search" id="search" value="search">

      <table class="table_close " id = "sum_activites"></table>
      <table  class="table_hour " id = "sum_day"></table>
      <table  class="table_day " id = "sum_hour"></table>
    </form>
<div class="container">
  <hr>
    <table class="tab1">
      <tr>
        <th>@<?php print_r($_SESSION['username']); ?></th>
        <th>Stats
        </th>
      </tr>
      <tr>
        <td>Last Month </td>
        <td id = "lastMonth"></td>
      </tr>
      <tr>
        <td>Record Period</td>
        <td id = "eyros"></td>
      </tr>
      <tr>
        <td>Last Upload on :</td>
        <td id = "last_date"></td>
      </tr>
      <tr>
        <td>Leaderboard</td>
        <td id = "top_3" type="date"></td>
      </tr>
      <tr>
        <td>Total scor</td>
        <td  type="number" id = "scor" ></td>
      </tr>

    </table>
</div>





  <div class="chart_box">
    <div  id="ychart" style="width:600px; height:200px;" ></div>
  </div>



<div class="container">
    <div class="map" id="mapid"  ></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
</div>
<div class="chart_box1">
<div id="chart" style="width:600px; height:200px;"></div>
</div>
<!-- <div id="linechart_material_vehicle" style="width:600px; height:200px;"></div>
<div id="linechart_material_bike" style="width:600px; height:200px;"></div>
<div id="linechart_material_foot" style="width:600px; height:200px;"></div> -->

<!-- <td><div id="barchart_div" style="border: 1px solid #ccc"></div></td> -->
<div id="chart_div" style="width: 900px; height: 500px;"></div>


        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <canvas id="pie-chart"></canvas> -->

<script src="mostResults111.js"></script>
<script src="period1111.js"></script>
<script src="date_upload1.js"></script>
<script src="scor33333.js"></script>
<script src="coords3333.js"></script>
  </body>
</html>
