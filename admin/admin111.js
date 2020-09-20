google.charts.load("visualization", "1", { packages: ["corechart",'bar','line','corechart'] });
$(document).ready(function() {
 $("#p1").click(function(e){
   $('.table_close1').css('display','none');
   $('.table_close5').css('display','none');
   $('.table_close3').css('display','none');
   $('.table_close4').css('display','none');
   $('.table_close2').css('display','none');
   $('.table_close').css('display','block');
//   $("#sum_activites").show();

  $.ajax({
    url: 'ascore1.php',
    type: 'GET',
    data: 'twitterUsername=jquery4u',
    success: function(response) {
         var data = JSON.parse(response);
         var myArray=[];
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
                myArray.push(type, num);
              }
            }


            document.getElementById("sum_activites").innerHTML = html;
            google.charts.setOnLoadCallback(DrawPieChart);

            function DrawPieChart() {
                // DEFINE AN ARRAY OF DATA.
                var arrSales = new google.visualization.DataTable();
                arrSales.addColumn('string', 'Activity');
                arrSales.addColumn('number', 'Times');

                for (let i=0;i<myArray.length-1;i+=2){
                  arrSales.addRows([
                    [myArray[i],myArray[i+1]]
                  ]);
                }

                // SET CHART OPTIONS.
                var options = {
                    title: 'Activity Type',
                    is3D: true,
                    pieSliceText: 'value-and-percentage',

                };


                // WHERE TO SHOW THE CHART (DIV ELEMENT).
                var chart = new google.visualization.PieChart(document.getElementById('chart'));

                // DRAW THE CHART.
                chart.draw(arrSales, options);
              }
     },
     error: function(e) {
        //called when there is an error
         //console.log(e.message);
       }

     });

  });
  $("#p2").click(function(e){
    $('.table_close4').css('display','none');
    $('.table_close5').css('display','none');
    $('.table_close').css('display','none');
    $('.table_close2').css('display','none');
    $('.table_close3').css('display','none');
    $('.table_close1').css('display','block');
  //  $("sum_day").show();
  $.ajax({
    url: 'afday.php',
    type: 'GET',
    data: 'twitterUsername=jquery4u',
    success: function(response) {
      var data = JSON.parse(response);
      console.log(response)
      var myArray=[];
      var html = "";
      sum = 0;

      for (let i = 0; i < data.length; i++) {
        var nu = parseInt(data[i].num);
        sum = sum + nu;
      }

      html += "<tr>";
      for (let i = 0; i < data.length; i++) {
        var num = parseInt(data[i].num);
        var day = data[i].topday;

          html += "<tr>";

          html += "<td>" +day +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
          html += "</tr>";
          myArray.push(day, num);

      }

      document.getElementById("sum_day").innerHTML = html;
      google.charts.setOnLoadCallback(DrawPieChart);

      function DrawPieChart() {
          // DEFINE AN ARRAY OF DATA.
          var arrSales = new google.visualization.DataTable();
          arrSales.addColumn('string', 'DAY');
          arrSales.addColumn('number', 'ACTIVITY');

          for (let i=0;i<myArray.length-1;i+=2){
            arrSales.addRows([
              [myArray[i],myArray[i+1]]
            ]);
          }

          // SET CHART OPTIONS.
          var options = {
              title: 'Registrations Per Day',
              is3D: true,
              pieSliceText: 'value-and-percentage',

          };


          // WHERE TO SHOW THE CHART (DIV ELEMENT).
          var chart = new google.visualization.BarChart(document.getElementById('chart'));

          // DRAW THE CHART.
          chart.draw(arrSales, options);
        }
     },
     error: function(e) {

       }
     });

  });
  $("#p6").click(function(e){
    $('.table_close4').css('display','none');
    $('.table_close').css('display','none');
    $('.table_close2').css('display','none');
    $('.table_close3').css('display','none');
    $('.table_close1').css('display','none');
    $('.table_close5').css('display','block');
  //  $("sum_day").show();
  $.ajax({
    url: 'log.php',
    type: 'GET',
    data: 'twitterUsername=jquery4u',
    success: function(response) {
      var data = JSON.parse(response);
      console.log(data)
      sum = 0;
      var myArray=[];
      var html = "";
      for (var i = 0; i < data.length; i++) {
        var user = data[i].username;
        var num = parseInt(data[i].num);
          html += "<tr>";
          html += "<td>" +user +"  "+num +"</td>";
          html += "</tr>";
          myArray.push(user,num);
      }


      document.getElementById("login").innerHTML = html;
      google.charts.setOnLoadCallback(DrawPieChart);

      function DrawPieChart() {
          // DEFINE AN ARRAY OF DATA.
          var arrSales = new google.visualization.DataTable();
          arrSales.addColumn('string', 'USER');
          arrSales.addColumn('number', 'ACTIVITY');

          for (let i=0;i<myArray.length-1;i+=2){
            arrSales.addRows([
              [myArray[i],myArray[i+1]]
            ]);
          }

          // SET CHART OPTIONS.
          var options = {
              title: 'Registrations Per User',
              is3D: true,
              pieSliceText: 'value-and-percentage',

          };


          // WHERE TO SHOW THE CHART (DIV ELEMENT).
          var chart = new google.visualization.BarChart(document.getElementById('chart'));

          // DRAW THE CHART.
          chart.draw(arrSales, options);
        }
     },
     error: function(e) {

       }
     });

  });
  $("#p3").click(function(e){
    $('.table_close4').css('display','none');
    $('.table_close5').css('display','none');
    $('.table_close').css('display','none');
    $('.table_close1').css('display','none');
    $('.table_close3').css('display','none');
    $('.table_close2').css('display','block');
  //  $("sum_day").show();
  $.ajax({
    url: 'month.php',
    type: 'GET',
    data: 'twitterUsername=jquery4u',
    success: function(response) {
      var data = JSON.parse(response);
      sum = 0;
      var myArray=[];
      var html = "";
      for (let i = 0; i < data.length; i++) {
        var nu = parseInt(data[i].num);
        sum = sum + nu;
      }


      html += "<tr>";
      for (let i = 0; i < data.length; i++) {
        var month = data[i].topday;
        var num = parseInt(data[i].num);

          html += "<tr>";

          html += "<td>" +month +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
          html += "</tr>";
          myArray.push(month, num);

      }
      console.log(myArray)

      document.getElementById("sum_month").innerHTML = html;
      google.charts.setOnLoadCallback(DrawPieChart);

      function DrawPieChart() {
          // DEFINE AN ARRAY OF DATA.
          var arrSales = new google.visualization.DataTable();
          arrSales.addColumn('string', 'MONTH');
          arrSales.addColumn('number', 'ACTIVITY');

          for (let i=0;i<myArray.length-1;i+=2){
            arrSales.addRows([
              [myArray[i],myArray[i+1]]
            ]);
          }

          // SET CHART OPTIONS.
          var options = {
              title: 'Registrations Per Month',
              is3D: true,
              pieSliceText: 'value-and-percentage',

          };


          // WHERE TO SHOW THE CHART (DIV ELEMENT).
          var chart = new google.visualization.BarChart(document.getElementById('chart'));

          // DRAW THE CHART.
          chart.draw(arrSales, options);
        }
     },
     error: function(e) {
        //called when there is an error
         //console.log(e.message);
       }
     });

  });
  $("#p4").click(function(e){
    $('.table_close4').css('display','none');
    $('.table_close5').css('display','none');
    $('.table_close1').css('display','none');
    $('.table_close2').css('display','none');
    $('.table_close').css('display','none');
    $('.table_close3').css('display','block');
 //   $("#sum_activites").show();

   $.ajax({
     url: 'ahour.php',
     type: 'GET',
     data: 'twitterUsername=jquery4u',
     success: function(response) {
       var data = JSON.parse(response);
       sum = 0;
       var html = "";
       var myArray=[];

       for (let i = 0; i < data.length; i++) {
         var nu = parseInt(data[i].num);
         sum = sum + nu;
       }

       html += "<tr>";
       for (let i = 0; i < data.length; i++) {
         var hour =data[i].topday;
         var num = parseInt(data[i].num);
         html += "<tr>";
         html += "<td>" +hour +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
         html += "</tr>";
         myArray.push(hour,num)
       }

       document.getElementById("sum_hour").innerHTML = html;
       google.charts.setOnLoadCallback(DrawPieChart);

       function DrawPieChart() {
           // DEFINE AN ARRAY OF DATA.
           var arrSales = new google.visualization.DataTable();
           arrSales.addColumn('string', 'HOUR');
           arrSales.addColumn('number', 'ACTIVITY');

           for (let i=0;i<myArray.length-1;i+=2){
             arrSales.addRows([
               [myArray[i],myArray[i+1]]
             ]);
           }

           // SET CHART OPTIONS.
           var options = {
               title: 'Registrations Per Month',
               is3D: true,
               pieSliceText: 'value-and-percentage',

           };


           // WHERE TO SHOW THE CHART (DIV ELEMENT).
           var chart = new google.visualization.BarChart(document.getElementById('chart'));

           // DRAW THE CHART.
           chart.draw(arrSales, options);
         }
      },
      error: function(e) {
        //called when there is an error
         //console.log(e.message);
        }
      });

   });
   $("#p5").click(function(e){
     $('.table_close2').css('display','none');
     $('.table_close5').css('display','none');
     $('.table_close').css('display','none');
     $('.table_close1').css('display','none');
     $('.table_close3').css('display','none');
     $('.table_close4').css('display','block');
   //  $("sum_day").show();
   $.ajax({
     url: 'year.php',
     type: 'GET',
     data: 'twitterUsername=jquery4u',
     success: function(response) {
       var data = JSON.parse(response);
       sum = 0;
       var myArray=[];
       for (var i = 0; i < data.length; i++) {
         var nu = parseInt(data[i].num);
         sum = sum + nu;
       }
       var html = "";


       html += "<tr>";

       for (var i = 0; i < data.length; i++) {
         var year = data[i].topday;
         var num = parseInt(data[i].num);
           html += "<tr>";
           html += "<td>" +year +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
           html += "</tr>";
           myArray.push(year,num);
       }

       document.getElementById("sum_year").innerHTML = html;
       google.charts.setOnLoadCallback(DrawPieChart);

       function DrawPieChart() {
           // DEFINE AN ARRAY OF DATA.
           var arrSales = new google.visualization.DataTable();
           arrSales.addColumn('string', 'YEAR');
           arrSales.addColumn('number', 'ACTIVITY');

           for (let i=0;i<myArray.length-1;i+=2){
             arrSales.addRows([
               [myArray[i],myArray[i+1]]
             ]);
           }

           // SET CHART OPTIONS.
           var options = {
               title: 'Registrations Per Year',
               is3D: true,
               pieSliceText: 'value-and-percentage',

           };


           // WHERE TO SHOW THE CHART (DIV ELEMENT).
           var chart = new google.visualization.PieChart(document.getElementById('chart'));

           // DRAW THE CHART.
           chart.draw(arrSales, options);
         }
      },
      error: function(e) {
         //called when there is an error
          //console.log(e.message);
        }
      });

   });
});
