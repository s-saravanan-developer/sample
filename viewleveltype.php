<script>
    <?php
         if ($this->session->flashdata('country_success')) 
         {
            echo "var data = ' ".$this->session->flashdata('country_success')."';";
            echo "success(data);";
         }
         if ($this->session->flashdata('duplicate')) 
         {
            echo "var data = ' ".$this->session->flashdata('duplicate')."';";
            echo "duplicate(data);";
         }
   ?>
</script>
<div class="content-wrapper">
    <div class="content">
        <header class="page-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="separator">Level Type</h1>
                    <nav class="breadcrumb-wrapper" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/dashboard"><i class="icon dripicons-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard/dashboard">Master</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master</li>
                            <li class="breadcrumb-item active" aria-current="page">Level Type</li>
                        </ol>
                    </nav>
                </div>
                <ul class="actions top-right">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="btn btn-fab" data-toggle="dropdown" aria-expanded="false">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-icon-menu dropdown-menu-right">
                            <div class="dropdown-header">
                                Quick Actions
                            </div>
                            <a href="#" class="dropdown-item">
                                <i class="icon dripicons-clockwise"></i> Refresh
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="icon dripicons-gear"></i> Manage Widgets
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="icon dripicons-cloud-download"></i> Export
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="icon dripicons-help"></i> Support
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <section class="page-content container-fluid">
            <?php
            // echo "<pre>";
            //    print_r($area);
            // echo "</pre>";
         ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header">
                     <div style="float: left;">
                        Manage Level Type 
                     </div>
                     <div style="float: right;">

                        <button type="button" class="btn btn-success  btn-floating" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Level Type" >
                        <p class="text-white" data-toggle="modal" data-target="#areaaddmodel">Add New Level Type</p>
                        </button>

                     </div>
                  </h5>
                            <div class="card-body">
                                <?php
                          // echo "<pre>";
                          //  print_r($city);
                          // echo "</pre>";
                        ?>
            <table id="bs4-table" class="table table-striped table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr>

                        <th class="text-center" style="width: 2%">
                            <input type="checkbox" name="checkbox" class="checkbox" id="select_all" />
                        </th>
                        <th class="text-center" style="width: 2%">S.No</th>
                        <th class="text-center" style="width: 15%">Action</th>
                        <th style="width: 20%">Level Type</th>
                        <th style="width: 17%">Alias Name</th>
                        <th style="width: 20%">Days</th>
                        <th style="width: 20%">Description</th>
                        <th class="text-center" style="width: 8%">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
      if (!empty($payout)) {
          $s = 1;
          foreach ($payout as $list) {
              ?>
                        <tr>

                            <td>
                                <input type="checkbox" name="checkbox" class="checkbox boxischecked" value="<?php if ($list['delete_status'] == 1) {  }else{ echo ucfirst($list['ID']); } ?> " />
                            </td>

                            <td class="text-center">
                                <?php echo $s; ?>
                            </td>
                            <td class="text-center">
                                <a id="usertypeedit" class="btn btn-info btn-sm editusertype" onclick="areaedit('<?php echo ucfirst($list['ID']); ?>','<?php echo ucfirst($list['Level_type']); ?>','<?php echo ucfirst($list['Alias_name']); ?>','<?php echo ucfirst($list['Status']); ?>','<?php echo ucfirst($list['Description']); ?>','<?php echo ucfirst($list['Weeks']); ?>')" data-toggle="modal" data-target="#areaeditmodel"><i class="zmdi zmdi-edit zmdi-hc-fw" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"   style="
            font-size: 17px;
            color:  white;
            "></i>
         </a>                   
         <?php if ($list['delete_status'] == 1) { ?>
             <a href="" class="btn btn-danger btn-sm disabled"  data-toggle="modal" data-target="#deletemodel<?php echo $list['ID']; ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" style="font-size: 17x;color:  white;"></i></a>
          <?php }else{ ?>
            <a href="" onclick="delete_coutry('<?php echo ucfirst($list['ID']); ?>')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodel<?php echo $list['ID']; ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" style="font-size: 17x;color:  white;"></i></a>
          <?php } ?>
                              
                            </td>
                            <td class="s_no">
                                <?php echo ucfirst($list['Level_type']); ?>
                            </td>
                            <td class="s_no">
                                <?php echo ucfirst($list['Alias_name']); ?>
                            </td>

                            <td class="s_no">
                                <?php
                                
                                $days = explode(',', $list['Weeks']);
                                foreach ($days as $key => $value) {
                                   if($key != '0'){echo ',';}
                                     if($value == '1'){echo 'Monday';}
                                     if($value == '2'){echo 'Tuesday';}
                                     if($value == '3'){echo 'Wednesday';}
                                     if($value == '4'){echo 'Thursday';}
                                     if($value == '5'){echo 'Friday';}
                                     if($value == '6'){echo 'Saturday';}
                                     if($value == '7'){echo 'Sunday';}
                                     if($value == '8'){echo 'All Days';}

                                 } 
                                ?>

                            </td>
                             <td class="s_no">
                                <?php echo ucfirst($list['Description']); ?>
                            </td>
                            <td class="text-center" style="width: 8%"><span class="badge badge-<?php echo ($list['Status'] == 1) ? 'success' : 'danger'; ?>"><?php echo ($list['Status'] == 1) ? 'Active' : 'In-Active'; ?></span></td>

                        </tr>
                        <?php
      $s++;
      }
      }
      ?>
                </tbody>
            </table>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="button" class="btn btn-danger delbtn" data-toggle="modal" data-target="#deletemodel1">Delete</button>
                                <button type="" class="btn btn btn-success   delbtn" data-toggle="modal" data-target="#active_all_model">Active</button>
                                <button type="" class="btn btn btn-info delbtn" data-toggle="modal" data-target="#deactive_all_model">In-Active
                                </button>
                                <button class="btn btn-primary region_input no-display" data-toggle="modal" data-target="#multiexport">Export Excel</button>
                                <button class="btn btn-primary region_input1" data-toggle="modal" data-target="#Export">Export Excel</button>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
