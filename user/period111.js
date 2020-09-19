$(document).ready(function() {
        $.ajax({
              type: "POST",
              url: 'select_first_date1.php',
              success: function(response)
              {
                  var interval=JSON.parse(response);
                  var html = "";
                  console.log(parseInt(interval[0].max*1e+3))
                var maxDate=new Date(parseInt(interval[0].max*1e+3));;
                // Hours part from the timestamp
                var hours = maxDate.getHours();
                // Minutes part from the timestamp
                var minutes = "0" + maxDate.getMinutes();
                // Seconds part from the timestamp
                var seconds = "0" + maxDate.getSeconds();

                // Will display time in 10:30:23 format
                var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
                var minDate = new Date(parseInt(interval[0].min)*1e+3);
                // Hours part from the timestamp
                var hours = minDate.getHours();
                // Minutes part from the timestamp
                var minutes = "0" + minDate.getMinutes();
                // Seconds part from the timestamp
                var seconds = "0" + minDate.getSeconds();

                // Will display time in 10:30:23 format
                var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                console.log(formattedTime);

                  html += "<td>" +"(" +minDate +")-("+maxDate+")";
                  document.getElementById("eyros").innerHTML = html;
              }
        });
   });
