google.charts.load("visualization", "1", { packages: ["corechart",'bar','line'] });
var weekday = new Array(7);
weekday[0] = "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";
$(document).ready(function() {
  $('#search').click(function(e) {
    e.preventDefault();
    var date1 = new Date(document.getElementById("start").value);
    var st = date1.getTime()*1e-3;
    var date2 = new Date(document.getElementById("last").value);
    var la = date2.getTime()*1e-3;


    if(!st=='' && !la==''){
        $.ajax({
              type: "POST",
              url: 'date_s11.php',
              data: {'start1':st,'last1':la},
              success: function(response)
              {
                var data = JSON.parse(response);
                console.log(data);
                var MyArray=[];
                var DataArray=[];
                var html = "";
                var sum = 0;
                for (var i = 0; i < data.length; i++) {
                  var num = parseInt(data[i].num);
                  var type = data[i].act_type;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN" || type=="EXITING_VEHICLE") {
                    sum = sum;
                  }else{
                    sum = sum + num;
                  }
                }
                html += "<tr>";
                html += "<td>" +"ACTIVITY" +"</td>";
                html += "<td>" +"PERCENT"+"</td>";
                for (let i = 0; i < data.length; i++) {
                  var num = parseInt(data[i].num);
                  var type = data[i].act_type;
                  if (type == "STILL" || type == "TILTING" || type == "UNKNOWN" || type == "EXITING_VEHICLE"){

                  }else {
                    num =num/sum*100;
                    html += "<tr>";
                    html += "<td>" +type  +"</td>";
                    html += "<td>" +Math.round(num) +"%"+"</td>";
                    html += "</tr>";
                    MyArray.push(type, num);
                  }
                }
                console.log(MyArray)

                document.getElementById("sum_activites").innerHTML = html;

                google.charts.setOnLoadCallback(DrawPieChart);

                function DrawPieChart() {
                    // DEFINE AN ARRAY OF DATA.
                    var arrSales = new google.visualization.DataTable();
                    arrSales.addColumn('string', 'Activity');
                    arrSales.addColumn('number', 'Times');

                    for (let i=0;i<MyArray.length-1;i+=2){
                      arrSales.addRows([
                        [MyArray[i],MyArray[i+1]]
                      ]);
                    }

                    // SET CHART OPTIONS.
                    var options = {
                        title: 'Activity Type',
                        is3D: true,
                        pieSliceText: 'value-and-percentage',
                        width:400,
                        height:300
                    };


                    // WHERE TO SHOW THE CHART (DIV ELEMENT).
                    var chart = new google.visualization.PieChart(document.getElementById('chart'));

                    // DRAW THE CHART.
                    chart.draw(arrSales, options);

                }

              }
        });

//Ημέρα της εβδομάδας με τις περισσότερες εγγραφές ανά είδος δραστριότητας

      $.ajax({
            type: "POST",
            url: 'firstday11.php',
            data: {'start1':st,'last1':la},
            success: function(response)
            {
              console.log(st,la)

              var data = JSON.parse(response);
              console.log(data)
              var day="";
              var type="";
              var html = "";
              html += "<tr>";
              html += "<td>" +"DAY"+"</td>";
              for (let i = 0; i < data.length; i++) {

                type = data[i].activity;
                if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"|| type== "EXITING_VEHICLE"){
                }else{

                  day=data[i].topday;
                  html += "<tr>";
                  html += "<td>" +day +"</td>";
                  html += "</tr>";
                }
              }
              document.getElementById("sum_day").innerHTML = html;
        }
      });

  // $('#search').click(function(e) {
  //   e.preventDefault();
  //   var st=$("#start").val();
  //   var la=$("#last").val();
  //   if(!st=='' && !la==''){
  //     $.ajax({
  //           type: "POST",
  //           url: 'daychart.php',
  //           data: {'start1':st,'last1':la},
  //           success: function(response)
  //           {
  //             var data = JSON.parse(response);
  //             console.log(data)
  //
  //               }
  //
  //         //
  //         //     google.charts.setOnLoadCallback(drawChart);
  //         //     function drawChart() {
  //         //
  //         //     var data = new google.visualization.DataTable();
  //         //     data.addColumn('date', 'Time of Day');
  //         //     data.addColumn('number', 'Number of Activities');
  //         //
  //         //     for (let i=0;i<day.length-1;i+=2){
  //         //       data.addRows([
  //         //         [(new Date(day[i])), day[i+1]-1 ]
  //         //       ]);
  //         //     }
  //         //
  //         //     var options = {
  //         //       title: 'Sum of Activities',
  //         //       width: 900,
  //         //       height: 500,
  //         //       hAxis: {
  //         //         format: 'd/M/yy',
  //         //         gridlines: {count: 15}
  //         //       },
  //         //       vAxis: {
  //         //         gridlines: {color: 'none'},
  //         //         minValue: 0,
  //         //         maxValue: 1500
  //         //       }
  //         //     };
  //         //
  //         //     var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  //         //
  //         //     chart.draw(data, options);
  //         // }
  //
  //     });
  //  }
  // });
//'Ωρα της ημέρας με τις περισσότερες εγγραφές ανά είδος δραστριότητας

    $.ajax({
          type: "POST",
          url: 'hour_date1.php',
          data: {'start1':st,'last1':la},
          success: function(response)
          {
            var hour="";
            var data = JSON.parse(response);
            console.log(data)
            var html = "";
            html += "<tr>";
            html += "<td>" +"HOUR(24)"+"</td>";
            let type="";
            for (var i = 0; i < data.length; i++) {

              type=data[i].activity;

              if (type == "STILL" || type == "TILTING" || type == "UNKNOWN" || type=="EXITING_VEHICLE"){
              }else {

                hour = data[i].tophour;
                html += "<tr>";
                html += "<td>" +hour +"</td>";
                html += "</tr>";

              }
            }
            document.getElementById("sum_hour").innerHTML = html;
          }
      });
    }
  });

});
