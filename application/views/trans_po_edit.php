<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->

	<?php echo $this->session->flashdata('msg'); ?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Purchase Order Edit</h6>
		</div>
		<div class="card-body">

		<?php
			if( !empty($data_all) ) {
				foreach($data_all as $rec){ 
		?>
		<form action="<?php echo base_url('trans_po_edit/simpan/'.$id); ?>" method="post">
		<div class="row">
			<div class="column col-md-6">
				<div>
                                    <label hidden>Type: </label>
				</div>
				<div>
					<input type="hidden" class="form-control" name="trans_id" value="<?php echo $rec->trans_id; ?>">
					<select hidden class="form-control" name="type">
					<?php
						foreach($get_list_enum as $object){ 
					?>
							<option value="<?php echo $object; ?>" <?php if($rec->type==$object) {
					  echo 'selected="selected"';
					  }; ?>><?php echo $object; ?></option>
					<?php 
						}
					?>
					</select>
					<span class="text-danger"><?php echo form_error('type'); ?></span>
				</div>
				<br>

				<div>
				  <label>Eta Date: </label>
				</div>
				<div>
					<input type="date" class="form-control" name="posting_date" placeholder="Posting Date" value="<?php echo $rec->posting_date; ?>" required>
					<span class="text-danger"><?php echo form_error('posting_date'); ?></span>
				</div>
				<br>

				<div>
				  <label>Material: </label>
				</div>
				<div>
                                        <!--<input type="number" class="form-control" name="material_id" placeholder="material_id" value="5000012930"  readonly>-->
                                        <?php echo form_dropdown('material_id', $dd_material, $rec->material_id, 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('material_id'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Storage: </label>
				</div>
				<div>
					<?php echo form_dropdown('storage_id', $dd_storage, $rec->storage_id, 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('storage_id'); ?></span>
				</div>
				<br>
				
				<div>
				  <label>Quantity: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="quantity" placeholder="quantity" value="<?php echo $rec->quantity; ?>" required>
					<span class="text-danger"><?php echo form_error('quantity'); ?></span>
				</div>
				<br>

				<div>
				  <label hidden>Price: </label>
				</div>
				<div>
					<input type="number" class="form-control" name="price" placeholder="price" value="<?php echo $rec->price; ?>" hidden>
					<span class="text-danger" hidden><?php echo form_error('price'); ?></span>
				</div>
				<br>
                                
                                <div>
				  <label>PO RES Number: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="po_res_number" placeholder="po_res_number" value="<?php echo $rec->po_res_number; ?>">
					<span class="text-danger"><?php echo form_error('po_res_number'); ?></span>
				</div>
				<br>

				<div>
				  <label>PO RES Item: </label>
				</div>
				<div>
					<input type="text" class="form-control" name="po_res_item" placeholder="po_res_item" value="<?php echo $rec->po_res_item; ?>">
					<span class="text-danger"><?php echo form_error('po_res_item'); ?></span>
				</div>
				<br>

			</div>
			<div class="column col-md-6">
				

				<div>
				  <label hidden>Movement Reason: </label>
				</div>
				<div>
					<!--<?php echo form_dropdown('movement_reason_id', $dd_movement_reason, $rec->movement_reason_id, 'class="form-control"'); ?>-->
					<span class="text-danger" hidden><?php echo form_error('movement_reason_id'); ?></span>
				</div>
                            <br>
				
				<div>
				  <label>Vendor: </label>
				</div>
				<div>
					<?php echo form_dropdown('vendor_id', $dd_vendor, $rec->vendor_id, 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('vendor_id'); ?></span>
				</div>
				<br>
                                
                                <div>
                                    <label>Transporter</label>
                                </div>
                                <div>
                                    <?php echo form_dropdown('transporter_id', $dd_transporter, $rec->transporter_id, 'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('transporter_id'); ?></span>
                                </div>
                                <br>
                                
                                <div>
                                    <label>Barge Name</label>
                                </div>
                                <div>
                                    <?php echo form_dropdown('barge_id', $dd_barge, $rec->barge_id, 'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('barge_id'); ?></span>
                                </div>
                                <br>
                                
                                <div>
				  <label>Est Bunker Time(Day): </label>
				</div>
				<div>
					<input type="number" class="form-control" id="est_bunker_time" name="est_bunker_time" placeholder="est_bunker_time" value="<?php echo $rec->est_bunker_time; ?>" required>
					<span class="text-danger"><?php echo form_error('start_bunker_date'); ?></span>
				</div>
				<br>
                                
                                <div>
				  <label>Est Transportation Time(Day): </label>
				</div>
				<div>
                                    <input type="number" class="form-control" id="est_transportation_time" name="est_transportation_time" placeholder="est_transportation_time" value="<?php echo $rec->est_transportation_time; ?>" onkeyup="fillvalue()" required>
					<span class="text-danger"><?php echo form_error('est_transportation_time'); ?></span>
				</div>
				<br>
                                
                                <div>
				  <label>Est Available Date: </label>
				</div>
				<div>
                                    <input type="date" class="form-control" id="est_available_date" name="est_available_date" placeholder="est_available_date" value="<?php echo $rec->est_available_date; ?>">
					<span class="text-danger"><?php echo form_error('est_available_date'); ?></span>
				</div>
				<br>
				
				<div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('trans_po'); ?>">
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
