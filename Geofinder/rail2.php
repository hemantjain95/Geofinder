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
    // echo "Opened database successfully\n";
   }
//$name='9';
  $name = $_GET['No'];
    //echo $name;
$x="select  st_astext(geom) from ind_rails where gid = '$name'";
$y="select st_npoints(geom) from ind_rails where gid = '$name'";
$z="select gid,fid_rail_d,f_code_des,exs_descri,fco_descri from ind_rails where gid = '$name'";
$queryz = pg_query($db,$z) ;//echo"hi";
     //echo $z;


if (!$queryz) {}
  //echo "An error occurred";}

    if(pg_num_rows($queryz)>0)
    {
	$resultz = pg_fetch_array($queryz);
        
      
    }	

    $query = pg_query($db,$x) ;
     //echo $x;	
$queryy = pg_query($db,$y) ;
     //echo $y;	
if (!$query) {}
  //echo "An error occurred";}

    if(pg_num_rows($query)>0)
    {
	$result = pg_fetch_array($query);
        //echo "<br/> LATITUDE : $result[0]";
      
    }
if (!$queryy) {}
  //echo "An error occurred";}

    if(pg_num_rows($queryy)>0)
    {
	$resulty = pg_fetch_array($queryy);
        //echo "<br/> LATITUDE : $resulty[0]";
      
    }

$num=$resulty[0];
//echo $num;
$num=$num-1;
$data = explode(",",$result[0]);//echo "hi";
//echo $data[1];
for($i=1;$i<$num;$i=$i+1)
{ //echo $i;
//echo  $data[$i];
$next[$i]=explode(" ",$data[$i]);
//echo $next[$i][0];echo " <br/>   ";   
//echo $next[$i][1];echo "<br/>";
}


$i=0;

//$data = explode(",",$result[0]);
//echo $data[1];
//$new



  //  else if(array_key_exists('name',$_GET))
    //    echo "no match found" ;
     //echo "$result[0]"; 
?>










<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
//var x=new google.maps.LatLng(<?php echo $next[1][1];?>, <?php echo $next[1][0];?>);
//var stavanger=new google.maps.LatLng(<?php echo $next[2][1];?>, <?php echo $next[2][0];?>);
//var amsterdam=new google.maps.LatLng(<?php echo $next[3][1];?>, <?php echo $next[3][0];?>);
//var london=new google.maps.LatLng(<?php echo $next[$num-1][1];?>, <?php echo $next[$num-1][0];?>);
var y= <?php echo json_encode($next); ?>;
//document.write(y[1][0]);
var n ="<?php echo $num;?>";document.write(n);var flightPlanCoordinates=new Array();
for (var i = 1; i < n-1; i++)
  {  document.write("hello");
flightPlanCoordinates[i-1]=new google.maps.LatLng( y[i][1],y[i][0]);
}
   
function initialize()
{
var mapProp = {
  center:flightPlanCoordinates[1] ,
  zoom:10,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

//var myTrip=[x,stavanger,amsterdam,london];
var flightPath=new google.maps.Polyline({
  path:flightPlanCoordinates,
  strokeColor:"#000000",
  strokeOpacity:0.8,
  strokeWeight:5
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
</head>
<body>
<header class="dark">
  <nav>
    <div id="logo">
      <h1><a href="index.html">Project</h1>
    </div>
    <div id="menu">
      <ul>   <li>  <a href="city.php" >City Citing</a> <a href="dist1.php">City path</a> <a href="rail2.php">Railway</a> <a href="river1.php">River</a> <a href="road.php">Roads</a><a href="state.php">State</a> </li>
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
      <h1>Railway Routes <span>Map the train paths</span></h1>
       </div>
    <div class="full">
      <div id="contact-form">
        <form id="contact-us" action="rail2.php">
          <div class="column-half">
            <div class="formblock">
              <span> Train Route No. </span><input type="text" name="No" id="contactName" value="" class="txt requiredField" placeholder="">
            </div>
            
            <button name="submit" type="submit" class="subbutton" value="submit"></button>
<br /><br /><br /><br />

<span><?php echo "<br/> Train Route No. : $resultz[0]  <br />Train Route Id : $resultz[1] <br />Type :  $resultz[2]<br />	Current Status :$resultz[3] <br />	No of Tracks : $resultz[4]"; ?></span>
          </div>
          <div class="column-half last">
           
            <p>When you enter a Train Route No. it maps the it with the train route Id, Train Type, Current Status, No of tracks and also with the longitudes and latitudes of the transversal of the train and sends them to google maps API which then maps the path of the train on the google map.</p>
          </div>

<div id="googleMap" style="width:500px;height:380px;background:transparent;" ></div>
        </form>
      </div>
    </div>
  </div>
</section>
<footer><section class="footer">
   </section>
</footer>
<!--Javascript-->

<script src="js/jquery.flexslider-min.js"></script>
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
<!--Sequence slider-->
<script>
var options = {
    autoPlay: true,
    nextButton: ".next",
    prevButton: ".prev",
    preloader: "#sequence-preloader",
    prependPreloader: false,
    prependPreloadingComplete: "#sequence-preloader, #slideshow",
    animateStartingFrameIn: true,
    transitionThreshold: 500,
    nextButtonAlt: " ",
    prevButtonAlt: " ",
    afterPreload: function () {
        $(".prev, .next").fadeIn(500);
        if (!slideShow.transitionsSupported) {
            $("#slideshow").animate({
                "opacity": "1"
            }, 1000);
        }
    }
};
var slideShow = $("#slideshow").sequence(options).data("sequence");
if (!slideShow.transitionsSupported || slideShow.prefix == "-o-") {
    $("#slideshow").animate({
        "opacity": "1"
    }, 1000);
    slideShow.preloaderFallback();
}
</script>
<script>
new GMaps({
    div: '#map',
    lat: 44.79913,
    lng: 20.47662
});
</script>
<script>
if (typeof jQuery == 'undefined') {
    document.write(unescape("%3Cscript src='js/jquery.js'%3E%3C/script%3E"));
}
</script>
</body>
</html>
