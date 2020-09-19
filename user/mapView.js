const button = document.getElementById('save');
var restrNE, restrSW;
var xhttp = new XMLHttpRequest();
let mymap = L.map("mapid", {editable: true});
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(mymap);
mymap.setView([38.246242, 21.7350847], 16);

xhttp.open("GET", "restrictions.php", true);
xhttp.onreadystatechange = function() {
  if (this.readyState = 4 && this.status == 200) {
    if(this.responseText != "") {
      var data = JSON.parse(this.responseText);
      for(var i in data) {
        var rect = [[data[i].north, data[i].east], [data[i].south, data[i].west]];
        L.rectangle(rect , {color: "#ff7800", weight: 1}).addTo(mymap);
      }
    }
  }
}
xhttp.send();
mymap.editTools.startRectangle();

var shades = new L.LeafletShades();
shades.addTo(mymap);

shades.on('shades:bounds-changed', function(event) {
  var bounds = event.bounds;
  restrNE = bounds.getNorthEast();
  restrSW = bounds.getSouthWest();

  });
  button.addEventListener('click', function() {
    var dimensions = [restrNE, restrSW];
    xhttp.open("GET", "restrictions.php?dimensions="+dimensions, true);
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("print").innerHTML = this.responseText;
      L.rectangle(dimensions , {color: "#ff7800", weight: 1}).addTo(mymap);

    }
  };
  xhttp.send();
});
