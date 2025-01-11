<?php
require_once 'controlador.php';

$db = new DatabaseController();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Visualizador de ubicaciones y rutas</title>
	<link href="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <select id="select_dispositivo">
 	<option disabled value="0">-- Selecciona --</option>
 	<?php
        $sql = 'SELECT * from catalogo_dispositivo';
        $result = $db->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'" data-latitud="'.$row['latitud'].'" data-longitud="'.$row['longitud'].'">'.$row['nombre'].'</option>';
            }
        }

        $db->close();
 	?>
 </select>
 <input type="date" id="input_fecha">
 <div id="mapa"></div> 


 <script src="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.js"></script>
 <script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiZ29tZXo5NSIsImEiOiJjbGZiZmhwYnMwMTIwM3hsbHV6d3UwNHVnIn0.yGOMNBnMgF_LiBWvzRidpg';
    const map = new mapboxgl.Map({
        container: 'mapa', 
        center: [-100.814, 20.52184],
        zoom: 11
    });
    const marker1 = new mapboxgl.Marker()
        .setLngLat([-100.814, 20.52184])
        .addTo(map);

    document.getElementById("select_dispositivo").addEventListener("change", function () {
            var opcion = this.options[this.selectedIndex];

            var latitud = opcion.dataset.latitud;
            var longitud = opcion.dataset.longitud;

            marker1.setLngLat([latitud,longitud]);

            map.flyTo({
                center: [latitud,longitud]
            });
        })
</script> 
</body>
</html>