</div>

<!-- ADD AREA -->
<div id="areaaddmodel" class="modal modal-right-side fade" data-backdrop="static" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel6">Level Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true" class="zmdi zmdi-close"></span>
</button>
</div>
<div class="modal-body" style="overflow-y: scroll;">
<div class="row">
<div class="col">
<div class="card">
<h5 class="card-header">Add Level Type</h5>
<div class="card-body">
<div class="form-body">
<div class="row">
<div>
<div>
<div class="card-body">
<form action="<?php echo base_url(); ?>master/Leveltype/add_leveltype" method="post" data-toggle="validator" role="form">
<div class="form-row">
<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Level Type</label> <span class="text-danger">*</span>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-arrow-right-top zmdi-hc-fw"></i></span>
</div>
<input type="text" class="form-control check_data" id="area_name" autofocus placeholder="Level Type" name="Level_type" onkeyup="check_area_name()" required>
</div>
<div class="text-center duplicate-occur no-display">
<code>This Level Type Is Already Used</code>
</div>
</div>
</div>
<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Alias Name</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-face zmdi-hc-fw"></i></span>
</div>
<input type="text" class="form-control check_data alis_name" id="area_name" autofocus placeholder="Alias Name" name="Alias_name">
</div>
</div>
</div>
<div class="form-group col-md-12">
<div class="form-group">
<label class="col-form-label-lg" for="largeInput">Days  <span style="color:red">*</span></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i></span>
</div>
<select class="form-control bill_id" name="Weeks[]" id="" multiple required="" style="width: 93%">
<?php if(!empty($weeks)){foreach($weeks as $wks){ ?>
 <option value="<?php echo $wks['Id']; ?>" ><?php echo ucfirst($wks['Week']); ?></option> 
 <?php } } ?>
</select>
</div>
</div>
</div>

