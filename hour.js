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
