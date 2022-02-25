<?php
	include("../../../connection/DatabaseConnection.php");
	$invoiceId = $_GET['search'];
	$sql = "SELECT  his.*, us.Name, us.RoleName
			FROM invoicehistory his
			INNER JOIN user us ON us.Id = his.UserId
			WHERE his.InvoiceId = '$invoiceId'
			ORDER BY his.CreatedDate DESC";
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
					<td>Approval Level</td>
					<td>Status</td>
					<td>Remarks</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$result = mysqli_query($con, $sql);
					$sl = 1;
					while($row = mysqli_fetch_assoc($result)){
						$name = $row['Name'];
						$levelName = $row['RoleName'];
						$status = $row['Status'];
						$remarks = $row['Remarks'];
						$invStatus = '';
						if($status == 1){
							$invStatus = '<span class="badge badge-primary">Initial</span>';
						}
						else if($status == 9){
							$invStatus = '<span class="badge badge-danger">Rejected</span>';
						}
						else{
							$invStatus = '<span class="badge badge-success">Accepted</span>';
						}

						echo '<tr>
							<td>'.$sl.'</td>
							<td>'.$name.'</td>
							<td>'.$levelName.'</td>
							<td>'.$invStatus.'</td>
							<td>'.$remarks.'</td>
						</tr>';
						$sl++;
					}
				?>
			</tbody>
			
		</table>
	</div>
	<div class = "col-md-1 col-lg-1 col-sm-1"></div>
	
</div>