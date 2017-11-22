<?php

include 'connection.php';
session_start();

$query = $dbConn->query("SELECT * FROM tbl_transactions INNER JOIN tbl_lessee ON tbl_transactions.lessee_id = tbl_lessee.lessee_id where tbl_transactions.bill_id = '".$_GET['id']."' ");
$row = $query->fetch(PDO::FETCH_ASSOC);

if ($query->rowCount() == 0) 
{
 header("location:lessee.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>BILLING STATEMENT</title>
</head>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<button onclick="printContent('div1')">PRINT </button><br>

<div id="div1">
<center>
<body style="font-family:Lucida Console;font-size:12px;" >

<?php
	
	$get = $dbConn->query("SELECT * FROM tbl_properties where id = '".$row['property_name']."' ");
	$display = $get->fetch(PDO::FETCH_ASSOC);
?>

	<img src="images/<?php echo $display['property_pic']?>" height="100px"><br>
	<table cellspacing="2px" width="500px">
		<tr>
			<td>
	Bill NO: <font color="red"><b><?php echo $_GET['id'];?></b></font></td>
		</tr>
		<tr>
			<td colspan="2">STATEMENT OF ACCOUNT for the month of</td>
			<td colspan="2"><b><?php echo $row['last_statement']; ?></b></td>
		</tr>
		<tr>
			<td>LESSEE:</td>
			<td><b><?php echo $row['firstname'].' '.$row['lastname'] ; ?></b></td>
			<td>UNIT:</td>
			<td><b><?php echo $row['unit']; ?></b></td>
		</tr>
		
			
		
		<tr>
			<td colspan="2">Advance Rental for the period:</td>
			<td colspan="2"><b>PHP <?php echo number_format($row['rental_fee'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">Past Due Amount:</td>
			<td colspan="2"><b>PHP <?php echo number_format($row['past_due'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">( <?php echo $row['interest_rate'] * 100; ?> % Interest on Past Due accounts)</td>
			<td colspan="2"><b><?php echo number_format($row['interest'],2); ?></b></td>
		</tr>
	</table>

	
	

	<h3 >UTILITY CONSUMPTIONS</h3>

	<table style=" position: relative;
    left: 0px;" border="1" cellspacing="0" cellpadding="10px" width="800px">
		<tr>
			<td colspan="2" width="400px">Water (Meter Reading)</td>
			<td></td>
			<td colspan="2" width="400px">Electric (Meter Reading)</td>
		</tr>
		<tr>
			<td><b>START</b></td>
			<td><b>END</b></td>
			<td></td>
			<td><b>START</b></td>
			<TD><b>END</b></TD>
		</tr>
		<tr>
			<td><?php echo $row['start_water']; ?></td>
			<td><?php echo $row['end_water']; ?></td>
			<td></td>
			<td><?php echo $row['start_electric']; ?></td>
			<TD><?php echo $row['end_electric']; ?></TD>
		</tr>
		<tr>
			<td colspan="2">Cubic Meter Consumed: <b><?php echo $row['cubic_consumed']; ?></b></td>
			<td></td>
			<td colspan="2">No. of Kilowatt hour consumed: <b><?php echo $row['electric_consumed']; ?></b></td>
		</tr>
		<tr>
			<td colspan="2">MCWD rate X <b><?php echo number_format($row['mcwd_rate'],2); ?></b></td>
			<td></td>
			<td colspan="2">Veco Rate X <b><?php echo number_format($row['veco_rate'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">Water Amount Due = <b><?php echo number_format($row['water_due'],2); ?></b></td>
			<td></td>
			<td colspan="2">Electric Amount Due = <b><?php echo number_format($row['electric_due'],2); ?></b></td>
		</tr>

	</table><br>
	
	<b>Total Amount Due and Payable</b> <span style="margin-left:15em;"><b>PHP <?php echo number_format($row['total_amount'],2); ?> </b> </span> <br><br>
	<span style="margin-left:-14em;">Prepared by :</span> <b><span style="margin-left:1em;"><?php echo $row['prepare_by']; ?></span></b> <span style="position: relative;
    left: 100px;">Date Printed:</span> <b style=" position: relative;
    left: 140px;"><?php echo $row['date_printed']; ?></b><br><br>
    <div style=" position: relative;
    left: -200px;top:-5px;">
		<table border="0" cellspacing="0">
		<tr>
		<td><b>Please deposit your payment through:</b><br>
	EASTWEST BANK<BR>
	Account Name: Rhomell Hao Cuenco<br>
	Account Number: 22401002328<br>
	Cellphone number: (0925)500-9304	
			</td>
			</tr>
		</table>
	</div>

  
	<div style=" position: relative;
    left: 170px;top:-60px;">
		<table border="1" cellspacing="0">
		<tr>
		<td>For monitoring purposes, <br>please send us a copy of your transaction slip.<br>
			Thank you for prompt payment.
			</td>
			</tr>
		</table>
	(Tenant's Copy)
	</div>
	<hr>
<br>
<br>
<br>
<br>
	<table cellspacing="2px" width="500px;">
		<tr>
			<td>
	Bill NO: <font color="red"><b><?php echo $_GET['id'];?></b></font></td>
		</tr>
		<tr>
			<td colspan="2">STATEMENT OF ACCOUNT for the month of</td>
			<td colspan="2"><b><?php echo $row['last_statement']; ?></b></td>
		</tr>
		<tr>
			<td>LESSEE:</td>
			<td><b><?php echo $row['firstname'].' '.$row['lastname'] ; ?></b></td>
			<td>UNIT:</td>
			<td><b><?php echo $row['unit']; ?></b></td>
		</tr>
		
			
		
		<tr>
			<td colspan="2">Advance Rental for the period:</td>
			<td colspan="2"><b>PHP <?php echo number_format($row['rental_fee'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">Past Due Amount:</td>
			<td colspan="2"><b>PHP <?php echo number_format($row['past_due'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">( <?php echo $row['interest_rate'] * 100; ?> % Interest on Past Due accounts)</td>
			<td colspan="2"><b><?php echo number_format($row['interest'],2); ?></b></td>
		</tr>
	</table>

	
	

	<h3 >UTILITY CONSUMPTIONS</h3>

	<table style=" position: relative;
    left: 0px;" border="1" cellspacing="0" cellpadding="10px" width="800px">
		<tr>
			<td colspan="2" width="400px">Water (Meter Reading)</td>
			<td></td>
			<td colspan="2" width="400px">Electric (Meter Reading)</td>
		</tr>
		<tr>
			<td><b>START</b></td>
			<td><b>END</b></td>
			<td></td>
			<td><b>START</b></td>
			<TD><b>END</b></TD>
		</tr>
		<tr>
			<td><?php echo $row['start_water']; ?></td>
			<td><?php echo $row['end_water']; ?></td>
			<td></td>
			<td><?php echo $row['start_electric']; ?></td>
			<TD><?php echo $row['end_electric']; ?></TD>
		</tr>
		<tr>
			<td colspan="2">Cubic Meter Consumed: <b><?php echo $row['cubic_consumed']; ?></b></td>
			<td></td>
			<td colspan="2">No. of Kilowatt hour consumed: <b><?php echo $row['electric_consumed']; ?></b></td>
		</tr>
		<tr>
			<td colspan="2">MCWD rate X <b><?php echo number_format($row['mcwd_rate'],2); ?></b></td>
			<td></td>
			<td colspan="2">Veco Rate X <b><?php echo number_format($row['veco_rate'],2); ?></b></td>
		</tr>
		<tr>
			<td colspan="2">Water Amount Due  = <b><?php echo number_format($row['water_due'],2); ?></b></td>
			<td></td>
			<td colspan="2">Electric Amount Due = <b><?php echo number_format($row['electric_due'],2); ?></b></td>
		</tr>

	</table><br>
	
	<b>Total Amount Due and Payable</b> <span style="margin-left:15em;"><b>PHP <?php echo number_format($row['total_amount'],2); ?> </b> </span> <br><br>
	<span style="margin-left:-14em;">Prepared by :</span> <b><span style="margin-left:1em;"><?php echo $row['prepare_by']; ?></span></b> <span style="position: relative;
    left: 100px;">Date Printed:</span> <b style=" position: relative;
    left: 140px;"><?php echo $row['date_printed']; ?></b><br><br>
    

  
	<div style=" position: relative;
    left: 170px;top:-12px;">
	
		
	(Royal Crowne's Copy)
	</div>
</body>
</center>

	</div>
</html>