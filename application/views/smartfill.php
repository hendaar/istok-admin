<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Master / Smartfill</h1>
	<p class="mb-4">Berikut ini adalah kumpulan data yang terdaftar di aplikasi.</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Smartfill | <a href="<?php echo base_url(); ?>smartfill_add">Add</a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Smartfill ID</th>
							<th>Smartfill Name</th>
							<th>Type</th>
							<th>Serial No</th>
							<th>Client Reference</th>
							<th>Client Secret</th>
							<th>Storage</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url(); ?>assets/jquery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
	var table;
	$(document).ready(function() {

		//datatables
		table = $('#table').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 
			
			"ajax": {
				"url": "<?php echo site_url('smartfill/get_data_user')?>",
				"type": "POST"
			},

			
			"columnDefs": [
			{ 
				"targets": [ 0 ], 
				"orderable": false, 
			},
			],
		});
	});
	</script>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
