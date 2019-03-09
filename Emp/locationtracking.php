<?php
if($_POST['submit']) 
{

$curl = curl_init();
$Loc=strip_tags($_POST);
$data = array("Location"=>$Loc);
$data_string = json_encode($data);     



echo($data_string);                                                                            
$ch = curl_init('https://bpoams-db094.firebaseio.com/.json');                                                               
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
if($result)
{
	$obj = json_decode($json);
	echo($obj->{"predictions"});
}
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<body>
	<form method="" action="locationtracking.php">
		<input type="text" name="loc">
		<input type="submit" name="submit">
	</form>
	</body>
</head>
</html>