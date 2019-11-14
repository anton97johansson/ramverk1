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

<div id="map" style="width: 800px; height: 450px;"></div>

<link rel="stylesheet" href="<?=url("css/leaflet.css")?>"/>
<script src="<?=url("js/leaflet.js")?>"></script>
<script type="text/javascript">
    var map = new L.Map('map');
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = 'Map data &copy; 2018 OpenStreetMap contributors',
    osm = new L.TileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
    map.setView(new L.LatLng(<?=$lat?>, <?=$long?>), 13).addLayer(osm);
    var marker = L.marker([<?=$lat?>, <?=$long?>]).addTo(map);
</script>
