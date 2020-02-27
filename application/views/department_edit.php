<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Department Edit</h6>
		</div>
		<div class="card-body">

		<?php
			if( !empty($data_all) ) {
				foreach($data_all as $rec){ 
		?>
		<form action="<?php echo base_url('department_edit/simpan/'.$id); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Department Name: </label>
				</div>
				<div>
					<input type="hidden" class="form-control" name="department_id" value="<?php echo $rec->department_id; ?>">
					<input type="text" class="form-control" name="department_name" placeholder="Department Name" value="<?php echo $rec->department_name; ?>" required>
					<span class="text-danger"><?php echo form_error('department_name'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('department'); ?>">
					<span class="icon text-white-50"><i class="fas fa-check"></i></span>
					<span class="text">Cancel</span></a>
					<button class="btn btn-primary btn-icon-split" type="submit">
					<span class="icon text-white-50"><i class="fas fa-check"></i></span>
					<span class="text">Save</span></button>
				</div>
				<br>
				
			</div>
		</div>
		<?php
				}
			}
		?>
		<?php echo form_close(); ?>
		
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
