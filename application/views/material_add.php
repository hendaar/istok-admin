<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Material Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('material_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Material Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="material_name" placeholder="material Name" value="<?php echo set_value('material_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('material_name'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('material'); ?>">
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
