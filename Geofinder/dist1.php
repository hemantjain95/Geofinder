<?php
$host= "localhost";
   $dbname= "postgres";
     $user = 'postgres';
    $password = 'hemant';

//echo "hello";
$db = pg_connect( "host=$host dbname=$dbname user=$user password=$password	"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      //echo "Opened database successfully\n";
   }
   $name = $_GET['from'];
    $name2 = $_GET['to'];	
   // echo $name2	;
$x="select  st_x(location),st_y(location) from testing where city = '$name'";
$y="select  st_x(location),st_y(location) from testing where city = '$name2'";
$a="select  st_astext(location) from testing where city = '$name'";
$b="select  st_astext(location) from testing where city = '$name2'";//echo $a;echo $b;
  	  $querya = pg_query($db,$a) ;$queryb= pg_query($db,$b) ;
//if (!$querya) 
  //echo "An error occurred";}
 if(pg_num_rows($querya)>0)
    {
	$resulta = pg_fetch_array($querya);
      //  echo "<br/> LATITUDE : $resulta[0]";
    }
    else if(array_key_exists('name',$_GET))
        echo "no match found" ;
if (!$queryb) {
  echo "An error occurred";}
//else if(pg_num_rows($queryb>0)
    {
	$resultb = pg_fetch_array($queryb);
      //  echo "<br/> LATITUDE : $resultb[0]";
    }
   //else if(array_key_exists('name2',$_GET))
     //   echo "no match found" ;

$c="select st_distance('$resulta[0]','$resultb[0]')";
//echo $c;
$queryfinal = pg_query($db,$c) ;
//if (!$queryfinal) {
 // echo "An error occurred";}

    if(pg_num_rows($queryfinal)>0)
    {
	$resultc = pg_fetch_array($queryfinal);$resultc[0]=$resultc[0]*110;
       // echo "<br/> DISTANCE : $resultc[0] kms";
    }



    $query = pg_query($db,$x) ;$query2= pg_query($db,$y) ;
     //echo $x;	
//if (!$query) {
 // echo "An error occurred";}

    if(pg_num_rows($query)>0)
    {
	$result = pg_fetch_array($query);
        //echo "<br/> LATITUDE : ".$result['st_x']."</br> LONGITUDE :".$result['st_y']."";
    }
    else if(array_key_exists('name',$_GET))
        echo "no match found" ;
 if(pg_num_rows($query2)>0)
    {
	$result2 = pg_fetch_array($query2);
       // echo "<br/> LATITUDE : ".$result2['st_x']."</br> LONGITUDE :".$result2['st_y']."";
    }
    else if(array_key_exists('name2',$_GET))
        echo "no match found" ;



     
?>












<!DOCTYPE html>
<html>



<head>
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
var x=new google.maps.LatLng(<?php echo $result['st_x'];?>, <?php echo $result['st_y']?>);
var stavanger=new google.maps.LatLng(<?php echo $result2['st_x'];?>, <?php echo $result2['st_y']?>);

