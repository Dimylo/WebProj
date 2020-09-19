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
  lngField: 'longtitudee7',
  // // // which field name in your data represents the longitude - default "lng"
  // which field name in your data represents the data value - default "value"
  valueField: 'count'
};
var heatmapLayer =  new HeatmapOverlay(cfg);
mymap.addLayer(heatmapLayer);


function footy() {
  let x="foot";
  var foot = document.getElementById(x);
  if (foot.checked == true){
    console.log('MPHKE  FOOT')

    array.push( document.getElementById(x).value);
    obj={...obj,aaa: document.getElementById(x).value};
  }else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}
function bike() {
  let x="bicycle";
  var bike = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (bike.checked == true){
    console.log('MPHKE BIKE')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}
function stilly() {
  let x="still";
  var still = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (still.checked == true){
    console.log('MPHKE STILL')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}
function walky() {
  let x="walk";
  var walk = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (walk.checked == true){
    console.log('MPHKE WALK')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}
function runy() {
  let x="run";
  var run = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (run.checked == true){
    console.log('MPHKE RUN')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}
function iveh() {
  let x="vehicle";
  var iveh = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (iveh.checked == true){
    console.log('MPHKE IVEH')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}function eveh() {
  let x="evehicle";
  var eveh = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (eveh.checked == true){
    console.log('MPHKE EVEH')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}function tilty() {
  let x="tilt";
  var tilt = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (tilt.checked == true){
    console.log('MPHKE TILT')
    array.push(document.getElementById(x).value);
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    let index = array.indexOf(document.getElementById(x).value);
array.splice(index, 1);
  }
}function ally() {
  let x="all";
  var all = document.getElementById(x);
  // If the checkbox is checked, display the output text
  if (all.checked == true){
    console.log('MPHKE ALL')
    array.push("TILTING","EXITING_VEHICLE","IN_VEHICLE","RUNNING","WALKING","ON_BICYCLE","ON_FOOT","STILL");
    obj={...obj,aa:document.getElementById(x).value};
  } else {
    array=[];
  }
}

var obj={};
var array=[];



$(document).ready(function() {

  $('#search').click(function(e) {
    e.preventDefault();
    console.log(obj,array)

    var date1 = new Date(document.getElementById("start").value);
    var st = date1.getTime()*1e-3;
    var date2 = new Date(document.getElementById("last").value);
    var la = date2.getTime()*1e-3;
    if(!st=='' && !la=='' && array.length > 0){
    $.ajax({
      type: "POST",
          url: 'select_coordinates.php',
          data: {'last1':la,'start1':st,'data[]':array},
          success: function(response)
          {
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
alert('You have to select dates and filters first!!');
}
  });

});
