<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Parameter Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('parameter_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>Parameter Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="parameter_name" placeholder="Parameter Name" value="<?php echo set_value('parameter_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('parameter_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>Lead Time (days): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="lead_time" placeholder="Lead Time" value="<?php echo set_value('lead_time'); ?>" required>
					<span class="text-danger"><?php echo form_error('lead_time'); ?></span>
				</div>
				<br>

				<div>
				  <label>Dead Stock (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="dead_stock" placeholder="Dead Stock" value="<?php echo set_value('dead_stock'); ?>" required>
					<span class="text-danger"><?php echo form_error('dead_stock'); ?></span>
				</div>
				<br>

				<div>
				  <label>Average Distribution (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="average_distribution" placeholder="Average Distribution" value="<?php echo set_value('average_distribution'); ?>" required>
					<span class="text-danger"><?php echo form_error('average_distribution'); ?></span>
				</div>
				<br>

				<div>
				  <label>Average Distribution Max (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="average_distribution_max" placeholder="Average Distribution Max" value="<?php echo set_value('average_distribution_max'); ?>" required>
					<span class="text-danger"><?php echo form_error('average_distribution_max'); ?></span>
				</div>
				<br>

				<div>
				  <label>Safety Stock (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="safety_stock" placeholder="Safety Stock" value="<?php echo set_value('safety_stock'); ?>" required>
					<span class="text-danger"><?php echo form_error('safety_stock'); ?></span>
				</div>
				<br>

				<div>
				  <label>Reorder Point (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="reorder_point" placeholder="Reorder Point" value="<?php echo set_value('reorder_point'); ?>" required>
					<span class="text-danger"><?php echo form_error('reorder_point'); ?></span>
				</div>
				<br>

				<div>
				  <label>Stock Max (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="stock_max" placeholder="Stock Max" value="<?php echo set_value('stock_max'); ?>" required>
					<span class="text-danger"><?php echo form_error('stock_max'); ?></span>
				</div>
				<br>

				<div>
				  <label>Stock Min (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="stock_min" placeholder="Stock Min" value="<?php echo set_value('stock_min'); ?>" required>
					<span class="text-danger"><?php echo form_error('stock_min'); ?></span>
				</div>
				<br>

				<div>
				  <label>Std. Barge Volume (Liter): </label>
				</div>
				<div>
					<input type="number" class="form-control" name="barge_volume" placeholder="barge volume" value="<?php echo set_value('barge_volume'); ?>" required>
					<span class="text-danger"><?php echo form_error('barge_volume'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				<div>
				  <label>Inlet ISO 4: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="inlet_iso4" placeholder="Inlet ISO 4" value="<?php echo set_value('inlet_iso4'); ?>" required>
					<span class="text-danger"><?php echo form_error('inlet_iso4'); ?></span>
				</div>
				<br>

				<div>
				  <label>Inlet ISO 6: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="inlet_iso6" placeholder="Inlet ISO 6" value="<?php echo set_value('inlet_iso6'); ?>" required>
					<span class="text-danger"><?php echo form_error('inlet_iso6'); ?></span>
				</div>
				<br>

				<div>
				  <label>Inlet ISO 14: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="inlet_iso14" placeholder="Inlet ISO 14" value="<?php echo set_value('inlet_iso14'); ?>" required>
					<span class="text-danger"><?php echo form_error('inlet_iso14'); ?></span>
				</div>
				<br>

				<div>
				  <label>Outlet ISO 4: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="outlet_iso4" placeholder="Outlet ISO 4" value="<?php echo set_value('outlet_iso4'); ?>" required>
					<span class="text-danger"><?php echo form_error('outlet_iso4'); ?></span>
				</div>
				<br>

				<div>
				  <label>Outlet ISO 6: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="outlet_iso6" placeholder="Outlet ISO 6" value="<?php echo set_value('outlet_iso6'); ?>" required>
					<span class="text-danger"><?php echo form_error('outlet_iso6'); ?></span>
				</div>
				<br>

				<div>
				  <label>Outlet ISO 14: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="outlet_iso14" placeholder="Outlet ISO 14" value="<?php echo set_value('outlet_iso14'); ?>" required>
					<span class="text-danger"><?php echo form_error('outlet_iso14'); ?></span>
				</div>
				<br>

				<div>
				  <label>UserID Update: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="user_id_update" placeholder="UserID Update" value="<?php echo set_value('user_id_update'); ?>" disabled>
					<span class="text-danger"><?php echo form_error('user_id_update'); ?></span>
				</div>
				<br>

				<div>
				  <label>UserID Update (DateTime): </label>
				</div>
				<div>
					<input type="text" class="form-control" name="user_id_update_date" placeholder="UserID Update (DateTime)" value="<?php echo set_value('user_id_update_date'); ?>" disabled>
					<span class="text-danger"><?php echo form_error('user_id_update_date'); ?></span>
				</div>
				<br>

				<div>
				  <label>Storage: </label>
				</div>
				<div>
					<?php echo form_dropdown('storage_id', $dd_storage, set_value('storage_id'), 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('storage_id'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('parameter'); ?>">
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