function initialize()
{
var mapProp = {
  center:x,
  zoom:4,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var myTrip=[x,stavanger];
var flightPath=new google.maps.Polyline({
  path:myTrip,
  strokeColor:"#0000FF",
  strokeOpacity:0.8,
  strokeWeight:2
  });

flightPath.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
<title>Spatial Database - DBMS Project</title>
<meta charset="UTF-8">
<!--Style Sheet-->
<link rel="stylesheet" type="text/css" href="css/flexslider.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/sequence.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/lightbox.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<!--Special Styles-->
<link rel="stylesheet" type="text/css" href="css/style.css" title="default" media="screen">
<link rel="alternate stylesheet" type="text/css" href="css/elegant.css" title="elegant" media="screen">
<link rel="alternate stylesheet" type="text/css" href="css/modern.css" title="modern" media="screen">
<link rel="alternate stylesheet" type="text/css" href="css/colorfull.css" title="colorfull" media="screen">
<!--Responsive-->
<link rel="stylesheet" type="text/css" href="css/responsitive.css" media="all">
<!--Google fonts-->
<link href='http://fonts.googleapis.com/css?family=Russo+One&subset=latin,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<!--Javascript-->
<script src="js/jquery-1.7.2.min.js"></script>
<!--[if lt IE9]>
<script src="js/html5.js"></script>
<script src="js/IE7.js"></script>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!-- Load custom js -->

	<Script type="text/javascript">
		$(document).ready(function(){

			$("#contactName").keyup(function(){
				
				var value = $("#contactName").val();
				
				$.ajax({
					type:"POST",
					url:"search.php",
					data:"query="+value,
					success: function(result){

						console.log(result);
						$("#results").html(result);
					}
				});
			});
		});
	</script>

	<Script type="text/javascript">
		$(document).ready(function(){

			$("#email").keyup(function(){
				
				var value = $("#email").val();
				
				$.ajax({
					type:"POST",
					url:"search1.php",
					data:"query="+value,
					success: function(result){

						console.log(result);
						$("#results1").html(result);
					}
				});
			});
		});
	</script>
</head>
<body>
<header class="dark">
  <nav>
    <div id="logo">
      <h1><a href="index.html">Project</h1>
    </div>
    <div id="menu">
      <ul>
        <li>  <a href="city.php" >City Citing</a> <a href="dist1.php">City path</a> <a href="rail2.php">Railway</a> <a href="river1.php">River</a> <a href="road.php">Roads</a><a href="state.php">State</a> </li>
      </ul>
    </div>
  </nav>
</header>
<!--<div id="switcher"> <a class="switch-button open"></a>
  <div class="content">
    <ul class="headercolor">
      <span>Header color</span>
      <li class="red"><a href="#light">Light</a></li>
      <li class="blue"><a href="#dark">Dark</a></li>
    </ul>
    <ul class="theme">
      <span>Theme</span>
      <li><a href="#" rel="default" class="styleswitch">default</a></li>
      <li><a href="#" rel="elegant" class="styleswitch">elegant</a></li>
      <li><a href="#" rel="modern" class="styleswitch">modern</a></li>
      <li><a href="#" rel="colorfull" class="styleswitch">colorfull</a></li>
    </ul>
  </div>
</div>-->
<section id="contact" class="container dark second">
  <div class="content">
    <div class="title icon-phone">
      <h1>Path <span>Find your way to a city.</span></h1>
    </div>
    <div class="full">
      <div id="contact-form">
        <form id="contact-us" method = "GET" action = "dist1.php">
          <div class="column-half">
            <div class="formblock">
            <span> From : </span> <input type="text" name="from" id="contactName" value="" class="txt requiredField" placeholder="<?php echo $name; ?>" autocomplete="off">
            </div><div id="results">
		</div>
            <div class="formblock">
              <span>To :</span> <input type="text" name="to" id="email" value="" class="txt requiredField email" autocomplete="off" placeholder="<?php echo $name2; ?>">
            </div><div id="results1">
		</div>
            
            <button name="submit" type="submit" class="subbutton" value="submit"></button>
          </div>
          <div class="column-half last">
            
            <p>When you enter the two cities, it maps the cities in our database with their latitude and longitude and sends them to the google maps API. The google map API then the gives the distance between the two cities and lays it out on the map using a line.</p>
          </div>
</form>
<?php

 if(pg_num_rows($query)>0)
    {
	$result = pg_fetch_array($query);
        //echo "<br/> LATITUDE : ".$result['st_x']."</br> LONGITUDE :".$result['st_y']."";
    }
    else if(array_key_exists('name',$_GET))
        echo "no match found" ;
 if(pg_num_rows($query2)>0)
    {
	$result2 = pg_fetch_array($query2);
       // echo "<br/> LATITUDE : ".$result2['st_x']."</br> LONGITUDE :".$result2['st_y']."";
    }
    else if(array_key_exists('name2',$_GET))
        echo "no match found" ;

echo "<br/> DISTANCE : $resultc[0] kms";
?><div id="googleMap" style="width:500px;height:500px;" align="center"></div>
      </div>
    </div>
  </div>
</section>
<footer> 
  <section class="footer">
  
  </section>
</footer>
<!--Javascript-->
<script src="js/sequence.jquery-min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/quicksand.js"></script>
<script src="js/jquery.masonery.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/gmaps.js"></script>
<script src="js/jquery.accordion.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/styleswitch.js"></script>
<script src="js/custom.js"></script>
<script>
if (typeof jQuery == 'undefined') {
    document.write(unescape("%3Cscript src='js/jquery.js'%3E%3C/script%3E"));
}
</script>
</body>
</html>

