<?php

// get ID of the Job Card to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/business.php';
include_once '../objects/invoice.php';
include_once '../objects/line_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);
$line_item= new Line_Item($db);

// set ID property of Job Card to be read
$job_card->id = $id;
$invoice->job_card_id = $id;
$line_item->job_card_id = $id;

// read the details of Job Card to be read
$job_card->readOne();
$invoice->readJobCardItems();

// read the details of the Job Card line_items
$stmt = $line_item->readJobCardItems();

// set ID property of business to be read
$business->id = $job_card->client_business_id;

// read the details of business to be read
$business->readOne();

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Print Job Card";
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
 
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../libs/css/print-screen.css">

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
						<span style="font-size: 15px; letter-spacing: 3px;"><strong>JOB CARD</strong></span>
						<span style="max-width=150px;"><?php echo '<svg id="barcode"><script>JsBarcode("#barcode", "'.$job_card->id.'", {background: "transparent"});</script></svg>' ?></span> 
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
						<span>Please make payable to:</span> <br>
						<span>Invoice No:</span> <br>
						<span>Due Date:</span> <br>
						<span>Invoiced On:</span> <br>
						<span>Client Order No:</span> 
					</td>		

					<td colspan="3" style="border-bottom: 1px solid #EAEAEA; background: #FCFCFC; vertical-align: top; padding: inherit;">
						<strong>Sew Kool CC</strong> <br>
						<strong><?php echo $job_card->id ?></strong> <br>
						<strong><?php  echo date("j F Y", strtotime($invoice->date_due)); ?></strong> <br>
						<strong><?php  echo date("j F Y", strtotime($job_card->created_date)); ?></strong> <br>
						<strong><?php echo $job_card->client_invoice_number ?></strong> 
					</td>

				</tr>

				<tr style="border-bottom: 1px solid #EAEAEA; height:50px;">
					<td colspan="3"></td>
					<td colspan="2" style="text-align:center;">Quantity</td>
					<td colspan="3">Description</td>
					<td colspan="2" style="text-align:right;">Unit Price</td>
					<td colspan="2" style="text-align:right; padding-right:15px;">Price</td>
				</tr>

				<?php

				// check database for existing temporary line items
				$total = $line_item->countAll();
				$sub_total = 0;

				if($total>0){
					$item_count = 1;
					$line_total = 0;
					$sub_total = 0;

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);

						// header for item
						echo "<tr>";
							echo "<td colspan='12' style='padding-left: 10%; border-top: 1px solid #EAEAEA; border-bottom: 1px solid #EAEAEA; background: #FCFCFC; letter-spacing: 1px; text-transform: uppercase; font-weight: bold;'>$item</td>";
						echo "</tr>";
						
						echo "<tr>";
							echo "<td rowspan='4' colspan='3'>";
								echo $artwork_logo ? "<img src='../images/{$artwork_logo}' style='width:100%;' />" : "No image found.";
							echo "</td>";

							// embroidery calculation
							echo "<td colspan='2' style='text-align:center; border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>{$item_qty}</span>";
							echo "</td>";

							echo "<td colspan='3' style='border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>Embroidery</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>R". number_format($price_embroidery, 2) ."</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>R". number_format($price_embroidery * $item_qty, 2) ."</span>";
							echo "</td>";
						echo "</tr>";
						
						$line_total += $price_embroidery * $item_qty;

						// artwork calculation
						echo "<tr>";
							echo "<td colspan='2' style='text-align:center; border-bottom: 1px solid #EAEAEA;'>";
								if($price_artwork > 0) {echo "<span>1</span>";} else {echo "<span>0</span>";};
							echo "</td>";

							echo "<td colspan='3' style='border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>Artwork</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>R{$price_artwork}</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								if($price_artwork > 0) {echo "<span>R{$price_artwork}</span>";} else {echo "<span>R0.00</span>";}; 
							echo "</td>";
						echo "</tr>";

						if($price_artwork > 0) {$line_total += $price_artwork;} 
						
						// setup calculation
						echo "<tr>";
							echo "<td colspan='2' style='text-align:center; border-bottom: 1px solid #EAEAEA;'>";
								if($price_setup > 0) {echo "<span>1</span>";} else {echo "<span>0</span>";};
							echo "</td>";

							echo "<td colspan='3' style='border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>Setup</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								echo "<span>R{$price_setup}</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right; border-bottom: 1px solid #EAEAEA;'>";
								if($price_setup > 0) {echo "<span>R{$price_setup}</span>";} else {echo "<span>R0.00</span>";}; 
							echo "</td>";
						echo "</tr>";

						if($price_setup > 0) {$line_total += $price_setup;} 
						
						echo "<tr>";

							echo "<td colspan='2'>";
								echo "";
							echo "</td>";

							echo "<td colspan='5' style='font-weight:bold; border-bottom: 1px solid #EAEAEA;'>";
								echo "Line Total";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right; font-weight:bold; border-bottom: 1px solid #EAEAEA;'>";
								echo "R". number_format($line_total, 2);
							echo "</td>";
						echo "</tr>";

						$item_count += 1;
						$sub_total += $line_total;
						$line_total = 0;
					}
				}   
				?>

				<tr>
					<td colspan="12" height="17px;"></td>
				</tr>

				<tr>
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2" style="font-weight:bold; border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span>Sub Total</span>
					</td>
					<td colspan="2" style="text-align:right; font-weight:bold; border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span>R<?php echo number_format($sub_total, 2) ?></span>
					</td>
				</tr>

				<tr>
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2" style="font-weight:bold; border-bottom: 1px solid #EAEAEA;">
						<span>Vat</span>
					</td>
					<td colspan="2" style="text-align:right; font-weight:bold; border-bottom: 1px solid #EAEAEA;">
						<span>R<?php echo number_format($sub_total * 0.15, 2) ?></span></div>
					</td>
				</tr>

				<tr>
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2" style="font-weight:bold; border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span>Total</span>
					</td>
					<td colspan="2" style="text-align:right; font-weight:bold; border-bottom: 1px solid #EAEAEA; background: #FCFCFC;">
						<span>R<?php echo number_format($sub_total * 1.15, 2) ?></span></div>
					</td>
				</tr>

				<tr>
					<td colspan="12" height="17px;"></td>
				</tr>

				<tr style="padding: 17px; line-height: 20px; background: #FCFCFC; padding-bottom: 0px;">
					<td colspan="12" style="vertical-align: bottom; padding: inherit; line-height: inherit;">
						<span><strong>Banking Details</strong></span><br>
					</td>
				</tr>

				<tr style="padding: 17px; line-height: 20px; background: #FCFCFC;">
					<td colspan="3" style="vertical-align: top; padding: inherit; line-height: inherit;">
						<span>Acc Name:</span> <br>
						<span>Bank:</span> <br>
						<span>Branch:</span> 
					</td>
					<td colspan="3" style="vertical-align: top; padding: inherit; line-height: inherit; font-weight: bold;">
						<span>Sew Kool CC</span> <br>
						<span>FNB</span> <br>
						<span>Vincent Park</span> 
					</td>
					<td colspan="3" style="vertical-align: bottom; padding: inherit; line-height: inherit;">
						<span>Branch Code:</span> <br>
						<span>Acc No:</span> <br>
						<span>Ref:</span>
					</td>
					<td colspan="3" style="vertical-align: bottom; padding: inherit; line-height: inherit; font-weight: bold;">
						<span>211021</span> <br>
						<span>62370730973</span> <br>
						<span><?php echo $job_card->id?></span>
					</td>
				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<form action="generate_pdf.php" display="hidden" method="post">
							<?php $urlWrite = 'https://dev.themidastouch.co.za/sewkool-admin/job_card_process/print_job_card.php?id=' . $job_card->id; ?>
						
							<input type="hidden" name="url" value="<?php echo $urlWrite ?>">
							<input type="hidden" name="filename" value="<?php echo "JOBCARD-" .$job_card->id . ".pdf" ?>">
							<input type="hidden" value="GENERATE PDF" class="do-not-print">
						</form>
					</td>
				</tr>

			</tbody>
		</table>

	</div>
    
</body>
</html>