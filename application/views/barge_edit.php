<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Barge Edit</h6>
		</div>
		<div class="card-body">

		<?php
			if( !empty($data_all) ) {
				foreach($data_all as $rec){ 
		?>
		<form action="<?php echo base_url('barge_edit/simpan/'.$id); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Barge Name: </label>
				</div>
				<div>
					<input type="hidden" class="form-control" name="barge_id" value="<?php echo $rec->barge_id; ?>">
					<input type="text" class="form-control" name="barge_name" placeholder="barge Name" value="<?php echo $rec->barge_name; ?>" required>
					<span class="text-danger"><?php echo form_error('barge_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>Volume: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="volume" placeholder="volume" value="<?php echo $rec->volume; ?>" required>
					<span class="text-danger"><?php echo form_error('volume'); ?></span>
				</div>
				<br>
                                <div>
                                    <label>Transporter: </label>
                                </div>
                                <div>
                                    <?php echo form_dropdown('transporter_id', $dd_transporter, $rec->transporter_id, 'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('transporter_id'); ?></span>
                                </div>
                                <br>

			</div>
			<div class="column col-md-6">
				<div>
				  <label>Priority: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="prioritas" placeholder="priority" value="<?php echo $rec->prioritas; ?>" required>
					<span class="text-danger"><?php echo form_error('prioritas'); ?></span>
				</div>
				<br>

				<div>
				  <label>Durasi Bongkar (hari): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="durasi_bongkar" placeholder="durasi bongkar" value="<?php echo $rec->durasi_bongkar; ?>" required>
					<span class="text-danger"><?php echo form_error('durasi_bongkar'); ?></span>
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
