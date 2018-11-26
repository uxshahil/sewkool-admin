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

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$receipt = new Receipt($db);
$business = new Business($db);
$status = new Status($db);

// set ID property of job_card to be read
$receipt->id = $id;

// read the details of job_card to be read
$receipt->readOne();

// set ID property of business to be read
$business->id = $receipt->client_business_id;

// read the details of business to be read
$business->readOne();

// set navigation
$nav_title = "Job_Card";

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
  
</head>
<body>
 
    <!-- container -->
    <!-- <div class="container">

		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<address>
							<strong>SewKool</strong>
							<br>
							Unit 3.1
							<br>
							Arcadia Park
							<br>
							Commercial Road
							<br>
							East London
							<br>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<address>
							<strong>Email</strong>
							<br>
							office@sewkool.co.za
							<br>
						</address>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12"><span>Bill To:</span></div>
					<div class="col-md-12"><strong><?php echo $business->name; ?></strong></div>
					<div class="col-md-12"><?php echo $business->adr_location; ?></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
                    <div class="col-md-12"><span>Receipt Date:</span></div>
					<div class="col-md-12"><span><strong><?php  echo date("j F Y", strtotime($receipt->date_receipted)); ?></strong></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12"><span>Receipt No:</span></div>
					<div class="col-md-12"><strong><?php echo $receipt->id ?></strong></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12"><span><strong>RECEIPT</strong></span></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4"><span>PAYMENT METHOD</span></div>
					<div class="col-md-6"><span>REFERENCE</span></div>
					<div class="col-md-2"><span>AMOUNT</span></div>
				</div>
            </div>
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-4"><span><?php echo $receipt->payment_method_id ?></span></div>
					<div class="col-md-6"><span><?php echo $receipt->payment_reference ?></span></div>
					<div class="col-md-2"><span>R<?php echo $receipt->amount_receipted ?></span></div>
				</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2"><span>Total</span></div>
                    <div class="col-md-8"><span></span></div>
                    <div class="col-md-2"><span>R<?php echo number_format($receipt->amount_receipted, 2, ".", "") ?></span></div>
                </div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<span>NOTE:</span><br>
				<span>NOTE DESCRIPTION</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 text-center">
				<div class="span ">If you have any questions concerning this receipt, please contact</div>
				<div class="span">Mobile No: 082 333 4546</div>
				<div class="span">THANK YOU FOR YOUR BUSINESS</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<form action="generate_pdf.php" display="hidden" method="post">
					
					<?php $urlWrite = 'https://dev.themidastouch.co.za/sewkool-admin/receipt/print_receipt.php?id=' . $receipt->id; ?>
				
					<input type="hidden" name="url" value="<?php echo $urlWrite ?>">
					<input type="hidden" name="filename" value="<?php echo "RECEIPT-" .$receipt->id . ".pdf" ?>">
					<input type="submit" value="GENERATE PDF" class="do-not-print">
				</form>
			</div>
		</div>

	</div>
	/container -->

	<div class="page">

		<table class="blueTable">
			<tbody>
				<tr>
					<td colspan="8">
						<strong>SewKool</strong>
						<br>
						Unit 3.1
						<br>
						Arcadia Park
						<br>
						Commercial Road
						<br>
						East London						
					</td>
					<td colspan="4" style="text-align:right; display-inline:block">
						<img src="../libs/brand/logo.jpg" alt="SewKool Logo">
					</td>
				</tr>

				<tr></tr>

				<tr>
					<td colspan="12">
						<strong>Email</strong>
						<br>
						office@sewkool.co.za
					</td>
				</tr>

				<tr>
					<td colspan="4">
						<span>Bill To:</span> <br>
						<strong><?php echo $business->name; ?></strong> <br>
						<?php echo $business->adr_location; ?>
					</td>		
					<td colspan="4" style="text-align:right; vertical-align: top;">
						<span>Receipt Date:</span> <br>
						<span><strong><?php  echo date("j F Y", strtotime($receipt->date_receipted)); ?></strong> <br>
					</td>		
					<td colspan="4" style="text-align:right; vertical-align: top;">
						<span>Receipt No:</span> <br>
						<strong><?php echo $receipt->id ?></strong> <br>
					</td>
				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<span><strong>Receipt</strong></span>
					</td>
				</tr>

				<tr>
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
					<td colspan="3">
						<span><?php echo $receipt->payment_method_id ?></span>
					</td>
					<td colspan="7">
						<span><?php echo $receipt->payment_reference ?></span>
					</td>
					<td colspan="2" style="text-align:right;">
						<span>R<?php echo $receipt->amount_receipted ?></span>
					</td>
				</tr>

				<tr>
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2">
						<span>Total</span>
					</td>
					<td colspan="2" style="text-align:right;">
						<span>R<?php echo number_format($receipt->amount_receipted, 2, ".", "") ?></span>
					</td>
				</tr>

				<tr>
					<td colspan="12">
						<span>Note:</span><br>
						<span>Description</span>
					</td>
				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<span>If you have any questions concerning this receipt, please contact</span> <br>
						<span>Mobile No: 082 333 4546</span> <br>
						<span>THANK YOU FOR YOUR BUSINESS</span>
					</td>		
				</tr>

				<tr>
					<td colspan="12" style="text-align:right;">
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