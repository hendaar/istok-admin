<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Contractor Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('contractor_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Contractor Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="contractor_name" placeholder="Contractor Name" value="<?php echo set_value('contractor_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('contractor_name'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				<div>
				  <label>Department: </label>
				</div>
				<div>
					<?php echo form_dropdown('department_id', $dd_department, set_value('department_id'), 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('department_id'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('contractor'); ?>">
					<span class="icon text-white-50"><i class="fas fa-check"></i></span>
					<span class="text">Cancel</span></a>
					<button class="btn btn-primary btn-icon-split" type="submit">
					<span class="icon text-white-50"><i class="fas fa-check"></i></span>
					<span class="text">Save</span></button>
				</div>
				<br>
				
			</div>
		</div>
		</form>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