<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Description</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-iridescent zmdi-hc-fw"></i></span>
</div>
<textarea type="text" class="form-control Description" id="Description" autofocus placeholder="Enter Description" name="Description"></textarea>
</div>
</div>
</div>
<div class="form-group col-md-12">
<label for="exampleFormControlSelect1">Status</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-equalizer zmdi-hc-fw"></i></span>
</div>
<select class="form-control" name="Status" id="exampleFormControlSelect1">
<option value="1">Active</option>
<option value="2">Inactive</option>
</select>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success  submit">Save changes</button>
</div>
</form>
</div>
</div>
</div>
<!-- AREA END -->

<!-- EDIT AREA -->
<div id="areaeditmodel" class="modal modal-right-side fade" data-backdrop="static" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel6">Level Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true" class="zmdi zmdi-close"></span>
</button>
</div>
<div class="modal-body" style="overflow-y: scroll;">
<div class="row">
<div class="col">
<div class="card">

<div class="card-body">
<div class="form-body">
<div class="row">
<div class="col-md-12">

<h5 class="card-header">Edit Level Type</h5>
<div class="card-body">

<form action="<?php echo base_url(); ?>master/Leveltype/edit_leveltype" method="post" data-toggle="validator" role="form">
<div class="form-row">
<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Level Type</label> <span class="text-danger">*</span>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-arrow-right-top zmdi-hc-fw"></i></span>
</div>
<input type="text" class="form-control check_data1 area" id="area_name" autofocus placeholder="Level Type" name="Level_type" onkeyup="check_area_name_edit()" required>
<input type="hidden" class="form-control check_id id " id="id" autofocus placeholder="id" name="ID"required>
</div>
<div class="text-center duplicate-occur1 no-display">
<code>This Level Type Is Already Used</code>
</div>
</div>
</div>
<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Alias Name </label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-face zmdi-hc-fw"></i></span>
</div>
<input type="text" class="form-control alias_name" id="area_name" autofocus placeholder="Alias Name" name="Alias_name">
</div>
</div>
</div>
<div class="form-group col-md-12">
<div class="form-group">
<label class="col-form-label-lg" for="largeInput">Days  <span style="color:red">*</span></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i></span>
</div>
<select class="form-control weeks" name="Weeks[]" id="s2_demo1" multiple required="" style="width: 93%">
<?php if(!empty($weeks)){foreach($weeks as $wks){ ?>
<option value="<?php echo $wks["Id"] ?>"><?php echo $wks["Week"] ?></option>
<?php } } ?>
</select>
</div>
</div>
</div>
<div class="form-group col-md-12">
<div class="form-group" style="padding: 5px;">
<label for="inputName" class="control-label">Description</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-iridescent zmdi-hc-fw"></i></span>
</div>
<textarea type="text" class="form-control Description" id="Description" autofocus placeholder="Enter Description" name="Description"></textarea>
</div>
</div>
</div>
<div class="form-group col-md-12">
<label for="exampleFormControlSelect1">Status</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text " id="basic-icon-addon1"><i class="zmdi zmdi-equalizer zmdi-hc-fw"></i></span>
</div>
<select class="form-control status" name="Status" id="exampleFormControlSelect1">
<option value="1">Active</option>
<option value="2">Inactive</option>
</select>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success  submit">Update</button>
</div>
</form>
</div>
</div>
</div>
<!-- AREA END -->

