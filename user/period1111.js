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
                  var year2=maxDate.getFullYear();
                  var month2=maxDate.getMonth();
                  var day2=maxDate.getDate();
                  var hours = maxDate.getHours();
                  // Minutes part from the timestamp
                  var minutes = "0" + maxDate.getMinutes();
                  // Seconds part from the timestamp
                  var seconds = "0" + maxDate.getSeconds();

                  // Will display time in 10:30:23 format
                  var formattedTime2 = year2 + '-' + month2 + '-' + day2;
                  var minDate = new Date(parseInt(interval[0].min)*1e+3);
                  var year1=minDate.getFullYear();
                  var month1=minDate.getMonth();
                  var day1=minDate.getDate();
                  // Hours part from the timestamp
                  var hours = minDate.getHours();
                  // Minutes part from the timestamp
                  var minutes = "0" + minDate.getMinutes();
                  // Seconds part from the timestamp
                  var seconds = "0" + minDate.getSeconds();

                  // Will display time in 10:30:23 format
                  var formattedTime1 = year1 + '-' + month1 + '-' + day1;

                  console.log(formattedTime1);

                  html += "<td>" +"(" +formattedTime1 +")-("+formattedTime2+")";
                  document.getElementById("eyros").innerHTML = html;
              }
        });
        $.ajax({
              type: "POST",
              url: 'select_date11.php',
              success: function(response)
              {
                  var date=JSON.parse(response);
                  var d=String(date);
                  console.log(d);
                  if(d==="false"){
                      let html1="NEVER";
                      document.getElementById("last_date").innerHTML ="undefined";
                }
                else {
                  var html1 = "";
                  html1 += "<tr>";
                  html1 += "<td>"+ date[0].date_upload;
                  document.getElementById("last_date").innerHTML = html1;
                }
              }
        });
   });
