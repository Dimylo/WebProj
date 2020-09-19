$(document).ready(function() {
        $.ajax({
              type: "POST",
              url: 'select_date11.php',
              success: function(response)
              {
                  var date=JSON.parse(response);

                  // console.log(date);

                  var html1 = "";
                  html1 += "<tr>";
                  html1 += "<td>"+ date[0].date_upload;
                  document.getElementById("last_date").innerHTML = html1;
              }
        });
   });
