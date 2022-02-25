<?php
	include("../../../connection/DatabaseConnection.php");
	$invoiceId = $_GET['search'];

	$sql = "SELECT inv.*, fd.Name
			FROM `invocedetail` inv 
			INNER JOIN fooditem fd on fd.Id = inv.FoodItemId 
			WHERE inv.InvoiceId = '$invoiceId'";
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