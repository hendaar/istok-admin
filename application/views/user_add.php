<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">User Add</h6>
		</div>
		<div class="card-body">

		<form action="<?php echo base_url('user_add/simpan'); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
				  <label>User Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="user_name" placeholder="User Name" value="<?php echo set_value('user_name'); ?>" required>
					<span class="text-danger"><?php echo form_error('user_name'); ?></span>
				</div>
				<br>

				<div>
				  <label>User Full Name: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="user_name_full" placeholder="User Name Full" value="<?php echo set_value('user_name_full'); ?>" required>
					<span class="text-danger"><?php echo form_error('user_name_full'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Email: </label>
				</div>
				<div>
					<input type="email" class="form-control" name="user_email" placeholder="Email" value="<?php echo set_value('user_email'); ?>" required>
					<span class="text-danger"><?php echo form_error('user_email'); ?></span>		
				</div>				
				<br>
				
			</div>
			<div class="column col-md-6">
				<div>
				  <label>Password: </label>
				</div>
				<div>
					<input type="password" class="form-control" name="user_password" placeholder="Password" value="<?php echo set_value('user_password'); ?>" required>
					<span class="text-danger"><?php echo form_error('user_password'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Confirm Password: </label>
				</div>
				<div>
					<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>" required>
					<span class="text-danger"><?php echo form_error('cpassword'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Level: </label>
				</div>
				<div>
					<select class="form-control" name="user_level">
					<?php
						foreach($get_list_enum as $object){ 
					?>
							<option value="<?php echo $object; ?>"><?php echo $object; ?></option>
					<?php 
						}
					?>
					</select>
					<span class="text-danger"><?php echo form_error('user_level'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('user'); ?>">
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
