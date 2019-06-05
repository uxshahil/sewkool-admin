<?php
// get ID of the job_card to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/receipt.php';
include_once '../objects/business.php';
include_once '../objects/status.php';
include_once '../objects/lookup.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$receipt = new Receipt($db);
$business = new Business($db);
$status = new Status($db);
$lookup = new Lookup($db);

// set ID property of job_card to be read
$receipt->id = $id;

// read the details of job_card to be read
$receipt->readOne();
$lookup->id = $receipt->payment_method_id;
$lookup->readName();

// set ID property of business to be read
$business->id = $receipt->client_business_id;

// read the details of business to be read
$business->readOne();

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Receipt";
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
 
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="../libs/vendor/css/bootstrap-4.1.3.min.css" type="text/css" media="screen" > -->
	<link rel="stylesheet" href="../libs/css/print-screen.css" type="text/css" media="screen" >

	<!-- Print 
	<link rel="stylesheet" href="../libs/css/print.css" type="text/css" media="print" /> -->

    <!-- jQuery library -->
    <script src="../libs/vendor/js/jquery-3.3.1.min.js"></script>
    
    <!-- Popper JS -->
    <script src="../libs/vendor/js/popper-1.14.3.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="../libs/vendor/js/bootstrap-4.1.3.min.js"></script>
    
    <!-- bootbox library -->
	<script src="../libs/vendor/js/bootbox-4.4.0.min.js"></script>
	
	<!-- link to barcode js library -->
	<script src="../libs/vendor/js/JsBarcode.all.min.js"></script>
  
</head>
<body>

	<div class="page">

		<table class="blueTable">
			<tbody>
				<tr>
					<td colspan="3">
						<strong>SewKool</strong>
						<br>
						Unit 3.1
						<br>
						Arcadia Park
						<br>
						Commercial Road
						<br>
						East London
						<br><br>
						<strong>Contact</strong>
						<br>
						043 743 4712
						<br>
						office@sewkool.co.za	
					</td>
					<td colspan="6" style="text-align:center; display-inline:block; ">
						<img src="../libs/brand/logo.jpg" alt="SewKool Logo" style="vertical-align: top;"> 
						<br>
						<br>
						<span><strong>Vat: </strong>4620226201</span> 
						<br>
						<span><strong>Reg: </strong> 2005 / 103 541 / 23</span>
					</td>

					<td colspan="3" style="text-align:center;">
						<span style="font-size: 15px; letter-spacing: 3px;"><strong>RECEIPT</strong></span>
						<span style="max-width=150px;"><?php echo '<svg id="barcode"><script>JsBarcode("#barcode", "'.$receipt->id.'", {background: "transparent"});</script></svg>' ?></span> 
					</td>
				</tr>

				<tr style="padding: 17px; line-height: 20px;">
					<td colspan="2" style="border-bottom: 1px solid #EAEAEA; vertical-align: top; background: #FCFCFC; padding: inherit;">
						<span>Bill To:</span> <br>
						<span>Reg:</span> <br>
						<span>Vat:</span> <br>
						<span>Address:</span> <br>
					</td>	

					<td colspan="4" style="border-right: 1px solid #EAEAEA; border-bottom: 1px solid #EAEAEA; vertical-align: top; background: #FCFCFC; padding: inherit;">
						<strong><?php echo $business->name; ?></strong> <br>
						<strong><?php echo $business->company_registration; ?></strong> <br>
						<strong><?php echo $business->vat; ?></strong> <br>
						<strong><?php echo $business->adr_location; ?></strong>
					</td>	

					<td colspan="3" style="border-bottom: 1px solid #EAEAEA; background: #FCFCFC; vertical-align: top; padding: inherit; padding-right: 0px;">
						<span>Receipt Date:</span> <br>
					</td>		

					<td colspan="3" style="border-bottom: 1px solid #EAEAEA; background: #FCFCFC; vertical-align: top; padding: inherit;">
						<span><strong><?php  echo date("j F Y", strtotime($receipt->date_receipted)); ?></strong> <br>
					</td>

				</tr>

				<tr style="border-bottom: 1px solid #EAEAEA; height:50px;">
					<td colspan="3">
						<span>Payment Method</span>
					</td>
					<td colspan="7">
						<span>Reference</span>
					</td>
					<td colspan="2" style="text-align:right;">
						<span>Amount</span>
					</td>
				</tr>

				<tr>
					<td colspan="3" style="border-bottom: 1px solid #EAEAEA;">
						<span><?php echo $lookup->title ?></span>
					</td>
					<td colspan="7" style="border-bottom: 1px solid #EAEAEA;">
						<span><?php echo $receipt->payment_reference ?></span>
					</td>
					<td colspan="2" style="text-align:right; border-bottom: 1px solid #EAEAEA;">
						<span>R<?php echo $receipt->amount_receipted ?></span>
					</td>
				</tr>

				<tr>
					<td colspan="8" >
						<span></span>
					</td>
					<td colspan="2" style="border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span><strong>Total</strong></span>
					</td>
					<td colspan="2" style="text-align:right; border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span><strong>R<?php echo number_format($receipt->amount_receipted, 2, ".", "") ?></strong></span>
					</td>
				</tr>

				<tr>
					<td colspan="12" height="17px;"></td>
				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<span>Thank you for your business...</span>
					</td>		
				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<form action="generate_pdf.php" display="hidden" method="post">
							<?php $urlWrite = 'https://dev.themidastouch.co.za/sewkool-admin/receipt/print_receipt.php?id=' . $receipt->id; ?>
						
							<input type="hidden" name="url" value="<?php echo $urlWrite ?>">
							<input type="hidden" name="filename" value="<?php echo "RECEIPT-" .$receipt->id . ".pdf" ?>">
							<input type="submit" value="GENERATE PDF" class="do-not-print">
						</form>
					</td>
				</tr>

			</tbody>
		</table>

	</div>

</body>
</html>