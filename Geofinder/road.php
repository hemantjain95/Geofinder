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
//$name='5';
    $name = $_GET['Name'];
    //echo $name  ;
$x="select st_astext(geom) from ind_roads where gid='$name'";
$y="select st_npoints(geom) from ind_roads where gid='$name'";
$z="select gid,med_descri,rtt_descri,f_code_des from ind_roads where gid='$name'";
//echo $x;
//echo $y;
$queryz = pg_query($db,$z) ;
    $query = pg_query($db,$x) ;
     //echo $x;	

if(pg_num_rows($queryz)>0)
    {
	$resultz = pg_fetch_array($queryz);
      // echo "<br/> LATITUDE : $resultz[0]        $resultz[1]        $resultz[2]      $resultz[3]";
      
    }
$queryy = pg_query($db,$y) ;
     //echo $y;	
if (!$query) {}
  //echo "An error occurred";}

    if(pg_num_rows($query)>0)
    {
	$result = pg_fetch_array($query);
       // echo "<br/> LATITUDE : $result[0]";
      
    }
if (!$queryy) {}
  //echo "An error occurred";}

    if(pg_num_rows($queryy)>0)
    {
	$resulty = pg_fetch_array($queryy);
        //echo "<br/> LATITUDE : $resulty[0]   ";
      
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


//$i=0;

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
//var n ="<?php echo $num;?>";document.write(n);var flightPlanCoordinates=new Array();
//for (var i = 0; i < n-1; i++)
  //{  document.write("hello");}//flightPlanCoordinates[i]=new google.maps.LatLng("<?php echo $next[i+1][1];?>", "<?php echo $next[i+1][0];?>");
//document.write("<?php echo "hi";?>"); //	<?php echo $next[i+1][1];?>, <?php echo $next[i+1][0];?>	<?php $i=$i+1;?>			}
  var y= <?php echo json_encode($next); ?>;
//document.write(y[1][0]);
var n ="<?php echo $num;?>";var flightPlanCoordinates=new Array();
for (var i = 1; i < n-1; i++)
  {  //document.write("hello");
flightPlanCoordinates[i-1]=new google.maps.LatLng( y[i][1],y[i][0]);
}
   
function initialize()
{
var mapProp = {
  center:flightPlanCoordinates[0],
  zoom:10,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);


var flightPath=new google.maps.Polyline({
  path:flightPlanCoordinates,
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
      <h1>Road Ways <span> Track your routes</span></h1>
       </div>
    <div class="full">
      <div id="contact-form">
        <form id="contact-us" action="road.php">
          <div class="column-half">
            <div class="formblock">
              <span> Road Id </span><input type="text" name="Name" id="contactName" value="" class="txt requiredField" placeholder="">
            </div>
            
            <button name="submit" type="submit" class="subbutton" value="submit"></button><br /><br /><br /><br /><br />
<?php echo "<br/>  Road Id: $resultz[0]  <br />  Median Description :    $resultz[1]<br />  Route Type :      $resultz[2]<br /> Route Description :    $resultz[3]";
?>
          </div>
          <div class="column-half last">
           
            <p>When you enter a Road ID, it maps the road id in our database with the latitudes and longitudes in multiline string geometry and sends it off to google maps API which in turns maps the road route on the map :) </p>
<div id="googleMap" style="width:500px;height:380px;background:transparent;"></div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<footer><section class="footer">
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





