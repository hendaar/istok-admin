<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Barge Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('barge_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Barge Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="barge_name" placeholder="barge Name" value="<?php echo set_value('barge_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('barge_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>Volume: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="volume" placeholder="volume" value="<?php echo set_value('volume'); ?>" required>
					<span class="text-danger"><?php echo form_error('volume'); ?></span>
				</div>
				<br>
                                
                                <div>
                                    <label>Transporter: </label>
                                </div>
                                <div>
                                    <?php echo form_dropdown('transporter_id', $dd_transporter, set_value('transporter_id'), 'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('transporter_id'); ?></span>
                                </div>
                                <br>

			</div>
			<div class="column col-md-6">
				<div>
				  <label>Priority: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="prioritas" placeholder="priority" value="<?php echo $max_id; ?>" required>
					<span class="text-danger"><?php echo form_error('prioritas'); ?></span>
				</div>
				<br>

				<div>
				  <label>Durasi Bongkar (hari): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="durasi_bongkar" placeholder="durasi bongkar" value="<?php echo set_value('durasi_bongkar'); ?>" required>
					<span class="text-danger"><?php echo form_error('durasi_bongkar'); ?></span>
				</div>
				<br>

				<div>
				  <label>Storage: </label>
				</div>
				<div>
					<?php echo form_dropdown('storage_id', $dd_storage, set_value('storage_id'), 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('user_password'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('barge'); ?>">
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
