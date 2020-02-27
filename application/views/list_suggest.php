<!-- Begin Page Content -->
<div class="container-fluid">
    
    <h1 class="h3 mb-2 text-gray-800">List Suggest Forecast</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
        </div>
        <div class="card-body">
           
            
                <div class="row">
                    <div class="coloumn col-md-3">
                        <div>
                            <label>Site</label>
                        </div>
                        <div>
                            <?php echo form_dropdown('storage_id', $ddStorage, 1, 'id="storage_id" class="form-control"'); ?>
                            <span class="text-danger"><?php echo form_error('storage_id'); ?></span>
                        </div>
                        <br>
                        <div>
                            <label>Year</label>
                        </div>
                        <div>
                            <?php echo form_dropdown('year_id', $ddYear, 0, 'id="year_id" class="form-control"'); ?>
                            <span class="text-danger"><?php echo form_error('year_id'); ?></span>
                        </div>
                        <br>
                        <div>
                            <label>Month</label>
                        </div>
                        <div>
                            <?php echo form_dropdown('month', $ddMonth, 0, 'id="month" class="form-control"'); ?>
                            <span class="text-danger"><?php echo form_error('month'); ?></span>
                        </div>
                        <!--<div>
                            <label>Period</label>
                        </div>
                        <div>
                            <?php echo form_dropdown('periode_id', $ddPeriode, 1, 'id="periode_id" name="periode_id" class="form-control"'); ?>
                            <span class="text-danger"><?php echo form_error('periode_id'); ?></span>
                        </div>
                        <div>
                            <label>Sub Periode</label>
                        </div>
                        <div>
                            <!--<?php echo form_dropdown('ddSubPeriodeQ_id', $ddSubPeriodeQ, '', 'id="ddSubPeriodeQ_id" class="form-control" disabled'); ?>
                            <?php echo form_dropdown('ddSubPeriodeM_id', $ddSubPeriodeM, '', 'id="ddSubPeriodeM_id" class="form-control" hidden'); ?>
                            <span class="text-danger"><?php echo form_error('subPeriode_id'); ?></span>
                            <select id="period" name="period"></select>
                        </div>-->
                        <br>
                        <div>
                            <button class="btn btn-primary btn-icon-split" id="show" value="" name="show">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Show Data</span></button>
                        </div>
                    </div>
                    <div class="coloumn col-md-3">
                        <div>
                            <label>Total Sugested</label>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                    
                    
                    <div class="coloumn col-md-5">
                        <table class="table table-bordered table-striped" id="table_barge" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Available Barge</th>
                                   
                                    <th>Time Available</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($barge as $list_barge): ?>
                                
                            <tr>
                                <td><?php echo $list_barge->barge_name?></td>
                               
                                <td><?php echo $list_barge->tanggal_bongkar?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        
                        <div>
                            
                        </div>
                    </div>
                </div>
                <br>
                
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Suggest No</th>
                            <th>ETA Schedule</th>
                            <th>Volume</th>
                            <th>Vendor</th>
                            <th>Barge</th>
                            <th>Trasnporter</th>
                            <th>PO Number</th>
                            <th>Status</th>
                            <th>Loading Time</th>
                            <th>Next Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                           
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
    $("#periode_id").change(function(){
        //alert($('#periode_id :selected').val());
        var id = $('#periode_id :selected').val();
        $.ajax({
            url: '<?php echo base_url()?>index.php/list_suggest/sub_period/',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function(data){
                //alert(JSON.stringify(data, null, 4));
                $("#period").find('option').remove();
                $.each(data,function(key, value){
                   $("#period").append('<option value=' + key + '>' + value + '</option>'); 
                });
            }
           
        });
    });
    
    
});
</script>
<script>
    var table;
    $(document).ready(function(){
        $("#show").click(function(){
          var storage_id = $('#storage_id :selected').val();
          var month = $('#month :selected').val();
          
          get_datatable(storage_id, month);
        });
        
    function get_datatable(storage_id, month){
        table = $('#table').DataTable({
                "retrieve": true,
                "paging": false,
                "searching": false,
                "processing": true, 
                "serverSide": true, 
                "order": [], 

                "ajax": {
                    "url": "<?php echo site_url('list_suggest/get_list_data')?>",
                    "type": "POST",
                    "data": {storage_id: storage_id,month: month},
                },
                        
                "columnDefs": [
                    { 
			"targets": [ 0 ], 
			"orderable": false, 
                    },
		],
            });
    }
    });
</script>
<script type="text/javascript">

</script>