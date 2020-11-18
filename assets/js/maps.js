
/* pk.eyJ1IjoiZXNtZXJhbGRhbGFtYXMiLCJhIjoiY2tobWo4aDZxMGJtOTMzbWsxb2Exb2dqYSJ9.sDNOaLeiLPlb55zfk_qtlw */

mapboxgl.accessToken = 'pk.eyJ1IjoiZXNtZXJhbGRhbGFtYXMiLCJhIjoiY2tobWo4aDZxMGJtOTMzbWsxb2Exb2dqYSJ9.sDNOaLeiLPlb55zfk_qtlw';

let map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-63.2474294,-17.3454335],// starting position [lng, lat]
    zoom: 10
});

var marker = new mapboxgl.Marker()
.setLngLat([-63.2474294,-17.3454335])
.addTo(map);
 