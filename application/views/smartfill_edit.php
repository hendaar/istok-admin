<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Smartfill Edit</h6>
		</div>
		<div class="card-body">

		<?php
			if( !empty($data_all) ) {
				foreach($data_all as $rec){ 
		?>
		<form action="<?php echo base_url('smartfill_edit/simpan/'.$id); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Smartfill Name: </label>
				</div>
				<div>
					<input type="hidden" class="form-control" name="smartfill_id" value="<?php echo $rec->smartfill_id; ?>">
					<input type="text" class="form-control" name="smartfill_name" placeholder="Smartfill Name" value="<?php echo $rec->smartfill_name; ?>" required>
					<span class="text-danger"><?php echo form_error('smartfill_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>Type: </label>
				</div>
				<div>
					<select class="form-control" name="smartfill_type">
					<?php
						foreach($get_list_enum as $object){ 
					?>
							<option value="<?php echo $object; ?>" <?php if($rec->smartfill_type==$object) {
					  echo 'selected="selected"';
					  }; ?>><?php echo $object; ?></option>
					<?php 
						}
					?>
					</select>
					<span class="text-danger"><?php echo form_error('smartfill_type'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Serial No: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="smartfill_serialno" placeholder="Smartfill Serial No" value="<?php echo $rec->smartfill_serialno; ?>" required>
					<span class="text-danger"><?php echo form_error('smartfill_serialno'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				<div>
				  <label>Client Reference: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="client_reference" placeholder="Smartfill Client Reference" value="<?php echo $rec->client_reference; ?>" required>
					<span class="text-danger"><?php echo form_error('client_reference'); ?></span>
				</div>
				<br>

				<div>
				  <label>Client Secret: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="client_secret" placeholder="Smartfill Client Secret" value="<?php echo $rec->client_secret; ?>" required>
					<span class="text-danger"><?php echo form_error('client_secret'); ?></span>
				</div>
				<br>

				<div>
				  <label>Storage: </label>
				</div>
				<div>
					<?php echo form_dropdown('storage_id', $dd_storage, $rec->storage_id, 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('user_password'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('smartfill'); ?>">
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
