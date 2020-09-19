//Last Month Score
$(document).ready(function() {
        $.ajax({
              type: "POST",
              url: 'select_scor.php',
              success: function(response)
              {
                  var scor=JSON.parse(response);
                  console.log(scor);
                  var  html ='';
                  var sum = 0;
                  let ecological=0;
                  var non_ecological = 0;
                  for (var i = 0; i < scor.length; i++) {
                    var type = scor[i].act_type;

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
                  ecological =Math.round(ecological);
                  html += "<tr>";
                  html += "<td>" +Math.round(ecological)+ "%";
                  document.getElementById("scor").innerHTML = html;

          }
        });
        //Past 12 months Diagram
                $.ajax({
                      type: "POST",
                      url: 'LastMonth.php',
                      success: function(response)
                      {
                          var scor=JSON.parse(response);
                          console.log(scor);
                          var  html ='';
                          var sum = 0;
                          let ecological=0;
                          var non_ecological = 0;
                          for (var i = 0; i < scor.length; i++) {
                            var type = scor[i].act_type;

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
                          ecological =Math.round(ecological);
                          html += "<tr>";
                          html += "<td>" +Math.round(ecological)+ "%";
                          document.getElementById("lastMonth").innerHTML = html;

                  }
                });

//Past 12 months Diagram
        $.ajax({
              type: "POST",
              url: 'LastYear.php',
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

                  // document.getElementById("sum_activites").innerHTML = html;

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
          //         var scor=JSON.parse(response);
          //         console.log(scor);
          //         var  html ='';
          //         var sum = 0;
          //         let ecological=0;
          //         var non_ecological = 0;
          //         for (var i = 0; i < scor.length; i++) {
          //           var type = scor[i].act_type;
          //
          //           if (type == "STILL" || type == "TILTING" || type == "UNKNOWN") {
          //             sum = sum;
          //           }else if (type == "ON_FOOT" || type == "ON_BICYCLE") {
          //             ecological = ecological + 1;
          //             sum = sum +1;
          //           }else {
          //             non_ecological = non_ecological +1;
          //             sum = sum +1;
          //           }
          //
          //         }
          //         ecological = (ecological/sum)*100;
          //         ecological =Math.round(ecological);
          //         html += "<tr>";
          //         html += "<td>" +Math.round(ecological)+ "%";
          //         document.getElementById("lastYear").innerHTML = html;
          //
          // }
        });

//Leaderboard
        $.ajax({
              type: "POST",
              url: 'update_scor.php',
              success: function(response)
              {
                var update=JSON.parse(response);
                console.log(update)
                let board={};
                let check=[];
                let list=[];
                var html="";
                let j=0;
                for (let i = 0; i < update.length-1; i+=2) {
                  board[j]={name:update[i].username,scor:Math.round((update[i].rank/update[i+1].rank)*100)};
                  j+=1;
               }

               var sorted =Object.entries( board).sort((a, b) => b[1].scor - a[1].scor);
               console.log(sorted)
               var l=0;
               //list of top 3
               while(l<3){
                 let name=sorted[l][1].name;
                 name=name.substr(0, 3)+"."+(name.substr(4,5).toUpperCase());
                 console.log(name)
                 html += "<tr>";
                 html += "<td>"+ (l+1)+":" +name+" </td>";
                 html += "<td>" +"("+sorted[l][1].scor +"%)"+"</td>"+"<br>";
                 html += "</tr>";
                 check.push(sorted[l][1].name);
                 list.push(sorted[l][1].name);
                 l+=1;
               }
               //whole list
               for(let i = 3; i < Math.round((update.length-1)/2); i++){
                 list.push(sorted[i][1].name);
               }
               function findPosition(list) {
                  function isLast(element) {
                        return element === list;
                    }
                    return isLast;
                }
                let isLast = findPosition(update[update.length-1]);
                let index = list.findIndex(isLast);
                index=index+1;
                console.log(index)
                console.log(check)
                console.log(list)

               if(index<=3){
                 document.getElementById("top_3").innerHTML = html;
               }
               else if(index==4){
                   html += "<tr>";
                   html += "<td>"+ (l+1)+":" +sorted[l][1].name +" </td>";
                   html += "<td>" +"("+sorted[l][1].scor +"%)"+"</td>"+"<br>";
                   html += "</tr>";

                 document.getElementById("top_3").innerHTML = html;
               }
               else if(index>4){
                 html += "<td> . </td>";
                 html += "</tr>";
                 html += "<br>";
                 html += "<tr>";
                 html += "<td>"+ index+":" +sorted[index-1][1].name +" </td>";
                 html += "<td>" +"("+sorted[index-1][1].scor +"%)"+"</td>"+"<br>";
                 html += "</tr>";
                 document.getElementById("top_3").innerHTML = html;
               }



             }
        });
   });