<!-- BASIC MODAL DEMO -->
 <?php if (!empty($payout)) {$s = 1; foreach ($payout as $list) {?> 

<div class="modal fade" id="deletemodel<?php echo $list['ID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>
            <form action="<?php echo base_url();?>master/Leveltype/delete_leveltype/<?php echo $list['ID']; ?>" method="POST">
                <div class="modal-body">
                    <div class="swal2-header">
                        <ul class="swal2-progresssteps" style="display: none;"></ul>
                        <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                        </div>
                        <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                        <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                        <div class="swal2-icon swal2-success" style="display: none;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                        <img class="swal2-image" style="display: none;">
                        <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                        <button type="button" class="swal2-close" style="display: none;">×</button>
                    </div>
                    <!-- Hiiden Values -->

                    <input type="hidden" name="url" value="<?php echo $this->router->method; ?>">
                    <input class="delete_id" type="hidden" name="country_id">
                    <input class="table_name" type="hidden" name="table_name">
                </div>
                <div class="delete-footer">
                    <button type="submit" class="btn btn-primary">Yes, delete it!</button>
                    <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
  
<?php }} ?>
<div class="modal fade" id="deletemodel1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="swal2-header">
                    <ul class="swal2-progresssteps" style="display: none;"></ul>
                    <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                    </div>
                    <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                    <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                    <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                    <div class="swal2-icon swal2-success" style="display: none;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                    <button type="button" class="swal2-close" style="display: none;">×</button>
                </div>
                <!-- Hiiden Values -->

            </div>
            <div class="delete-footer">
                <button type="submit" id="del_all" class="btn btn-primary">Yes, delete it!</button>
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deactive_all_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">In-Active</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="swal2-header">
                    <ul class="swal2-progresssteps" style="display: none;"></ul>
                    <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                    </div>
                    <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                    <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                    <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                    <div class="swal2-icon swal2-success" style="display: none;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                    <button type="button" class="swal2-close" style="display: none;">×</button>
                </div>
                <!-- Hiiden Values -->

            </div>
            <div class="delete-footer">
                <button type="submit" id="deactive_all" class="btn btn-primary">Yes, In-Active it!</button>
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="active_all_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Active</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="swal2-header">
                    <ul class="swal2-progresssteps" style="display: none;"></ul>
                    <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                    </div>
                    <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                    <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                    <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                    <div class="swal2-icon swal2-success" style="display: none;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                    <button type="button" class="swal2-close" style="display: none;">×</button>
                </div>
                <!-- Hiiden Values -->

            </div>
            <div class="delete-footer">
                <button type="submit" id="active_all" class="btn btn-primary">Yes, Active it!</button>
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="Export" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Export</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="swal2-header">
                    <ul class="swal2-progresssteps" style="display: none;"></ul>
                    <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                    </div>
                    <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                    <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                    <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                    <div class="swal2-icon swal2-success" style="display: none;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                    <button type="button" class="swal2-close" style="display: none;">×</button>
                </div>
                <!-- Hiiden Values -->

            </div>
            <div class="delete-footer">
                <a id="active_all" class="btn btn-primary export_link" data-dismiss="modal">Yes, Export it!</a>
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="multiexport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Export</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="swal2-header">
                    <ul class="swal2-progresssteps" style="display: none;"></ul>
                    <div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>
                    </div>
                    <div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div>
                    <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div>
                    <div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div>
                    <div class="swal2-icon swal2-success" style="display: none;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <img class="swal2-image" style="display: none;">
                    <h2 class="swal2-title text-center" id="swal2-title">Are you sure?</h2>
                    <button type="button" class="swal2-close" style="display: none;">×</button>
                </div>
                <!-- Hiiden Values -->

            </div>
            <div class="delete-footer">
                <a type="submit" class="btn btn-primary multi_export" data-dismiss="modal">Yes, Export it!</a>
                <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function delete_coutry(val, val1) {
        $('.delete_id').val(val);
        $('.table_name').val(val1);
        //alert($('.delete_id').val(val));
    }

    function areaedit(ID,Level_type,Alias_name,Status,Description,Weeks) {
// alert(Weeks);
        $('.alias_name').val(Alias_name);
        $('.status').val(Status);
        $('.area').val(Level_type);
        $('.id').val(ID);
        $('.Description').val(Description);
        var days = JSON.parse("[" + Weeks + "]");
        $('.weeks').select2().val(days).trigger('change');
    }

    function check_area_name() {
        
        var check_data = $('.check_data').val();
        var result = '';
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>master/location/duplicate_check",
            data: {
                data: check_data,
                table_name: 'gc_leveltype',
                colum: 'Level_type'
            },
            cache: true,
            async: false,
            success: function(data) {
                // alert(data);
                result = data;
            }
        });
        if (result == 1) {
            $('.duplicate-occur').removeClass('no-display');
            $("button[type=submit]").attr("disabled", "disabled");
            // return false;
        }
