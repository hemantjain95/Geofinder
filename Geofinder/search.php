<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/

// Credentials
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

/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a method = "GET" action = "city.php">';
$html .= '<h3  style="color:white;font-size:18px;">nameString</h3>';

$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
//$search_string = $db->real_escape_string($search_string);
//$search_string = 'i';
// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = "SELECT distinct city FROM testing WHERE city LIKE '".$search_string."%'";
//echo $query;
	// Do Search
      $i=0;
	$queryz = pg_query($db,$query);
	while($results = pg_fetch_array($queryz)) {
		$result_array[$i] = $results[0];$i++;
//echo $results[0];
	}

	// Check If We Have Results
	if (isset($result_array)) {
		for ($j=0;$j<$i;$j++) {

			// Format Output Strings And Hightlight Matches
			//$display_function = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $queryz['function']);
			//$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $queryz['city']);
			//$display_url = 'http://php.net/manual-lookup.php?pattern='.urlencode($result['function']).'&lang=en';
                        $display_name=$result_array[$j];
			// Insert Name
			$output = str_replace('nameString', $display_name, $html);

			// Insert Function
			//$output = str_replace('functionString', $display_function, $output);

			// Insert URL
			//$output = str_replace('urlString', $display_url, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		//$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>No Results Found.</b>', $output);
		//$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
	}
}


/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$tutorial_db->query($query);
}
*/
?>
