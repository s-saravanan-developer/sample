<form id="submit" enctype="multipart/form-data">

            <div class="modal-body">               
                  <fieldset class="scheduler-border">
                  <div class="col-md-12">
                     <h4>Instructions!</h4>
                        <ul class="excel_ins">
                           <li>Kindly upload only .xls files.</li>
                           <li>The sheet consists of Product Name,Product Type,etc..Fields marked are to be entered mandatory.</li>
                           <li>Download the Sample sheet attached for your reference. <span class="downup"><a href="<?php echo base_url();?>attachments/Exceldata/customer_sample.xlsx"><i class="zmdi zmdi-cloud-download zmdi-hc-fw" style="font-size: 26px;"></i></a></span></li>
                           <li>Add the entries to the sheet,save it and upload the sheet. <span class="downup"><a><i class="fa fa-cloud-upload"></i></a></span></li>
                           <li>In case of any queries or issues,please contact </li>
                        </ul>
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="input-group col-xs-12">
                              <input type="file" class="form-control" name="upload_files" id="file" required >
                           </div>                           
                        </div>
                     </div>
                     <div class="col-md-12">
                        <span id="uploaded_image" class="">
                           <div class='progress'>
                              <div class='progress-bar progress-bar-striped progress-bar-animated' id="progress" role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width: 0%'></div>
                           </div>
                        </span>
                     </div>
                  </div>
                  </fieldset>
            </div>
            <div class="delete-footer">
               <button type="submit" class="btn btn-primary" id="sub">Upload</button>
               <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>     
            </div>
         
         </form>




 <script>
   $('#submit').submit(function(e){
      $("#progress").css("width", "2%").delay(111800);
      e.preventDefault(); 
         $.ajax({
             url:'<?php echo base_url(''); ?>import/customer_import',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             cache:false,
             async:false,
             beforeSend:function(){
                  $("#progress").css("width", "2%").delay(111800);
             },
              success: function(data){
                  $("#progress").css("width", "50%").delay(411900);
             },
             error: function() {alert("error occurred.")},
             complete: function() {
                  $("#progress").css("width", "100%").delay(111900);
                     setTimeout(  function()   {  
                        $("#progress").css("background-color", "#28a745").delay(111900);
                      }, 1000);                  
                  setTimeout(  function()   {  
                  window.location.href='<?php echo base_url(''); ?>master/customer/customer';
                   }, 2000);                  
             }
         });
    }); 
</script>  