if (result == 0) {
    $('.duplicate-occur').addClass('no-display');
    $("button[type=submit]").removeAttr("disabled");
    // return true;
}

    }


        function check_area_name_edit() {  

        var check_data = $('.check_data1').val();
        // alert($('.check_id').val());
        var result = '';

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>master/location/duplicate_checkedit",
            data: {
                data: check_data,
                table_name: 'gc_leveltype',
                colum: 'Level_type',
                id: $('.check_id').val()
            },
            cache: true,
            async: false,
            success: function(data) {
                // alert(data);
                result = data;
            }
        });
        if (result == 1) {

            $('.duplicate-occur1').removeClass('no-display');
            $("button[type=submit]").attr("disabled", "disabled");
            }
            if (result == 0) {
                $('.duplicate-occur1').addClass('no-display');
                $("button[type=submit]").removeAttr("disabled");
                
            }

    }
</script>

<script type="text/javascript">
    // To check all the boxes

    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });

    // To pass the value to the Controller

     $(document).ready(function() {
        $("#del_all").click(function() {
            var favorite = [];
            $.each($("input[name='checkbox']:checked"), function() {
                favorite.push($(this).val());
            });
            alert("Selected Countries are: " + favorite.join(","));
            
            $.ajax({
                url: '<?php echo base_url() ?>master/Location/delete_checkbox',
                type: 'post',
                data: {
                    table_name: 'gc_leveltype',
                    id: favorite.join(",")
                },
            }).done(function(data) {
                location.reload();

            });
        });
    });

    $(document).ready(function() {
        $("#active_all").click(function() {
            var favorite = [];
            $.each($("input[name='checkbox']:checked"), function() {
                favorite.push($(this).val());
            });
            alert("Selected Countries are: " + favorite.join(","));
            $.ajax({
                url: '<?php echo base_url() ?>master/Location/active_all_checkbox',
                type: 'post',
                data: {
                    table_name: 'gc_leveltype',
                    id: favorite.join(",")
                },
            }).done(function(data) {
                location.reload();

            });
        });
    });

    $(document).ready(function() {
        $("#deactive_all").click(function() {
            var favorite = [];
            $.each($("input[name='checkbox']:checked"), function() {
                favorite.push($(this).val());
            });
            // alert("Selected Countries are: " + favorite.join(","));
            $.ajax({
                url: '<?php echo base_url() ?>master/Location/deactivate_all_checkbox',
                type: 'post',
                data: {
                    id: favorite.join(","),
                    table_name: 'gc_leveltype'
                },
            }).done(function(data) {
                // alert(data);
                location.reload();

            });
        });
    });

    $('.delbtn').prop('disabled', true);

    $('.checkbox').change(function() {
        $('.delbtn').prop('disabled', $('.checkbox:checked').length == 0);
    })

    $('#select_all').on('click', function() {
        if (this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;

            });
        } else {
            $('.checkbox').each(function() {
                this.checked = false;

            });
        }
    });
    $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#select_all').prop('checked', true);
            $('.region_input1').addClass('no-display');
            $('.region_input').removeClass('no-display');
        } else {
            $('#select_all').prop('checked', false);
            $('.region_input1').removeClass('no-display');
            $('.region_input').addClass('no-display');
        }
    });
    $('.boxischecked').on('click', function() {

        if ($(this).prop('checked') == true) {
            $('.region_input1').addClass('no-display');
            $('.region_input').removeClass('no-display');
        } else {
            $('.region_input1').removeClass('no-display');
            $('.region_input').addClass('no-display');
        }

        checked_checkbox = Number($('input[type=checkbox].boxischecked:checked').length);
        // alert(checked_checkbox);
        if (checked_checkbox != 0) {
            $('.region_input1').addClass('no-display');
            $('.region_input').removeClass('no-display');
        } else {
            $('.region_input1').removeClass('no-display');
            $('.region_input').addClass('no-display');
        }

    });

    $('.multi_export').click(function() {

        var favorite = [];
        $.each($("input[name='checkbox']:checked"), function() {
            favorite.push($(this).val());
        });

        window.location = "<?php echo base_url();?>export/multi_export_areas?url=" + favorite;

    });

    $('.export_link').click(function() {
        // alert();
        window.location = "<?php echo base_url();?>export/export_areas";
    });
</script>