<?php
	include("../../../connection/DatabaseConnection.php");
	$invoiceId = $_GET['search'];

	$sql = "SELECT inv.*, fd.Name
			FROM `invocedetail` inv 
			INNER JOIN fooditem fd on fd.Id = inv.FoodItemId 
			WHERE inv.InvoiceId = '$invoiceId'";
	$companySql = "SELECT * FROM companyinformation";
	$companyInfo = mysqli_fetch_assoc(mysqli_query($con, $companySql));

	$invoiceSql = "SELECT inv.*, us.Name
					FROM invoice inv
					INNER JOIN user us on us.Id = inv.CustomerId WHERE inv.Id = '$invoiceId'";
	$invoiceInfo = mysqli_fetch_assoc(mysqli_query($con, $invoiceSql));
?>
<style>
	#invoiceDetails thead tr, tbody tr, tfoot tr{
		text-align:center;
	}

	#invoiceDetails thead tr, tfoot tr{
		background-color:#b3e6ff; 
		font-weight: bold;
	}
</style>



<div class  = "row">
	<div class = "col-md-1 col-lg-1 col-sm-1"></div>
	<div class = "col-md-10 col-lg-10 col-sm-10">
		<table class = "table table-borderless">
			<tr>
				<td colspan="6">
					<?php 
						echo $companyInfo['Name']."<br>"
						.$companyInfo['Email']."</br>"
						.$companyInfo['Address'];
					?>
				</td>
				
			</tr>
			<tr>
				<td style = "text-align:right !important;">Customer Name:</td>
				<td style = "text-align:left !important;"><?php echo $invoiceInfo['Name'];?></td>
				<td style = "text-align:right !important;">Phone:</td>
				<td style = "text-align:left !important;"><?php echo $invoiceInfo['Phone'];?></td>
				<td style = "text-align:right !important;">Invoice:</td>
				<td style = "text-align:left !important;"><?php echo $invoiceInfo['InvoiceNumber'];?></td>
			</tr>
		</table>
		<table class = "table table-bordered table-hover" id='invoiceDetails'>
			<thead>
				<tr>
					<td>SL.</td>
					<td>Name</td>
					<td>Unit Price</td>
					<td>Quantity</td>
					<td>Discount</td>
					<td>Price</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$result = mysqli_query($con, $sql);
					$sl = 1;
					$totalPrice = 0;
					while($row = mysqli_fetch_assoc($result)){
						$name = $row['Name'];
						$unitPrice = $row['UnitPrice'];
						$quantity = $row['Quantity'];
						$discount = $row['Discount'];
						$price = $row['Price'];

						echo '<tr>
							<td>'.$sl.'</td>
							<td>'.$name.'</td>
							<td>'.$unitPrice.'৳</td>
							<td>'.$quantity.'</td>
							<td>'.$discount.'৳</td>
							<td>'.$price.'৳</td>
						</tr>';
						$sl++;
						$totalPrice += $price;
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan ="5" style = "text-align:right !important;">Total</td>
					<td><?php echo $totalPrice;?>৳</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class = "col-md-1 col-lg-1 col-sm-1"></div>
	
</div>