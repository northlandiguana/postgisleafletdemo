# PostGIS with Leaflet Demo

This simple demo was created for the UW-Madison Cart Lab Education Series on 4/17/2015 by Carl Sack. CC-BY-3.0.

## Setup:
1. Download or clone the directory and place it where it can be accessed by a localhost server, or fire up a servlet wherever you put it.
2. Using pgAdminIII, create a new PostGIS-enabled database.
3. Use the pgAdminIII PostGIS Shapefile and DBF Loader plug-in to load the fracsandsites shapefile (in the data directory) into your database. *Make sure you assign 26916 as the geometry SRID.*
4. Change the database credentials in getData.php (in the php directory) to match your database credentials.
5. Open your browser and navigate to the demo directory through your localhost server. You should see the data as orange circles on the map.

The full tutorial is available [here](https://northlandia.wordpress.com/2015/04/20/connecting-postgis-to-leaflet-using-php/).