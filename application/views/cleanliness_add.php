<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Cleanliness Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('cleanliness_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>MDT Code: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="code" placeholder="code" value="<?php echo set_value('code'); ?>" required>
					<span class="text-danger"><?php echo form_error('code'); ?></span>
				</div>
				<br>
                                
                                <div>
				  <label>Cleanliness Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="cleanliness_name" placeholder="Cleanliness Name" value="<?php echo set_value('cleanliness_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('cleanliness_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>Type: </label>
				</div>
				<div>
					<select class="form-control" name="cleanliness_type">
					<?php
						foreach($get_list_enum as $object){ 
					?>
							<option value="<?php echo $object; ?>"><?php echo $object; ?></option>
					<?php 
						}
					?>
					</select>
					<span class="text-danger"><?php echo form_error('smartfill_type'); ?></span>
				</div>
				<br>
				
			</div>
			<div class="column col-md-6">
				<div>
				  <label>Storage: </label>
				</div>
				<div>
					<?php echo form_dropdown('storage_id', $dd_storage, set_value('storage_id'), 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('storage_id'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('cleanliness'); ?>">
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
