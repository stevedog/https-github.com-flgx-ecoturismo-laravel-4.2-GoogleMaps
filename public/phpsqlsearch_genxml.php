<?php
// Opens a connection to a mySQL server
$connection = mysqli_connect('200.55.240.51', 'fran' , 'FranLakes2016');
if (!$connection) {
  die("Not connected : " . mysql_error());
}

// Set the active mySQL database
$db_selected = mysqli_select_db($connection,'admin_laravel');
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}
// Get parameters from URL

$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];

	/*
$center_lat = -37.4043222;
$center_lng = -58.182706199999984;
$radius = 500;
*/
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


// Search the rows in the markers table
$query = sprintf("SELECT locations.location_id, id, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM locations LEFT JOIN location_tag  ON location_tag.location_id = locations.id WHERE location_tag.tag_id = 19 OR location_tag.tag_id = 18 OR location_tag.tag_id = 17 OR location_tag.tag_id = 19  HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysqli_real_escape_string($connection,$center_lat),
  mysqli_real_escape_string($connection,$center_lng),
  mysqli_real_escape_string($connection,$center_lat),
  mysqli_real_escape_string($connection,$radius));
/*$query2 = "SELECT name, lat, lng, ( 3959 * acos( cos( radians('.$center_lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$center_lng.') ) + sin( radians('.$center_lat.') ) * sin( radians( lat ) ) ) ) AS distance FROM locations LEFT JOIN location_tag  ON location_tag.location_id = locations.id WHERE location_tag.tag_id = 19 OR location_tag.tag_id = 18 OR location_tag.tag_id = 17 OR location_tag.tag_id = 19  HAVING distance < '.$radius.' ORDER BY distance LIMIT 0 , 20"; */
$result = mysqli_query($connection,$query);



if (!$result) {
  die("Invalid query: " . mysql_error());
}
if(mysqli_num_rows($result) != 0){


header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){

  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", utf8_encode($row['name']));
  $newnode->setAttribute("lat", utf8_encode($row['lat']));
  $newnode->setAttribute("lng", utf8_encode($row['lng']));
  $newnode->setAttribute("id", utf8_encode($row['id']));
  $newnode->setAttribute("location_id", utf8_encode($row['location_id']));
  $newnode->setAttribute("distance", utf8_encode($row['distance']));
}

echo $dom->saveXML();
}
?>