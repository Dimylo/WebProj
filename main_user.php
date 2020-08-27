<!DOCTYPE html>
<?php include 'checkmainuser.php';?>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="jquery.datetimepicker.min.css">
<script src = "jquery.js"></script>
<script src = "jquery.datetimepicker.full.js"></script>
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
    <link rel="stylesheet" type="text/css" href="admin8.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"> </script>
    <script src="heat.js"></script>
  </head>

  <body>
    <button class="w3-btn" id="gather">HeatMap</button>
    <div id="mapid" style="width:640px; height:200px; align:"center";"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" ></script>
    <div class="logout" >
      <style>
.logout{


  text-align: right;
}
</style>
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



    <!-- <form action="uploadFile.php" method="post" enctype="multipart/form-data">
        <input type= "file" name="fileToUpload" class="uploads" id="fileToUpload">
        <input type= "submit" value="Upload file" class="upload"name="submit">

    </form> -->
    <form  id = "table_date"method="post">
      <input type = "datetime-local" class = "Date_date" id = "start" name = "start">
      <input type = "datetime-local" class = "Date_date2" id = "last" name ="last">
      <input type="submit" class = "Date_date1" name="search" id="search" value="search">
      <table class="table_close " id = "sum_activites">  </table>
      <table  class="table_hour " id = "sum_day">  </table>
      <table  class="table_day " id = "sum_hour">  </table>
    </form>

    <table>
      <tr>
        <th>username</th>
        <th>idiot
        </th>
      </tr>
      <tr>
        <td>scor</td>
        <td id = "data"></td>
      </tr>
      <tr>
        <td>record period</td>
        <td id = "eyros"></td>
      </tr>
      <tr>
        <td>the end record</td>
        <td id = "last_date"></td>
      </tr>

    </table>



    <script>
      //call ajax
      var ajax = new XMLHttpRequest();
      var method = "GET";
      var url = "select_scor.php";
      var asynchronous = true;

      ajax.open(method, url, asynchronous);
      //sending ajax request)
      ajax.send();
      ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);

          var html = "";
          var sum = 0;
          var ecological = 0;
          var non_ecological = 0;
          for (var i = 0; i < data.length; i++) {
            var type = data[i].act_type;
            //ektypwsh pinaka
            //html += "<tr>";
            //html += "<td>" + username + "<td>" + email+"<td>";
            //html += "<tr>"
            if (type == "STILL" || type == "TILTING" || type == "UNKNOWN") {
              sum = sum;
            }else if (type == "ON_FOOT" || type == "ON_BICYCLE") {
              ecological = ecological + 1;
              sum = sum +1;
            }else {
              non_ecological = non_ecological +1;
              sum = sum +1;
            }

          }
          ecological = (ecological/sum)*100;

          html += "<tr>";
          html += "<td>" +Math.round(ecological)+ "%";
          document.getElementById("data").innerHTML = html;
        }
      }
    </script>
    <script>
      //call ajax
      var ajax = new XMLHttpRequest();
      var method = "GET";
      var ur1 = "select_date.php";
      var asynchronous = true;

      ajax.open(method, ur1, asynchronous);
      //sending ajax request)
      ajax.send();
      ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);

          var html = "";

        //  for (var i = 0; i < data.length; i++) {
            var type = data[0].date_upload;


          //}
          html += "<tr>";
          html += "<td>"+ data[0].date_upload;
          document.getElementById("last_date").innerHTML = html;
        }
      }
    </script>
    <script>
      //call ajax
      var ajax = new XMLHttpRequest();
      var method = "GET";
      var ur1 = "select_first_date.php";
      var asynchronous = true;

      ajax.open(method, ur1, asynchronous);
      //sending ajax request)
      ajax.send();
      ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);

          var html = "";

          html += "<td>" +"(" +data[0].min +")-("+data[0].max+")";
          document.getElementById("eyros").innerHTML = html;
        }
      }
    </script>
    <script type="text/javascript">
    //call ajax


    $(document).ready(function() {

      $('#table_date').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
              url: 'date_s.php',
              data: $("#start, #last").serialize(),
              success: function(response)
              {
                var data = JSON.parse(response);

                var html = "";
                var sum = 0;
                for (var i = 0; i < data.length; i++) {
                  var num = parseInt(data[i].num);
                  var type = data[i].act_type;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN") {
                    sum = sum;
                  }else{
                    sum = sum + num;
                  }
                }
                html += "<tr>";
                html += "<td>" +"type" +"</td>";
                html += "<td>" +"per sent%"+"</td>";
                for (var i = 0; i < data.length; i++) {
                  var num = parseInt(data[i].num);
                  var type = data[i].act_type;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
                  }else {
                    num =num/sum*100;
                    html += "<tr>";
                    html += "<td>" +type  +"</td>";
                    html += "<td>" +Math.round(num) +"%"+"</td>";
                    html += "</tr>";
                  }
                }


                document.getElementById("sum_activites").innerHTML = html;
              }

        });


      });


    });


    </script>
    <script type="text/javascript">
    //call ajax


    $(document).ready(function() {

      $('#table_date').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
              url: 'firstday.php',
              data: $("#start, #last").serialize(),
              success: function(response)
              {
                var data = JSON.parse(response);

                var html = "";


                html += "<tr>";
                html += "<td>" +"day"+"</td>";
                for (var i = 0; i < data.length; i++) {
                  var num = data[i].topday;
                  var type = data[i].activity;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
                  }else {
                    html += "<tr>";

                    html += "<td>" +num +"</td>";
                    html += "</tr>";
                  }
                }


                document.getElementById("sum_day").innerHTML = html;
              }

        });


      });


    });


    </script>
    <script type="text/javascript">
    //call ajax


    $(document).ready(function() {

      $('#table_date').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
              url: 'hour_date.php',
              data: $("#start, #last").serialize(),
              success: function(response)
              {
                var jsonData = JSON.parse(response);
                var html = "";
                html += "<tr>";
                html += "<td>" +"hour"+"</td>";
                for (var i = 0; i < jsonData.length; i++) {
                  var num = jsonData[i].topday;
                  var type = jsonData[i].activity;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
                  }else {
                    html += "<tr>";
                    html += "<td>" +num +"</td>";
                    html += "</tr>";
                  }
                }
                document.getElementById("sum_hour").innerHTML = html
              }

        });


      });


    });


    </script>

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="hour.js"></script>
<script src="coords11.js"></script>
  </body>
</html>
?>
