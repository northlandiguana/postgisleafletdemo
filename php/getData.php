<?php
ini_set('display_errors', 1); 

//database login info
$host = 'localhost';
$port = '5432';
$dbname = 'sandwikimap2';
$user = 'postgres';
$password = 'postgis';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
	echo "Not connected : " . pg_error();
	exit;
}

//get the table and fields data
$table = $_GET['table'];
$fields = $_GET['fields'];

//turn fields array into formatted string
$fieldstr = "";
foreach ($fields as $i => $field){
	$fieldstr = $fieldstr . "r.$field, ";
}

//get the geometry as geojson in WGS84
$fieldstr = $fieldstr . "ST_AsGeoJSON(ST_Transform(r.geom,4326))";

//create basic sql statement
$sql = "SELECT $fieldstr FROM $table r";

//if a query, add those to the sql statement
if (isset($_GET['featname'])){
	$featname = $_GET['featname'];
	$distance = $_GET['distance'] * 1000; //change km to meters

	//join for spatial query - table geom is in EPSG:26916
	$sql = $sql . " LEFT JOIN $table l ON ST_DWithin(r.geom, l.geom, $distance) WHERE l.featname = '$featname';";
}

// echo $sql;

//send the query
if (!$response = pg_query($conn, $sql)) {
	echo "A query error occured.\n";
	exit;
}

//echo the data back to the DOM
while ($row = pg_fetch_row($response)) {
	foreach ($row as $i => $attr){
		echo $attr.", ";
	}
	echo ";";
}

?>