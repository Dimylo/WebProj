var mymap = L.map('mapid')
var osmUrl='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
var osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
 mymap.addLayer(osm);
mymap.setView([38.246242, 21.7350847], 16);
var status  = document.getElementsByName("status")[0];

var cfg = {
  // radius should be small ONLY if scaleRadius is true (or small radius is intended)
  // if scaleRadius is false it will be the constant radius used in pixels
  "radius": 40,
  "maxOpacity": 0.8,
  // scales the radius based on map zoom
  "scaleRadius": false,
  // if set to false the heatmap uses the global maximum for colorization
  // if activated: uses the data maximum within the current map boundaries
  //   (there will always be a red spot with useLocalExtremas true)
  "useLocalExtrema": false,
  // which field name in your data represents the latitude - default "lat"
  latField: 'latitudee7',
  lngField: 'longitudee7',
  // // // which field name in your data represents the longitude - default "lng"
  // which field name in your data represents the data value - default "value"
  valueField: 'count'
};
var heatmapLayer =  new HeatmapOverlay(cfg);
mymap.addLayer(heatmapLayer);
// console.log(st);

$(document).ready(function() {

  $('#search').click(function(e) {
    e.preventDefault();
    var date = new Date(document.getElementById("start").value);
    var st = date.getTime()*1e-3;
    var date2 = new Date(document.getElementById("last").value);
    var la = date2.getTime()*1e-3;

console.log(st,la)


    if(!st=='' && !la==''){
    $.ajax({
      type: "POST",
          url: 'select_coords.php',
          data: {'start1':st,'last1':la},
          success: function(response)
          {
            console.log(st);
            data=JSON.parse(response);
            console.log(data);

            let testData = {
                max: 8,
                data: data
            };

            heatmapLayer.setData(testData);


        }
    });

}
else{
alert('You have to select dates first!!');
}
  });

});
