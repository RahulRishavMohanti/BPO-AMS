
<?
if($_POST['submit']) 
{

$MaritalDesc=strip_tags($_POST['MaritalDesc']);
$CitizenDesc=strip_tags($_POST['CitizenDesc']);
$RaceDesc=strip_tags($_POST['RaceDesc']);
$DaysEmp=strip_tags($_POST['DaysEmp']);
$Position=strip_tags($_POST['Position']);
$Manager=strip_tags($_POST['Manager']);
$EmpSource=strip_tags($_POST['EmpSource']);
$MonthOfHire=strip_tags($_POST['MonthOfHire']);
$YearOfHire=strip_tags($_POST['YearOfHire']);
$MonthOfTermination=strip_tags($_POST['MonthOfTermination']);
$YearOfTermination=strip_tags($_POST['YearOfTermination']);


$data = array(array("Age"=>1, "Pay Rate"=>1, "Zip"=>1, "Sex"=>1, "MaritalDesc"=>$MaritalDesc, "CitizenDesc"=>$CitizenDesc,
       "Hispanic/Latino"=>1, "RaceDesc"=>$RaceDesc,"Days Employed"=>$DaysEmp, "Employment Status"=>1, "Department"=>1, "Position"=>$Position,
       "Manager Name"=>$Manager, "Employee Source"=>$EmpSource,"Month of Hire"=>$MonthOfHire,"Day of Hire"=>1,"Year of Hire"=>$YearOfHire,"Month of Termination"=>$MonthOfTermination,"Day of Termination"=>1,"Year of Termination"=>$YearOfTermination, "Performance Score"=>1));
$data_string = json_encode($data);     
//$data_string = json_encode($data_string);
echo($data_string);                                                                            
$ch = curl_init('http://0.0.0.0:5000/predict');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
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
	<title>Employee Perf</title>
	<link rel="stylesheet" href="/LoginApp/public/css/bootstrap.css" />
	<link rel="stylesheet" href="/LoginApp/public/css/style2.css" />
<style type="text/css">
td,th{
	text-align: center;
}
  #myProgress {
  margin-top: 1%;
  width: 100%;
  background-color: #ddd;
}

#myBar {
	margin-top: 1%;
  width: 0%;
  height: 30px;
  background-color: #4CAF50;
}
</style>
</head>
<body>
  <div class="headery">
    <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="/LoginApp/logout.php">Logout</a></li>
          </ul>
    </nav>
    <img style="float: left;" height="50" src="/LoginApp/public/logo.jpg">
    </div>

<div class="container">
<h2  class="page-header">Check</h2>
<div class="cardy">
			<form method="post" action="/LoginApp/Emp/HR.php">
		  		<div class="form-group">
		  	    	<label>Marital Description</label>
					<select class="form-control" name = "MaritalDesc">
					  <option value="Single">Single</option>
					  <option value="Married">Married</option>

					  <option value="Divorced">Divorced</option>
					  <option value="Separated">Separated</option>
					  <option value="Widowed">Widowed</option>
					</select>
				</div>
				<div class="form-group">
		  	    	<label>Citizen Description</label>
					<select class="form-control" name = "CitizenDesc">
					  <option value="US Citizen">US Citizen</option>
					  <option value="Eligible NonCitizen">Eligible NonCitizen</option>
					  <option value="Non-Citizen">Non-Citizen</option>
					</select>
				</div>
				<div class="form-group">
		  	    	<label>Race Description</label>
					<select class="form-control" name = "RaceDesc">
					  <option value="White">White</option>
					  <option value="Black or African American">Black or African American</option>
					  <option value="Asian">Asian</option>
					  <option value="Two or more races">Two or more races</option>
					  <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
					  <option value="Hispanic">Hispanic</option>
					</select>
				</div>
				<div class="form-group">
		  	    	<label>Days Employed</label>
					<input type="number" name="DaysEmp">
				</div>
				<div class="form-group">
		  	    	<label>Position</label>
					<select class="form-control" id="Position" name = "Position">
					</select>				
				</div>
				<div class="form-group">
		  	    	<label>Manager</label>
					<select class="form-control" id="Manager" name = "Manager">
					</select>	
				</div>
				<div class="form-group">
		  	    	<label>Employee Source</label>
					<select class="form-control" id="EmpSource" name = "EmpSource">
					</select>					
				</div>

				<div class="form-group">
		  	    	<label>Month of Hire</label>
					<select class="form-control" name = "MonthOfHire">
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					</select>
				</div>
				<div class="form-group">
		  	    	<label>Year of Hire</label>
					<select class="form-control" name = "YearOfHire">
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
					</select>
				</div>
				<div class="form-group">
		  	    	<label>Month of Termination</label>
					<select class="form-control" name = "MonthOfTermination">
											  <option value="0">0</option>

					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					</select>

				</div>
				<div class="form-group">
		  	    	<label>Year of Termination</label>
					<select class="form-control" name = "YearOfTermination">
						<option value="1001">N/A</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
					</select>
				</div>
				<input type="submit" name="submit" value="Predict">
			</form>
			<h2>
				<?php 
				//echo($result);
				if($result[28]=='1')
					echo("Eligible");
				else if($result[28]=='0')
					echo("Ineligible");
				?>
			</h2>
