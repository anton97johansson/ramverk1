<?php

namespace Anax\View;

?>
<!-- <script src="../view/ip/OpenLayers.js"></script> -->
<form>
    <fieldset>
    <legend>Try ip adress</legend>

    <p>
        <label>Adress:<br>
        <input type="text" name="ipMap" value="<?=$localIP?>"/ required>
        </label>
    </p>

    <p>
        <input type="submit">
        <!-- <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button> -->
    </p>
    </fieldset>
</form>

<p><?=$check?></p>
<?php if (isset($type)) : ?>
    <p>Ipv<?=$type?></p>
    <p>longitude=<?=$long?> | latitude=<?=$lat?></p>
    <p>Land=<?=$country?> | region=<?=$region?></p>
<?php endif;?>
<p>Domain: <?=$hostname?></p>
<!-- <link rel="stylesheet" href="../view/ip/leaflet.css"> -->
<div id="map" style="width: 800px; height: 450px;"></div>
<!-- <script src="../view/ip/leaflet.js"></script>
<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
  integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
  crossorigin=""></script>
<script type="text/javascript">

var map = new L.Map('map');
var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
osmAttrib = 'Map data &copy; 2018 OpenStreetMap contributors',
osm = new L.TileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
map.setView(new L.LatLng(<?=$lat?>, <?=$long?>), 13).addLayer(osm);
var marker = L.marker([<?=$lat?>, <?=$long?>]).addTo(map);

//   L.geoJson(data  ,{
//     pointToLayer: function(feature,latlng){
// 	  return L.marker(latlng,{icon: ratIcon});
//     }
//   }  ).addTo(map);
// });
  // setTimeout(() => {
  // }, 500);
</script>
