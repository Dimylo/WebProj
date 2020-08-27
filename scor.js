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