</div>
</div>
      <div class="footer">
        <p>&copy; BPO Convergence Ltd.</p>
      </div>

</body>
<script>
var PositionsArray = new Array('Accountant I', 'Administrative Assistant',
       'Shared Services Manager', 'Sr. Accountant', 'President & CEO',
       'CIO', 'Database Administrator', 'IT Director', 'IT Manager - DB',
       'IT Manager - Infra', 'IT Manager - Support', 'IT Support',
       'Network Engineer', 'Sr. DBA', 'Sr. Network Engineer',
       'Director of Operations', 'Production Manager',
       'Production Technician I', 'Production Technician II',
       'Area Sales Manager', 'Director of Sales', 'Sales Manager',
       'Software Engineer', 'Software Engineering Manager', 'BI Director',
       'Senior BI Developer', 'BI Developer', 'Data Architect');

var ManagerArray= new Array('Brandon R. LeBlanc', 'Janet King', 'Board of Directors',
       'Simon Roup', 'Jennifer Zamora', 'Eric Dougall', 'Peter Monroe',
       'Michael Albert', 'Elijiah Gray', 'Webster Butler', 'Amy Dunn',
       'Ketsia Liebig', 'Brannon Miller', 'David Stanley',
       'Kissy Sullivan', 'Kelley Spirea', 'Lynn Daneault', 'John Smith',
       'Debra Houlihan', 'Alex Sweetwater', 'Brian Champaigne');
    
var SourceArray= new Array('Diversity Job Fair', 'Website Banner Ads', 'Internet Search',
       'Pay Per Click - Google', 'Monster.com', 'Other',
       'Employee Referral', 'Search Engine - Google Bing Yahoo',
       'Glassdoor', 'Vendor Referral', 'Professional Society',
       'Information Session', 'Company Intranet - Partner',
       'On-campus Recruiting', 'Billboard', 'MBTA ads', 'Word of Mouth',
       'Social Networks - Facebook Twitter etc', 'On-line Web application',
       'Newspager/Magazine', 'Pay Per Click', 'Careerbuilder', 'Indeed');

selectEl = document.getElementById('Position');
selectMa = document.getElementById('Manager');
selectSa = document.getElementById('EmpSource');

for(var i = 0; i < PositionsArray.length; i++){
    selectEl.options.add(new Option(PositionsArray[i], PositionsArray[i]));
}         
for(var i = 0; i < ManagerArray.length; i++){
    selectMa.options.add(new Option(ManagerArray[i], ManagerArray[i]));
}  
for(var i = 0; i < SourceArray.length; i++){
    selectSa.options.add(new Option(SourceArray[i], SourceArray[i]));
}     
</script>
</html>