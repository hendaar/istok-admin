<div class="container-fluid">
    <?php echo $this->session->flashdata('msg'); ?>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Confirm PO</h6>
        </div>
        <div class="card-body">
            <?php
                if ( !empty($data_all) ){
                    foreach ($data_all as $rec){
                }
            ?>
            <form action="<?php echo base_url('list_suggest_confirm/simpan/'.$id); ?>" method="post">
                <div class="row">
                    <div class="column col-md-6">
                        <div>
                            <label>ETA Schedule</label>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" name="trans_id" value="<?php echo $rec->trans_id; ?>">
                            <input type="hidden" class="form-control" name="storage_id" value="<?php echo $rec->storage_id; ?>">
                            <input type="date" class="form-control" name="posting_date" placeholder="Posting Date" value="<?php echo $rec->trans_date; ?>" required>
                            <span class="text-danger"><?php echo form_error('posting_date'); ?></span>
                        </div>
                        <br>
                        <div>
                            <label>Quantity: </label>
			</div>
			<div>
                            <input type="number" class="form-control" name="quantity" placeholder="quantity" value="<?php echo $rec->eta_schedule; ?>" required>
                            <span class="text-danger"><?php echo form_error('quantity'); ?></span>
			</div>
			<br>
                        <div>
				  <label>Vendor: </label>
				</div>
				<div>
					<?php echo form_dropdown('vendor_id', $dd_vendor, set_value('vendor_id'), 'class="form-control"'); ?>
					<span class="text-danger"><?php echo form_error('vendor_id'); ?></span>
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
                                
                    </div>
                    <div class="column col-md-6">
                        <div>
                                    <label>Transporter</label>
                                </div>
                                <div>
                                    <?php echo form_dropdown('transporter_id', $dd_transporter, $rec->transporter_id, 'class="form-control"'); ?>
                                    <span class="text-danger"><?php echo form_error('transporter_id'); ?></span>
                                </div>
                                <br>
                                <div>
                                    <label>PO Number </label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" name="po_number" placeholder="po_number" value="<?php echo set_value('po_number') ?>" required>
                                    <span class="text-danger"><?php echo form_error('po_number'); ?></span>
                                </div>
                                <br>
                                <div>
                                    <label>PO Res Item </label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" name="po_res_item" placeholder="po_res_item" value="<?php echo set_value('po_res_item') ?>" required>
                                    <span class="text-danger"><?php echo form_error('po_res_item'); ?></span>
                                </div>
                                <br>
                                <div>
                                    <label>Loading Time </label>
                                </div>
                                <div>
                                    <input type="text" class="form-control" name="loading_time" placeholder="loading_time" value="<?php echo set_value('loading_time') ?>" required>
                                    <span class="text-danger"><?php echo form_error('loading_time'); ?></span>
                                </div>
                                <br>
                                
                                <div>
					<a class="btn btn-warning btn-icon-split" href="<?php echo base_url('list_suggest_confirm'); ?>">
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
            <?php } ?>
        </div>
    </div>
</div>