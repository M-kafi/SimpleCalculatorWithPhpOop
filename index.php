<?php
require_once'classes/init.php';
session_start();







 
$_SESSION['numbers'] = isset( $_SESSION['numbers'] )?$_SESSION['numbers']:[];
$valuesInserted = $_SESSION['numbers'];

$cal = isset( $_SESSION['cal'] ) ? $_SESSION['cal'] : new Calculator;
$result = ($cal->getResult() !=='NULL' )? $cal->getResult() : 0;


$numberInserted = isset( $_GET['newInput'] )? trim( $_GET['newInput']) : 0;
if( $numberInserted !== '' )
{


if ( isset( $_GET['addition'] ) )
{
    
	selectOperation();
	$valuesInserted[] = [ 'operation'=> '+', 'number'=> $numberInserted ];	
    
	
	
	$_SESSION['numbers']=$valuesInserted;
	$_SESSION['cal'] = $cal;
	
		
	
}
elseif( isset( $_GET['subtraction'] ) )
{
	
    $numberInserted = $_GET['newInput'];

	selectOperation();
	$valuesInserted[] = [ 'operation'=> '-', 'number'=> $numberInserted ];	

	
	$_SESSION['numbers']=$valuesInserted;
  	$_SESSION['cal'] = $cal;
	
}
elseif( isset( $_GET['multiplication'] ) )
{
	
    $numberInserted = $_GET['newInput'];
	
	selectOperation();
	$valuesInserted[] = [ 'operation'=> '*', 'number'=> $numberInserted ];	
	
	$_SESSION['numbers']=$valuesInserted;
	$_SESSION['cal'] = $cal;
}
elseif( isset( $_GET['division'] ) )
{
	
    $numberInserted = $_GET['newInput'];
	
	selectOperation();
	$valuesInserted[] = [ 'operation'=> '/', 'number'=> $numberInserted ];	
	
	$_SESSION['numbers']=$valuesInserted;
	$_SESSION['cal'] = $cal;
}
elseif( isset( $_GET['results'] ) )
{
	
   selectOperation();
   $valuesInserted[] = [ 'operation'=> '', 'number'=> $numberInserted ];	
	
	$_SESSION['numbers']=$valuesInserted;
	
}


}


if( isset( $_GET['delete'] )  )
{
	session_destroy();
	header( 'Location: index.php' );
}




if( isset( $_GET['results'] ) )
{
	session_destroy();
	
}



$result = $cal->getResult();


//-----Functions------



function selectOperation()
{
	global $numberInserted, $valuesInserted, $cal  ;
	
	
	
	 $index = ( count( $valuesInserted ) - 1  >= 0 ) ? $valuesInserted[ count( $valuesInserted ) - 1 ] : NULL ;
	 
	 
	if ( $index !== NULL )
	{
	
	$lastOperation =  $valuesInserted[ count( $valuesInserted ) - 1 ]['operation'];
	}
	else
	{
		$lastOperation = '+';
	}
	
	switch( true )
	{
		case $lastOperation == '+':
		$cal->setOperation( new Adder );
	    $cal->calculate( $numberInserted );
		
		
		break;
	
		case $lastOperation == '-':
		$cal->setOperation( new Subtractor );
	    $cal->calculate( $numberInserted );
		
		
		break;
		
		case $lastOperation == '*':
		$cal->setOperation( new Multiplier );
	    $cal->calculate( $numberInserted );
		
		
		break;
		
		case $lastOperation == '/':
		$cal->setOperation( new Divider );
	    $cal->calculate( $numberInserted );
		
		
		break;
	
	
		
		
	}
	
	
	
	
	
	
	
}



?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" >
	<title> Simple Calculator With PHP OOP </title>
	<!-- Done by MOhamad Abdul Kafi -->

	
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>


<div class="container  ">

<h1>Simple Calculator with PHP OOP and functions</h1>


<div class="row col-md-5 ">

<?php  foreach( $valuesInserted as $row )
{ 

		
		echo $row['number']. ' ' . $row['operation'].' ' ;
	
	
 } ?>
</div>






<form action="index.php" method="GET" >

<div class="row">
<div class="col-md-5" ><h3>Insert Numbers:</h3></div>
</div>

<div class="row">
<input class="col-md-5"  type="number" name="newInput" >
</div>

<br>
<div class="row col-md-5 ">

<input class="col" type="submit" name="addition" value="+">
<input class="col" type="submit" name="subtraction" value="-">
<input class="col" type="submit" name="multiplication" value="*">
<input class="col" type="submit" name="division" value="/">
<input class="col" type="submit" name="delete" value="c">
<input class="col" type="submit" name="results" value="=">

</div>
</form>

<div class="row">
<div class="col-md-5" ><h3> Result:</h3> </div>
</div>

<div class="row">
<input class="col-md-5"  type="text" name="result" value="<?php echo $result;?>"   >
</div>

 
</div>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>


</html>