<?php
// get ID of the job_card to be read
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

// set ID property of job_card to be read
$job_card->id = $id;
$invoice->job_card_id = $id;
$line_item->job_card_id = $id;

// read the details of job_card to be read
$job_card->readOne();
$invoice->readJobCardItems();

// read the details of the job_card line_items
$stmt = $line_item->readJobCardItems();

// set ID property of business to be read
$business->id = $job_card->client_business_id;

// read the details of business to be read
$business->readOne();

// set navigation
$nav_title = "Invoice";

// set page headers
$page_title = "Print Invoice";
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
					<td colspan="3">
						<span>Bill To:</span> <br>
						<strong><?php echo $business->name; ?></strong> <br>
						<?php echo $business->adr_location; ?>
					</td>		

					<td colspan="3" style="text-align:right;">
						<span>Please make payable to:</span> <br>
						<span>Invoice No:</span> <br>
						<span>Due Date:</span> <br>
						<span>Invoiced On:</span> 
					</td>		

					<td colspan="3" style="text-align:left;">
						<strong>SewKool</strong> <br>
						<strong><?php echo $job_card->id ?></strong> <br>
						<strong><?php  echo date("j F Y", strtotime($invoice->date_due)); ?></strong> <br>
						<strong><?php  echo date("j F Y", strtotime($job_card->created_date)); ?></strong>
					</td>

					<td colspan="3" style="text-align:center;">
						<span><?php echo '<svg id="barcode"><script>JsBarcode("#barcode", "'.$job_card->id.'");</script></svg>' ?></span> 
					</td>

				</tr>

				<tr>
					<td colspan="12" style="text-align:center;">
						<span><strong>Invoice</strong></span>
					</td>
				</tr>

				<tr>
					<td colspan="3"></td>
					<td colspan="2" style="text-align:center;">Quantity</td>
					<td colspan="3">Description</td>
					<td colspan="2" style="text-align:right;">Unit Price</td>
					<td colspan="2" style="text-align:right;">Price</td>
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
							echo "<td colspan='3' style='text-align:center;'>$item</td>";
						echo "</tr>";
						
						echo "<tr>";
							echo "<td rowspan='4' colspan='3'>";
								echo $artwork_logo ? "<img src='../images/{$artwork_logo}' style='width:100%;' />" : "No image found.";
							echo "</td>";

							// embroidery calculation
							echo "<td colspan='2' style='text-align:center;'>";
								echo "<span>{$item_qty_verified}</span>";
							echo "</td>";

							echo "<td colspan='3'>";
								echo "<span>Embroidery</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right;'>";
								echo "<span>R". number_format($price_embroidery, 2) ."</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right;'>";
								echo "<span>R". number_format($price_embroidery * $item_qty_verified, 2) ."</span>";
							echo "</td>";
						echo "</tr>";
						
						$line_total += $price_embroidery * $item_qty_verified;

						// artwork calculation
						echo "<tr>";
							echo "<td colspan='2' style='text-align:center;'>";	
								if($price_artwork > 0) {echo "<span>1</span>";} else {echo "<span>0</span>";};
							echo "</td>";

							echo "<td colspan='3'>";
								echo "<span>Artwork</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right;'>";
								echo "<span>R{$price_artwork}</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right;'>";
								if($price_artwork > 0) {echo "<span>R{$price_artwork}</span>";} else {echo "<span>R0.00</span>";}; 
							echo "</td>";
						echo "</tr>";

						if($price_artwork > 0) {$line_total += $price_artwork;} 
						
						// setup calculation
						echo "<tr>";
							echo "<td colspan='2' style='text-align:center;'>";
								if($price_setup > 0) {echo "<span>1</span>";} else {echo "<span>0</span>";};
							echo "</td>";

							echo "<td colspan='3'>";
								echo "<span>Setup</span>";
							echo "</td>";
							
							echo "<td colspan='2' style='text-align:right;'>";
								echo "<span>R{$price_setup}</span>";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right;'>";
								if($price_setup > 0) {echo "<span>R{$price_setup}</span>";} else {echo "<span>R0.00</span>";}; 
							echo "</td>";
						echo "</tr>";

						if($price_setup > 0) {$line_total += $price_setup;} 
						
						echo "<tr>";

							echo "<td colspan='4'>";
								echo "";
							echo "</td>";

							echo "<td colspan='3'>";
								echo "Line Total";
							echo "</td>";

							echo "<td colspan='2' style='text-align:right;'>";
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
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2">
						<span>Sub Total</span>
					</td>
					<td colspan="2" style="text-align:right;">
						<span>R<?php echo number_format($sub_total, 2) ?></span>
					</td>
				</tr>

				<tr>
					<td colspan="8">
						<span></span>
					</td>
					<td colspan="2">
						<span>Vat</span>
					</td>
					<td colspan="2" style="text-align:right;">
						<span>R<?php echo number_format($sub_total * 0.15, 2) ?></span></div>
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
						<span>R<?php echo number_format($sub_total * 1.15, 2) ?></span></div>
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
							<?php $urlWrite = 'https://dev.themidastouch.co.za/sewkool-admin/invoice/print_invoice.php?id=' . $job_card->id; ?>
						
							<input type="hidden" name="url" value="<?php echo $urlWrite ?>">
							<input type="hidden" name="filename" value="<?php echo "INVOICE-" .$job_card->id . ".pdf" ?>">
							<input type="submit" value="GENERATE PDF" class="do-not-print">
						</form>
					</td>
				</tr>

			</tbody>
		</table>

	</div>
    
</body>
</html>