
$(document).ready(function() {
 $("#p1").click(function(e){
   $('.table_close1').css('display','none');
   $('.table_close3').css('display','none');
   $('.table_close4').css('display','none');
   $('.table_close2').css('display','none');
   $('.table_close').css('display','block');

  $.ajax({
    url: 'ascore1.php',
    type: 'GET',
    data: 'twitterUsername=jquery4u',
    success: function(response) {
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
     },
     error: function(e) {
        //called when there is an error
         //console.log(e.message);
       }
     });

  });
  $("#p2").click(function(e){
    $('.table_close4').css('display','none');
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
      sum = 0;
      for (var i = 0; i < data.length; i++) {
        var nu = parseInt(data[i].num);
        sum = sum + nu;
      }
      var html = "";


      html += "<tr>";
      html += "<td>" +"day"+"</td>";
      for (var i = 0; i < data.length; i++) {
        var num = data[i].topday;
        var type = data[i].activity;
        if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
        }else {
          html += "<tr>";

          html += "<td>" +num +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
          html += "</tr>";
        }
      }


      document.getElementById("sum_day").innerHTML = html;
     },
     error: function(e) {
        //called when there is an error
         //console.log(e.message);
       }
     });

  });
  $("#p3").click(function(e){
    $('.table_close4').css('display','none');
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
      for (var i = 0; i < data.length; i++) {
        var nu = parseInt(data[i].num);
        sum = sum + nu;
      }
      var html = "";


      html += "<tr>";
      html += "<td>" +"day"+"</td>";
      for (var i = 0; i < data.length; i++) {
        var num = data[i].topday;
        var type = data[i].activity;
        if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
        }else {
          html += "<tr>";

          html += "<td>" +num +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
          html += "</tr>";
        }
      }


      document.getElementById("sum_month").innerHTML = html;
     },
     error: function(e) {
        //called when there is an error
         //console.log(e.message);
       }
     });

  });
  $("#p4").click(function(e){
    $('.table_close4').css('display','none');
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
       for (var i = 0; i < data.length; i++) {
         var nu = parseInt(data[i].num);
         sum = sum + nu;
       }
       var html = "";


       html += "<tr>";
       html += "<td>" +"day"+"</td>";
       for (var i = 0; i < data.length; i++) {
         var num = data[i].topday;
         var type = data[i].activity;
         if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
         }else {
           html += "<tr>";

           html += "<td>" +num +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
           html += "</tr>";
         }
       }


       document.getElementById("sum_hour").innerHTML = html;
      },
      error: function(e) {
        //called when there is an error
         //console.log(e.message);
        }
      });

   });
   $("#p5").click(function(e){
     $('.table_close2').css('display','none');
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
       for (var i = 0; i < data.length; i++) {
         var nu = parseInt(data[i].num);
         sum = sum + nu;
       }
       var html = "";


       html += "<tr>";
       html += "<td>" +"day"+"</td>";
       for (var i = 0; i < data.length; i++) {
         var num = data[i].topday;
         var type = data[i].activity;
         if (type == "STILL" || type == "TILTING" || type == "UNKNOWN"){
         }else {
           html += "<tr>";

           html += "<td>" +num +" "+Math.round(data[i].num/sum*100) +"%"+"</td>";
           html += "</tr>";
         }
       }


       document.getElementById("sum_year").innerHTML = html;
      },
      error: function(e) {
         //called when there is an error
          //console.log(e.message);
        }
      });

   });
});
