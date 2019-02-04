<?php
/**
 * Displays location of Velvet & Compass Hotel and points of interest nearby
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Load header and JavaScript files
$scriptList = array("js/jquery-3.3.1.js", "leaflet/leaflet.js", "js/hotel-map.js");
include("filePrivate/header.php");
?>

<div>
    <figure id="map">
        <img src="images/map.png" alt="Map of Dunedin">
    </figure>

    <div class="contact" id="hotel">
        <h3>Velvet & Compass Hotel Dunedin</h3>
        <p>
            44 Royal Terrace
        </p>
        <p>
            (03) 490 1234
        </p>
    </div>
    <section id="restaurant-block">
        <h2>Nearby Restaurants</h2>
        <div class="restaurant">
            <h3>Etrusco</h3>
            <p>8 Moray Pl, Dunedin, 9016</p>
            <p>(03) 477 3737</p>
            <p>A family-owned Italian restaurant</p>
        </div>
        <div class="restaurant">
            <h3>Jizo</h3>
            <p>56 Princes St</p>
            <p>(03) 479 2692</p>
            <p>Japanese restaurant and bar</p>
        </div>
        <div class="restaurant">
            <h3>Ombrellos Kitchen & Bar</h3>
            <p>10 Claredon St</p>
            <p>(03) 477 8773</p>
            <p>The finest craft beer restaurant in Dunedin</p>
        </div>
    </section>
    <section id="attraction-block">
        <h2>Local Attractions</h2>
        <div class="attraction">
            <h3>Dunedin Railway Station</h3>
            <p>22 Anzac Ave, Dunedin, 9016</p>
            <p>New Zealand's oldest railway station and the most photographed building in the country,
                features rail excursions and an art gallery.</p>
        </div>
        <div class="attraction">
            <h3>Hocken Collections</h3>
            <p>90 Anzac Ave</p>
            <p>(03) 479 8868</p>
            <p>Hocken Collections is a research library, historical archive,
                and art gallery based in Dunedin, New Zealand. </p>
        </div>
        <div class="attraction">
            <h3>Otago Museum</h3>
            <p>419 Great King St</p>
            <p>(03) 474 7474</p>
            <p>Otago Museum is located in the heart of Dunedin, and houses displays on
                early New Zealand and Pacific history, science, and natural history.</p>
        </div>
    </section>
</div>

<?php
// Load footer
include("filePrivate/footer.php");
?>