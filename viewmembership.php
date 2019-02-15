
<section class="page-content container" >
<div class="row">
<div class="col-md-12">
<div class="card">

    <h5 class="card-header">
        <div style="float:left">Membership Registration</div>
    <div style="float: right;">
        <a href="<?php echo base_url(); ?>membership/Membership/members">
    <button type="button" class="btn btn-success  btn-floating" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel">
                       <p class="text-white"  >Cancel</p>
                        </button></a>
                    </div>
                </h5>
    <div class="card-body" > 
        <form id="" action="<?php echo base_url(); ?>membership/Membership/add" enctype="multipart/form-data" method="POST" class="Memberhip_form">
            <h3>Account Creation</h3>
            <section >
                <div >
                <div class="card">
                <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Reference Details : </h5>

                <div class="card-body">
                <div class="row" style="margin-top: 4px;">
                    <div class="form-group col-md-3 enable_member_type">
                    <label for="">Registration Date</label>
                    <input type="text" class="form-control Reg_date"   name="member[Reg_date]"  placeholder="Date" value="<?php echo date('d-m-Y'); ?>">
                </div>
                <div class="form-group col-md-4 referal_error" id="referal_error">
                    <label for="">Referral ID <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-arrow-right-top zmdi-hc-fw"></i></span>
                    </div> 
                    <input type="text" maxlength="10" class="form-control" required  id="Referer_no" placeholder="Mobile or Membership ID">
                <span id="referer_error" style="color:#db3236;"></span>
                </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Referrer Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-arrow-right-top zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled id="Referer_name" placeholder="Referrer Name">
                    <input type="hidden" name="member[Reference_ID]" id="Reference_ID" placeholder="Referrer Name">
                    <input type="hidden" name="member[Register_from]" id="Register_from" value="Web">
                </div>
                </div>
                <!-- <div class="form-group col-md-4">
                   
                </div> -->
                </div>
            </div>
        </div>
                <div class="card">
                <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Personal Info :</h5>

                <div class="card-body">
                <div class="row">
                
                <div class="form-group col-md-2">
                    <label for="">Prefix <span style="color: #db3236">*</span></label>
                    <select class="form-control" required name="member[Prefix]">
                    <option value="">Select</option>
                    <option value="1">Mr</option>
                    <option value="2">Mrs</option>
                   </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">First Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required maxlength="50" name="member[First_name]"  placeholder="First Name">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">Last Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required maxlength="50" name="member[Last_name]"  placeholder="Last Name">
                </div>
            </div>
                <div class="form-group col-md-2" style="margin-top: -15px;margin-left: 50px">
                    <label for="">Profile Pic <span style="color: #db3236">*</span></label>
                    <div style="border:1px solid #000;height: 150px; width: 150px;">
                     <a href="javascript:void(0);">
                        <img id="result" src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png" style="height: 148px; width: 148px;"  alt="Profile Photo" default_src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png">
                    </a>
                </div>
                </div>
                </div>
   
                <div class="row">
                <div class="form-group col-md-2" style="margin-top: -92px;">
                    <label for="">Prefix <span style="color: #db3236">*</span></label>
                   <select class="form-control" required name="member[F_prefix]">
                   <option value="">Select</option>
                   <option value="1">Mr</option>
                   <option value="2">Mrs</option>
                   </select>
                </div>
                <div class="form-group col-md-3" style="margin-top: -92px;">
                    <label for="">Father/Spouse First Name <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required maxlength="50" name="member[F_f_name]"  placeholder="Father/Spouse First Name">
                </div>
            </div>
                <div class="form-group col-md-3" style="margin-top: -92px;">
                    <label for="">Father/Spouse Last Name <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required maxlength="50" name="member[F_l_name]"  placeholder="Father/Spouse Last Name">

                </div>
            </div>
                </div>
                <div class="row" style="margin-top: -25px;">
                
                <div class="form-group col-md-5" style=" margin-top:     20px">
                     <label for="">Gender : </label>   <br>
                     <center>
                    <label  class="control control-outline control-success control--radio offer_type_select" >Male <input type="radio" class="offer_type_select money_add"  name="member[Gender]" value="Male" required  checked="checked" autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>
                    <label  class="control control-outline control-success control--radio offer_type_select" >Female <input type="radio" class="offer_type_select money_add"  name="member[Gender]" required value="Female"  autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>
                    <label  class="control control-outline control-success control--radio offer_type_select" >Transgender <input type="radio" class="offer_type_select money_add"  name="member[Gender]" required value="Transgender"  autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>
                    </center>
                </div>
                <div class="form-group col-md-3" style="margin-top:10px">
                 <label for="">Applicant Photo <span style="color: #db3236">*</span></label>
                 <div class="custom-file">
                    <span class="">
                    <input type="file" id="file" required class="form-control" name="Photo">
                    </span>
                </div>
                </div>
                </div>
                 <div class="row" style="margin-top: 4px; margin-bottom: 15px">
                    <div class="form-group col-md-4" >
                    <label for="">DOB <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required name="member[DOB]" id="DOB" placeholder="dd-mm-yyyy">
                </div>
            </div>
                <div class="form-group col-md-4" >
                    <label for="">Mobile No <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-phone zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required pattern="[6-9]{1}[0-9]{9}" maxlength="10" id="mobile_duplicate" onkeypress="return isNumber(event)" name="member[Mobile]"  placeholder="Mobile No">
               
                </div>
                 <span id="mobile_duplicate_text" style="color:#db3236;"></span>
            </div>
                <div class="form-group col-md-4">
                    <label for="">Email Id <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-email zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required name="member[Email]"  placeholder="Email-Id">
                </div>
            </div>
                </div>
            </div>
        </div>
                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Communication Address :</h5>
                <div class="card-body">
                <div class="row" style="margin-top: 4px; margin-bottom: 15px">
                <div class="form-group col-md-3">
                    <label for="">Pincode <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required maxlength="6" pattern="[1-9]{1}[0-9]{5}" id="Pincode" onkeypress="return isNumber(event)" name="address_data[Pincode]"  placeholder="Pincode">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">Taluk <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                  <input type="text" class="form-control " required id="taluka"   placeholder="Taluk">
                   <input type="hidden" class="form-control " id="taluka_id" name="address_data[Area]">
                </div>
            </div>
            <div class="form-group col-md-3">
                    <label for="">City <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required id="city"   placeholder="City">
                    <input type="hidden" class="form-control " id="city_id" name="address_data[City]">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">State <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required id="state"   placeholder="State">
                    <input type="hidden" class="form-control " id="state_id" name="address_data[State]">
                </div>
            </div>
                
                </div>
                <div class="row" style="margin-top: 4px; margin-bottom: 15px">
                    <div class="form-group col-md-3">
                    <label for="">Country <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required id="country"   placeholder="Country">
                    <input type="hidden" class="form-control " id="country_id" name="address_data[Country]">
                </div>
            </div>
                    <div class="form-group col-md-3" >
                    <label for="">Address 1 <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required name="address_data[Address_1]"  placeholder="Address 1">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">Address 2 <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required name="address_data[Address_2]"  placeholder="Address 2">
                </div>
            </div>
            <div class="form-group col-md-3">
                    <label for="">Landmark</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " name="address_data[Landmark]"  placeholder="Landmark">
                </div>
            </div>
                <div class="form-group col-md-4">
                    
                </div>
                </div>
            </div>
        </div>

                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Residential Address :  <label style="color: #fff" class="control control-outline control-danger control--checkbox">Same as Communication Address <input type="checkbox" checked id="residential_address" > <div class="control__indicator" style="margin-top:-5px;"></div> </label></h5>

                <div class="card-body">
                <div class="row" style="margin-top: 4px;margin-bottom: 12px;">
                <div class="form-group col-md-3">
                    <label for="">Pincode <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>

                    <input type="text" class="form-control enable_residential" disabled  maxlength="6" pattern="[1-9]{1}[0-9]{5}" id="C_Pincode" onkeypress="return isNumber(event)" name="address_data[C_pincode]"  placeholder="Pincode">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">Taluk <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>

                     <input type="text" class="form-control enable_residential" disabled  id="C_taluka" name="C_Taluk"  placeholder="Taluk">
                   <input type="hidden" class="form-control enable_residential" id="C_Taluk_id" name="C_Taluk_id">
                </div>
            </div>
            <div class="form-group col-md-3">
                    <label for="">City <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control  enable_residential" id="C_city" disabled name="address_data[C_city]"  placeholder="City">
                    <input type="hidden" class="form-control  enable_residential" disabled name="address_data[C_city_id]" id="C_city_id"  placeholder="City">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">State <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control  enable_residential" id="C_state" disabled name="address_data[C_state]"  placeholder="State">
                    <input type="hidden" class="form-control  enable_residential" disabled name="address_data[C_state_id]" id="C_state_id"  placeholder="State">
                </div>
            </div>
               
                </div>
                <div class="row" style="margin-top: 4px; margin-bottom: 15px">
                     <div class="form-group col-md-3">
                    <label for="">Country <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"  id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control  enable_residential" id="C_country" disabled name="address_data[C_country]" id="C_country"  placeholder="Country">
                    <input type="hidden" class="form-control  enable_residential" disabled name="address_data[C_country_id]" id="C_country_id"  placeholder="Country">
                </div>
            </div>
                    <div class="form-group col-md-3" >
                    <label for="">Address 1 <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control  enable_residential" disabled name="address_data[C_address_1]" id="C_address_1"   placeholder="Address">
                </div>
            </div>
                <div class="form-group col-md-3">
                    <label for="">Address 2 <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control enable_residential " disabled name="address_data[C_address_2]"  placeholder="Address">
                </div>
            </div>

                <div class="form-group col-md-3">
                    <label for="">Landmark</label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-pin zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control enable_residential " disabled name="address_data[C_landmark]" placeholder="Landmark">
                </div>
            </div>
                </div>
            </div>
        </div>
                 <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Nominee Details : </h5>

                <div class="card-body">
                <div class="row" style="margin-top: 4px;">
                <div class="form-group col-md-4">
                    <label for="">Nominee Name <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control " required name="nominee_data[Nominee_name]"  placeholder="Nominee Name">
                </div></div>
                <div class="form-group col-md-4">
                    <label for="">Relationship <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i></span>
                    </div>
                   <input type="text" class="form-control " required name="nominee_data[Nominee_relationship]"  placeholder="Relationship">
                </div></div>
                <div class="form-group col-md-4">
                    <label for="">Contact No <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-phone zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required pattern="[6-9]{1}[0-9]{9}" maxlength="10" onkeypress="return isNumber(event)" name="nominee_data[Nominee_mobile]"  placeholder="Contact No">

                    
                    <!-- <button type="button" class="btn btn-primary delbtn" onclick="mobile_verify();" >check</button> -->
                                 
                    
                    
                </div>
                </div>
                </div>
            </div>
        </div>
            </div>
            </section>
            <h3>Bank Details</h3>
            <section>
                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Bank Details : </h5>

                <div class="card-body">
                <div class="row">
                 <div class="form-group col-md-6">
                    <label for="2">Bank Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-balance zmdi-hc-fw"></i></span>
                    </div>
                   <select class="form-control" required name="bank_data[Bank_ID]" id="exampleFormControlSelect1">
                    <option value="">Select Bank</option>
                    <?php foreach ($bank as $key => $bankvalue) { ?>
                       <option value="<?php echo $bankvalue['ID'] ?>"><?php echo $bankvalue['Bank_name'] ?></option>
                     <?php } ?>
                </select>
                </div>
            </div>
                <div class="form-group col-md-6">
                    <label for="1">Account Holder Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-account zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" onkeydown="upperCaseF(this)" maxlength="30" name="bank_data[Account_holder]" id="Account_holder" required placeholder="Account Holder Name">
                </div>
            </div>
               
                <div class="form-group col-md-6">
                    <label for="3">Account Number <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-format-list-numbered zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" required maxlength="18" onkeypress="return isNumber(event)" name="bank_data[Account_no]" id="3" placeholder="Account Number">
                </div>
            </div>
              
                <div class="form-group col-md-6">
                    <label for="branchname">Branch Name <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="la la-bank"></i></span>
                    </div>
                    <input type="text" class="form-control" onkeydown="upperCaseF(this)" required maxlength="30" name="bank_data[Branch]" id="branchname" placeholder="Branch Name">
                </div>
            </div>
              <div class="form-group col-md-6">
                    <label for="4">IFSC Code <span style="color: #db3236">*</span></label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="zmdi zmdi-format-list-numbered zmdi-hc-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" onkeydown="upperCaseF(this)" required maxlength="14" name="bank_data[IFSC]" id="4" placeholder="IFSC Code">
                </div>
            </div>
                </div>
            </div>
        </div>
            </section>
            <h3>Document Upload</h3>
            <section>
                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Uploads : </h5>

                <div class="card-body">
                 <div class="row">
                <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">PAN Number <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="la la-bank"></i></span>
                    </div>
                    <input type="hidden"  name="upload_data_1[Document_type]" value="Pan">
                    <input type="text" minlength="10" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" onkeydown="upperCaseF(this)" required class="form-control" name="upload_data_1[Document_no]"  placeholder="PAN Number">
                </div>
            </div>
                <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">Upload Pan Photo <span style="color: #db3236">*</span></label>
                 <div class="custom-file">
                 <input type="file" id="Pan_image" required onchange="panchange(this)" class="form-control" name="upload1">
                 </div>
                </div>
                <div class="form-group col-md-2" style="margin-left: 86px">
                    <label for=""></label>
                     <a href="javascript:void(0);">
                        <img id="imagePreview2" src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png" style="height: 100px; width: 100px;"  alt="company logo" default_src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png">
                 </a>
             </div>
             <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">Aadhaar Number <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="la la-bank"></i></span>
                    </div>
                    <input type="hidden" name="upload_data_2[Document_type]" value="Aadhar">
                    <input type="text" class="form-control" required onkeypress="return isNumber(event)" minlength="12" maxlength="12" name="upload_data_2[Document_no]"  placeholder="Aadhar Number">
                </div>
            </div>
                <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">Upload Aadhaar Photo <span style="color: #db3236">*</span></label>
                 <div class="custom-file">
                 <input type="file" id="Aadhar_image" required onchange="aadharchange(this)" class="form-control" name="upload2">
                 </div>
                </div>
                <div class="form-group col-md-2" style="margin-top: 5px;margin-left: 86px">
                    <label for=""></label>
                     <a href="javascript:void(0);">
                        <img id="imagePreview3" src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png" style="height: 100px; width: 100px;"  alt="company logo" default_src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png">
                    </a>
                </div>
                <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">Cancelled Cheque Leaf No <span style="color: #db3236">*</span></label>
                     <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-icon-addon1"><i class="la la-bank"></i></span>
                    <input type="hidden" name="upload_data_3[Document_type]" value="Cheque">
                    </div>
                    <input type="text" onkeydown="upperCaseF(this)" class="form-control" maxlength="6" minlength="6" name="upload_data_3[Document_no]" required placeholder="Cheque Leaf No">
                    <input type="hidden" name="upload_rows" value="1,2,3">

                </div>
            </div>
                <div class="form-group col-md-4" style="margin-top:10px;">
                    <label for="">Upload Cheque Leaf Photo <span style="color: #db3236">*</span></label>
                 <div class="custom-file">
                 <input type="file" id="Cheque_image" required onchange="chequechange(this)" class="form-control" name="upload3">
                 </div>
                </div>
                <div class="form-group col-md-2" style="margin-top: 5px;margin-left: 86px">
                    <label for=""></label>
                     <a href="javascript:void(0);">
                        <img id="imagePreview4" src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png" style="height: 100px; width: 100px;"  alt="company logo" default_src="<?php echo base_url(); ?>attachments/users_image/default_profile_image.png">
                    </a>

                </div>
                </div>
            </div>
        </div>
            </section>
            <h3>Account Info</h3>
            <section >
                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Account Details : </h5>

                    <div class="card-body">
                <div class="row">
                 <div class="form-group col-md-4">
                     <label for="" style="display:block">Membership Type : </label> 
                     
                    <label  class="control control-outline control-success control--radio offer_type_select" >Premium Membership<input type="radio" class="Membership_type"  name="contract_data[Membership_type]" checked="" value="1" id="stateRadio_1" autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>
                    
                </div>

                <div class="form-group col-md-4 enable_member_type">
                   <label for="">Invest Type <span style="color: #db3236">*</span></label>
                   <select class="form-control enable_member_type" id="member_invest_type" name="contract_data[Invest_type_ID]">
                    <option value="">Select Invest Type</option>
                    <?php if(!empty($invest_type)){foreach ($invest_type as $key => $invest) { ?>
                       <option value="<?php echo $invest['ID'] ?>"><?php echo $invest['Invest_name'] ?></option>
                     <?php } }?>
                   </select>
                <input type="hidden" name="contract_data[Old_payout_ID]" id="Old_payout_ID" value="" >
                <input type="hidden" name="contract_data[New_payout_ID]" id="New_payout_ID" value="" >
                <input type="hidden" name="contract_data[Payout_status]" id="Payout_status" value="1" >
                <input type="hidden" name="contract_data[Date]" value="<?php echo date('Y-m-d'); ?>" >

                </div>
                <div class="form-group col-md-4 enable_member_type">
                   <label for="">Membership Top-up <span style="color: #db3236">*</span></label>
                   <select class="form-control enable_member_type member_topup" id="member_topup" name="contract_data[Topup_id]">
                    <option value="">Select Top-up</option>
                    
                   </select>
                <input type="hidden" name="contract_data[Old_payout_ID]" id="Old_payout_ID" value="" >
                <input type="hidden" name="contract_data[New_payout_ID]" id="New_payout_ID" value="" >
                <input type="hidden" name="contract_data[Payout_status]" id="Payout_status" value="1" >
                <input type="hidden" name="contract_data[Date]" value="<?php echo date('Y-m-d'); ?>" >

                </div>
                <div class="form-group col-md-4 enable_member_type">
                    <label for="">Top-up Details <span style="color: #db3236">*</span></label>
                    <textarea type="text" class="form-control enable_member_type" readonly rows="3" id="topup_detail"   placeholder="Top-up Details"></textarea>
                </div>
                <div class="form-group col-md-8 enable_member_type" style="margin-top:13px">
                     <label for="" style="display:block">Membership Payout : </label> 
                     <?php $m=1;if(!empty($payout)){foreach($payout as $payouts){ ?> 
                    <label  class="control control-outline control-success control--radio membership_payout" ><?php echo ucfirst(strtolower($payouts["payout_type"])); ?> <input type="radio" class="Membership_payout enable_member_type" id="payouts_<?php echo $payouts["id"]; ?>" name="Membership_payout"  value="<?php echo $payouts["id"]; ?>"  autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>   
                    <?php $m++;} } ?>
                              
                </div>
                
                <div class="form-group col-md-4" >
                    <label for=""></label>
                    <!-- <input type="text" class="form-control" readonly name="member[Prefix_1]"  placeholder="Referrer Name"> -->
                </div>
                </div>
            </div>
        </div>
                <input type="hidden" name="details_count" value="1" class="details_count">
                <input type="hidden"  class="unique_id" name="unique_id" value="1" >
                <div class="card enable_member_type">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Payment Mode : </h5>

                <div class="card-body">
                <div class="row root enable_member_type" id="1">
                    <div class="form-group col-md-3 enable_member_type">
                   <label for="">Payment Type <span style="color: #db3236">*</span></label>
                   <select class="form-control enable_member_type" name="payment_data_1[Payment_type_ID]" required="">
                    <option value="">Select Payment Type</option>
                     <?php if(!empty($payment_mode)){foreach ($payment_mode as $key => $paymentvalue) { ?>
                       <option value="<?php echo $paymentvalue['ID'] ?>"><?php echo $paymentvalue['Payment_mode'] ?></option>
                     <?php } }?>
                   </select>
                </div><div class="form-group col-md-3 enable_member_type">
                    <label for="2">Bank Name <span style="color: #db3236">*</span></label>
                   <select class="form-control enable_member_type" name="payment_data_1[Bank_ID]" required>
                    <option value="">Select Bank</option>
                    <?php if(!empty($bank)){foreach ($bank as $key => $bankvalue) { ?>
                       <option value="<?php echo $bankvalue['ID'] ?>"><?php echo $bankvalue['Bank_name'] ?></option>
                     <?php } }?>
                </select>
                </div>
                <div class="form-group col-md-3 enable_member_type">
                    <label for="">Reference No <span style="color: #db3236">*</span></label>
                    <input type="text" class="form-control enable_member_type"  name="payment_data_1[Reference_no]" required placeholder="Reference No">
                </div>
                 <div class="form-group col-md-3 enable_member_type">
                    <label for="">Date</label>
                    <input type="text" class="form-control payment_date payment_date_1 enable_member_type"   name="payment_data_1[Date]"  placeholder="Date" value="<?php echo date('d-m-Y'); ?>">
                </div>
                <div class="form-group col-md-3 enable_member_type">
                    <label for="">Amount <span style="color: #db3236">*</span></label>
                    <input type="text" class="form-control only_number payment_amount_1 Payment_amount enable_member_type" required name="payment_data_1[Amount]"  placeholder="Amount">
                </div>
                <div class="form-group col-md-4 enable_member_type">
                    <label for="">Remarks </label>
                    <textarea type="text" class="form-control enable_member_type"  name="payment_data_1[Remarks]"  placeholder="Remarks"></textarea>
                </div>
                <div class="form-group col-md-2" style="margin-top:28px;">
                   <button class="btn btn-info add_new_row" type="button" style="padding: 4px;"><i class="zmdi zmdi-plus zmdi-hc-fw" style="color: white;"></i></button>
                </div>

                </div>
                <div id="new_row_div">
                    
                </div>
                 </div>
                 <div class="card-footer">
                     <h5 class="" style="color: #dc3545;margin-top:5px;float:right;">Balance : <span id="balance_pay" class="balance_pay">0</span></h5>
                     <input type="hidden" class="balance_pay" value="0">
                 </div>
                </div>
                <div class="card">
                    <h5 class="card-header" style="color: #fff;background: #1e5598; font-size: 12px">Franchisee Agreement : </h5>

                    <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                     <!-- <label for="" style="display:block"> Franchisee Agreement : </label>  -->
                    <label  class="control control-outline control-success control--radio offer_type_select1" >By Hand <input type="radio" checked class="franchisee_radio "  name="agreement_data[Delivery_mode]" value="1" id="stateRadio5" autocomplete="off" style=""> <div class="control__indicator"></div> 
                    </label>    
                    <label  class="control control-outline control-success control--radio offer_type_select1" >Deliver to Authorized person<input type="radio" class="franchisee_radio "  name="agreement_data[Delivery_mode]" value="2"  autocomplete="off" style=""> <div class="control__indicator"></div> 
                    <label  class="control control-outline control-success control--radio offer_type_select1" >Courier<input type="radio" class="franchisee_radio"  name="agreement_data[Delivery_mode]" value="3"  autocomplete="off" style=""> <div class="control__indicator"></div>
                    </label>            
                </div>

                <div class="form-group col-md-4 enable_authorize_person" style="display:none;" >
            <!-- <label>Mobile <span style="color: #db3236">*</span></label> -->
            <label>Mobile <span style="color: #db3236"></span></label>
            <input type="text" class="form-control enable_authorize_person" name="agreement_data[Mobile]" id="mobile_authorize" placeholder="Mobile or Membership ID">
            <span id="referer_error_1" style="color:#db3236;"></span>
            </div>
            <div class="form-group col-md-4 enable_authorize_person" style="display:none;" >
            <!-- <label for="">Name <span style="color: #db3236">*</span></label> -->
            <label for="">Name <span style="color: #db3236"></span></label>
            <input type="text" class="form-control enable_authorize_person" id="enable_authorized_person"  name="agreement_data[Referer_name]" readonly="" placeholder="Name">
            <input type="hidden" name="agreement_data[Referal_ID]" id="enable_authorized_person_id" val="">
            </div>
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <!-- <label for="">Courier Name  <span style="color: #db3236">*</span></label> -->
                    <label for="">Courier Name  <span style="color: #db3236"></span></label>
                    <input type="text" class="form-control enable_courier"  name="agreement_data[Courier_name]"  placeholder="Ex:Speed post,Bludart">
                </div>
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <!-- <label for="">Reference No  <span style="color: #db3236">*</span></label> -->
                    <label for="">Reference No  <span style="color: #db3236"></span></label>
                    <input type="text" class="form-control enable_courier"  name="agreement_data[Reference_no]"  placeholder="Reference No">
                </div>
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <!-- <label for="">Date  <span style="color: #db3236">*</span></label> -->
                    <label for="">Date  <span style="color: #db3236"></span></label>
                    <input type="text" class="form-control courier_date enable_courier"  name="agreement_data[Date]" id="courier_date" placeholder="dd-mm-yyyy">
                </div>
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <!-- <label for="">Address <span style="color: #db3236">*</span></label> -->
                    <label for="">Address <span style="color: #db3236"></span></label>
                    <input type="text" class="form-control enable_courier"  name="agreement_data[Address]"  placeholder="Address">
                </div>
                
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <!-- <label for="">Landmark <span style="color: #db3236">*</span></label> -->
                    <label for="">Landmark <span style="color: #db3236"></span></label>
                    <input type="text" class="form-control enable_courier"  name="agreement_data[Landmark]"  placeholder="Landmark">
                </div>
                <div class="form-group col-md-4 enable_courier" style="display:none;" >
                    <label for="">Alternate Number</label>
                    <input type="text" class="form-control"  name="agreement_data[Mobile]"  placeholder="Alternate No" >
                </div>
                <div class="col-md-12 form-group enable_authorize_person" style="display:none;margin-top:5px;">
                        <label class="control control-outline control-success control--checkbox ">On behalf of me,I authorize <span id="enable_authorized_person_2" style="color:green;"></span> to recieve my franchisee agreement document and cheque leaf.
                                            <input type="checkbox" class="statement_radio enable_authorize_person">
                                            <div class="control__indicator"></div>
                                        </label>
                    </div>
                </div>
            </div>
        </div>
                    <div class="card">
                    <div class="card-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label class="control control-outline control-success control--checkbox">Agree Terms & Conditions
                                            <input type="checkbox" required class="terms_radio" value="1" name="member[Terms_status]">
                                            <div class="control__indicator"></div>
                                        </label>
                                        
                    </div>
                </div>
            </div>
        </div>

         </section>
        </form>
</div>
</div>
</div>
</section>

<div class="modal fade" id="terms_modal" tabindex="-1" role="dialog"  data-modal="scroll"   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel9">Terms & Conditions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="zmdi zmdi-close"></span>
            </button>
         </div>
         
      <div class="modal-body" >
<h4 class="modal-title">Ultra Supercharge - Terms of Offer</h4>

<p>By placing an order through this website, you agree to the terms and conditions set for the below. Please read through these terms carefully before placing your order and print a copy for future reference. Please also read our Privacy Policy regarding personal information provided by you, which is incorporated herein by reference. </p>

<h4 class="modal-title">Health Disclaimer</h4>

<p>Any statements on this site or any materials or supplements distributed or sold by UltraMuscleBoost.com have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure or prevent any disease. If you are pregnant, nursing, taking medication, or have a history of heart conditions we suggest consulting with a physician before using any of our products. The results on all products are not typical and not everyone will experience these results. </p>

<h4 class="modal-title">How Does the Auto-Ship Trial Offer Work?</h4>
<p>You will receive the product for free; however, you must pay Postage and Packaging of Â£3.50 for us to send you a 14 day trial supply of Ultra Supercharge. We ship the product the day after you place your order (except that orders placed Friday-Sunday will be shipped the following Monday). We consider the end date for your trial period to be 14 days after you place your order.</p> 

<p>B. If you do not call customer service to cancel within 14 days of ordering your free trial, you will continue with our auto-ship program. See details below.</p> 

<h4 class="modal-title">Auto-Ship Program</h4>

<p>Unless you cancel before the end of your trial period as specified above, we will ship your first 30-day supply of Ultra Supercharge at the end of your trial period. Thereafter, you will continue to receive a fresh 30-day supply of Ultra Supercharge each month for as long as you stay a member of our auto-ship program. The card you provided when you ordered the trial product will be automatically charged Â£79.50 per product ordered when each new product ships. To cancel future shipments in the auto-ship program, you must call 0800 0239116 at least 1 day prior to the date that your next monthly delivery ships. Our customer service centre open Monday to Friday 8am-4pm.</p> 

<h4 class="modal-title">Ultra Supercharge Guarantee:</h4>
<p>Return Policy for Auto-Ship Deliveries</p>

<p>Ultra Supercharge retains a total guarantee of customer satisfaction on all Ultra Supercharge auto-ship products. If you, the buyer, are unhappy with the product for any reason â€” even if you've used the full supply of the supplementâ€” you can return the empty bottle for a full refund of the purchase price minus shipping and handling. To obtain your refund, you must do the following: Call us at 0800 0239116 24 hours a day. You will be given a Return Merchandise Authorisation (RMA) number. To receive your refund, your return must be received at our shipping facility within 30 days of purchase. Be sure to clearly write the return merchandise authorisation (RMA) number on the outside of the box. Our shipping department is NOT allowed to accept any packages without an RMA number. You pay for return delivery costs. </p>


<p>Limitation of Actions- You acknowledge and agree that, regardless of any statute or law to the contrary, any claim or cause of action you may have arising out of, relating to, or connected with your use of the Web Site, must be filed within one calendar year after such claim or cause of action arises, or forever be barred. </p>

<p>Modification of Terms of Service- We reserve the right to change or modify these Terms of Use at any time and your continued use of this site will be conditioned upon the Terms of Use in force at the time of your use. You can always check the most current version of the Terms of Use at this page.</p> 

<p>Please feel free to contact us, if you have any questions regarding our terms of service. </p>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="accept_terms">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="reject_terms">No</button>        
      </div>
      </div>
   </div>
</div>
<script type="text/javascript">
 var payout_id="";
 var balance_pay=0;
 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script type="text/javascript">
$(document).ready(function() {
        $('#DOB').datepicker();
        $('.payment_date_1').datepicker();
        $('.Reg_date').datepicker();
        

        $('#courier_date').datepicker();
        // $('.payment_date_1').datepicker();

$("#Referer_no").change(function(e){
     referer=$("#Referer_no").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_referer_by_code",
            data: {referer: referer},
            cache: true,
            dataType:"json",
            async: false,
            success: function(data){
             // console.log(data);
             if (data['data']['referer']==0) {
                $("#Referer_no").focus().val("");
                $("#Referer_name").css("background","#f39681");
                $("#referer_error").text("Incorrect Membership Code");
                $("#Referer_name").val("");
                $("#Reference_ID").val("");
                
            }else{
                $("#referer_error").text("");
                $("#Referer_name").css("background","#b2f381");
                $("#Referer_name").val(data['data']['referer'][0]['First_name']+" "+data['data']['referer'][0]['Last_name']+" - ["+data['data']['referer'][0]['Membership_code']+"]");
                $("#Reference_ID").val(data['data']['referer'][0]['Membership_ID']);
                $("#Referer_name").css("background","#b2f381");
             }
                
            }
            });
});

$("#mobile_authorize").change(function(e){
     referer=$("#mobile_authorize").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_referer_by_code",
            data: {referer: referer},
            cache: true,
            dataType:"json",
            async: false,
            success: function(data){
             // console.log(data);
             if (data['data']['referer']==0) {
                $("#mobile_authorize").focus().val("");
                $("#enable_authorized_person").css("background","#f39681");
                $("#referer_error_1").text("Incorrect Membership Code");
                $("#enable_authorized_person").val("");
                $("#enable_authorized_person_id").val("");
                $("#enable_authorized_person_2").text("___");
                
            }else{
                $("#referer_error_1").text("");
                $("#enable_authorized_person").css("background","#b2f381");
                $("#enable_authorized_person").val(data['data']['referer'][0]['First_name']+" "+data['data']['referer'][0]['Last_name']+" - ["+data['data']['referer'][0]['Membership_code']+"]");
                $("#enable_authorized_person_id").val(data['data']['referer'][0]['Membership_ID']);
                $("#enable_authorized_person_2").text(data['data']['referer'][0]['First_name']+" "+data['data']['referer'][0]['Last_name']);
                $("#enable_authorized_person").css("background","#b2f381");
             }
                
            }
            });
});


$("#C_Pincode").change(function(e){
    // alert();
     pincode=$("#C_Pincode").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_pincode_details",
            data: {pincode: pincode},
            cache: true,
            dataType:"json",
            async: false,
            success: function(data){
             alert(data);
             if (data['data']['pincode']=="") {

                $("#C_Pincode").text("Incorrect Membership Code");
                $("#C_taluka").val("");
                $("#C_taluka_id").val("");

                $("#C_city").text("Incorrect Membership Code");
                $("#C_city").val("");
                $("#C_city_id").val("");

                $("#C_state").text("Incorrect Membership Code");
                $("#C_state").val("");
                $("#C_state_id").val("");

                $("#C_country").text("Incorrect Membership Code");
                $("#C_country").val("");
                $("#C_country_id").val("");
                
            }else{
                $("#taluka").text("");

                $("#C_taluka").val(data['data']['pincode'][0]['taluk_name']);
                $("#C_taluka_id").val(data['data']['pincode'][0]['taluk_id']);

                 $("#C_city").text("");

                $("#C_city").val(data['data']['pincode'][0]['City_name']);
                $("#C_city_id").val(data['data']['pincode'][0]['City_id']);

                 $("#C_state").text("");

                $("#C_state").val(data['data']['pincode'][0]['State_name']);
                $("#C_state_id").val(data['data']['pincode'][0]['State_id']);

                 $("#C_country").text("");

                $("#C_country").val(data['data']['pincode'][0]['Country_name']);
                $("#C_country_id").val(data['data']['pincode'][0]['Country_id']);
             }
                
            }
            });
});


$("#Pincode").change(function(e){
    // alert();
     pincode=$("#Pincode").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_pincode_details",
            data: {pincode: pincode},
            cache: true,
            dataType:"json",
            async: false,
            success: function(data){
             // alert(data);
             if (data['data']['pincode']=="") {

                $("#taluka").text("Incorrect Membership Code");
                $("#taluka").val("");
                $("#taluka_id").val("");

                $("#city").text("Incorrect Membership Code");
                $("#city").val("");
                $("#city_id").val("");

                $("#state").text("Incorrect Membership Code");
                $("#state").val("");
                $("#state_id").val("");

                $("#country").text("Incorrect Membership Code");
                $("#country").val("");
                $("#country_id").val("");
                
            }else{
                $("#taluka").text("");

                $("#taluka").val(data['data']['pincode'][0]['taluk_name']);
                $("#taluka_id").val(data['data']['pincode'][0]['taluk_id']);

                 $("#city").text("");

                $("#city").val(data['data']['pincode'][0]['City_name']);
                $("#city_id").val(data['data']['pincode'][0]['City_id']);

                 $("#state").text("");

                $("#state").val(data['data']['pincode'][0]['State_name']);
                $("#state_id").val(data['data']['pincode'][0]['State_id']);

                 $("#country").text("");

                $("#country").val(data['data']['pincode'][0]['Country_name']);
                $("#country_id").val(data['data']['pincode'][0]['Country_id']);
             }
                
            }
            });
});

$("#mobile_duplicate").change(function(e){
    // alert($("#mobile_duplicate").val());
     mobile=$("#mobile_duplicate").val();

           $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>master/location/duplicate_check",
            data: {
                data: mobile,
                table_name: 'gc_membership',
                colum: 'Mobile'
            },
            cache: true,
            async: false,
            success: function(data) {
                // alert(data);
                result = data;
            }
            });
            if (result == 1) {

                $("#mobile_duplicate").focus().val("");
                $("#mobile_duplicate_text").text("Mobile Number Already Used");
                $("#mobile_duplicate").val("");
                
            }else{
                $("#mobile_duplicate_text").text("");
            }
});


$("#member_invest_type").change(function(e){
    invest_type=$("#member_invest_type").val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_topup_list",
            data: {invest_type: invest_type},
            cache: true,
            dataType:"html",
            async: false,
            success: function(data){
                $('#member_topup').empty();           
                $('#member_topup').append(data);
                topup_details();
            }
            });
    });

$("#member_topup").change(function(e){
      topup_details();      
            
});

function topup_details(){
    topup=$("#member_topup").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>membership/Membership/get_topup_details",
            data: {topup: topup},
            cache: true,
            dataType:"json",
            async: false,
            success: function(data){
             // console.log(data); 
             // alert(data['data']['topup']);
             if (data['data']['topup']==0) {
                $("#Old_payout_ID").val("");
                $("#New_payout_ID").val("");
                $("#Payout_status").val("1");
                payout_id="";
                $("#topup_detail").text("");
                $(".balance_pay").text("");
                $(".balance_pay").val("");
  
                balance_pay=0;
                $('.Membership_payout').prop('checked',false);
            }else{
                $textcontent="Investment Amount : "+data['data']['topup'][0]['Value']+"\n"+" Validity : "+data['data']['topup'][0]['Validity']+ " Months,\n Return % : "+data['data']['topup'][0]['Return']+" %.";
                payout_id=data['data']['topup'][0]['Payout_type'];
                $("#Old_payout_ID").val(data['data']['topup'][0]['Payout_type']);
                $(".balance_pay").text(data['data']['topup'][0]['Value']);
                $(".balance_pay").val(data['data']['topup'][0]['Value']);
                balance_pay=data['data']['topup'][0]['Value'];
                $("#payouts_"+data['data']['topup'][0]['Payout_type']).prop("checked",true);
                $("#topup_detail").text($textcontent);

                // $("#Reference_ID").val(data['data']['topup'][0]['Membership_ID']);
             }
                
            }
            });
}

 $('.Membership_payout').on('click', function() {
    if(payout_id==""){
        swal('Please Select Top-up !');
        $('.Membership_payout').prop('checked',false);
    }else{
        if ($('.Membership_payout:checked').val() != payout_id) {
    new_payout=$('.Membership_payout:checked').val();
   
    swal({
               title: 'Are you sure?',
               text: "Are you sure about this change?",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, Change it!',
               allowOutsideClick: false
            }),
            $(".swal2-confirm").click(function(){
               $("#New_payout_ID").val(new_payout);
               $("#Payout_status").val("2");
                $("#payouts_"+new_payout).prop("checked",true);
               swal(
                  'Changed!',
                  'Your Payout has been Changed.',
                  'success'
               );
            });
            $(".swal2-cancel").click(function(){
                $("#payouts_"+payout_id).prop("checked",true);
                $("#New_payout_ID").val("");
                $("#Payout_status").val("1");
                 swal(
                  'Canceled!',
                  'Action  Canceled.',
                  'error'
               );


            })

}
    }
    

});




        


    $("#file").change(function(e){
        // alert();
        var img = e.target.files[0];

        if(!iEdit.open(img, true, function(res){
           // alert(res);
            $("#result").attr("src", res);          
        })){
            swal("Whoops! That is not an image!");
            $("#file").val('');
        }

    });

// $(".Payment_amount").on("keyup",function(e){
$(document).on('change', '.Payment_amount', function(e) {
var id = $(this).parents('.root').attr('id');
range_quantity(id);
calculate_total();
 });

var count = 1;
$(document).on('click', '.add_new_row', function(e) {
            // alert();

pay=parseFloat($(".balance_pay").text());

  
  $('.details_count').val( function(i, oldval) {
      return parseInt( oldval, 10) + 1;
  });
if(pay >0){
   count = count+1;
  $("#new_row_div").append(
   ''
   +'<div class="row root" id="'+count+'">'
+'<div class="form-group col-md-3">'
+'<label for="">Payment Type <span style="color: #db3236">*</span></label>'
+'<select class="form-control enable_member_type" name="payment_data_'+count+'[Payment_type_ID]">'
+'<option value="">Select Payment Type</option>'
+'<?php if(!empty($payment_mode)){foreach ($payment_mode as $key => $paymentvalue) { ?>'
+'<option value="<?php echo $paymentvalue['ID'] ?>"><?php echo $paymentvalue['Payment_mode'] ?></option>'
+'<?php } }?>'
+'</select>'
+'</div><div class="form-group col-md-3">'
+'<label for="2">Bank Name <span style="color: #db3236">*</span></label>'
+'<select class="form-control enable_member_type" name="payment_data_'+count+'[Bank_ID]" id="exampleFormControlSelect1">'
+'<option value="">Select Bank</option>'
+'<?php if(!empty($bank)){foreach ($bank as $key => $bankvalue) { ?>'
+'<option value="<?php echo $bankvalue['ID'] ?>"><?php echo $bankvalue['Bank_name'] ?></option>'
+'<?php } }?>'
+'</select>'
+'</div>'
+'<div class="form-group col-md-3">'
+'<label for="">Reference No <span style="color: #db3236">*</span></label>'
+'<input type="text" class="form-control enable_member_type" name="payment_data_'+count+'[Reference_no]"  placeholder="Reference No">'
+'</div>'
+'<div class="form-group col-md-3">'
+'<label for="">Date <span style="color: #db3236">*</span></label>'
+'<input type="text" class="form-control enable_member_type payment_date payment_date_'+count+'"   name="payment_data_'+count+'[Date]" placeholder="Date" value="<?php echo date('d-m-Y'); ?>">'
+'</div>'
+'<div class="form-group col-md-3">'
+'<label for="">Amount <span style="color: #db3236">*</span></label>'
+'<input type="text" class="form-control payment_amount_'+count+' Payment_amount only_number enable_member_type" name="payment_data_'+count+'[Amount]"  placeholder="Amount">'
+'</div>'
+'<div class="form-group col-md-4">'
+'<label for="">Remarks </label>'
+'<textarea type="text" class="form-control enable_member_type"  name="payment_data_'+count+'[Remarks]"  placeholder="Remarks"></textarea>'
+'</div>'
+'<div class="form-group col-md-2" style="margin-top:28px;">'
+'<button class="btn btn-info add_new_row enable_member_type" type="button" style="padding: 4px;"><i class="zmdi zmdi-plus zmdi-hc-fw" style="color: white;"></i></button>'
+'<button class="btn btn-danger close_x enable_member_type" type="button" style="padding: 4px;"><i class="zmdi zmdi-close zmdi-hc-fw" style="color: white;"></i></button>'
+'</div>'
+'</div>'

);

$('.payment_date_'+count).datepicker(); 

$("#multiple_event_date_"+count).datepicker();
  var id_v = new Array();
    $(".root").each(function() {
                var value = $(this).attr('id');
                  id_v.push(value);
                 // $(".unique_id").text(value);
            });
$(".unique_id").val(id_v);

}else{
    swal("Amount Tallyed,Can't be add New Row");
}

});


$(document).on('click', '.close_x', function(e) {

   var id = $(this).parents('.root').attr('id');
   $('#'+id+'').remove();
     // dEcrement the count
      $('.details_count').val( function(i, oldval) {
          return parseInt( oldval, 10) - 1;
      });

        var id_v = new Array();
    $(".root").each(function() {
                var value = $(this).attr('id');
                  id_v.push(value);
                 // $(".unique_id").text(value);

            });
    $(".unique_id").val(id_v);
    calculate_total();
            });

    $('.franchisee_radio').on('click', function() {
        if ($('.franchisee_radio:checked').val() == 1) {
            $('.enable_authorize_person').hide();
            $('.enable_courier').hide();
            $('.enable_courier').attr('disabled','disabled');
            $('.enable_authorize_person').attr('disabled','disabled');
            $('.enable_courier').removeAttr('required','required');
            $('.enable_authorize_person').removeAttr('required','required');

        } else if ($('.franchisee_radio:checked').val() == 2){
            $('.enable_authorize_person').show();
            $('.enable_courier').hide();
            $('.enable_courier').attr('disabled','disabled');
            $('.enable_authorize_person').removeAttr('disabled');
            $('.enable_courier').removeAttr('required','required');
            $('.enable_authorize_person').attr('required');
        } else if ($('.franchisee_radio:checked').val() == 3){
            $('.enable_authorize_person').hide();
            $('.enable_courier').show();
            $('.enable_courier').removeAttr('disabled');
            $('.enable_authorize_person').attr('disabled','disabled');
            $('.enable_courier').attr('required','reqired');
            $('.enable_authorize_person').removeAttr('required');
        }
    });

    $('.terms_radio').on('click', function() {
         if ($(".terms_radio").prop('checked') == true) {
            $(".terms_radio").prop('checked',false);
            $('#accept_terms').on('click', function() {
            $("#terms_modal").modal('hide');
            $(".terms_radio").prop('checked',true);

});
            $('#reject_terms').on('click', function() {
            $("#terms_modal").modal('hide');
            $(".terms_radio").prop('checked',false);
            
});

} else {
    // alert("unchecked");
}
        $("#terms_modal").modal('show');
    });

    $('#residential_address').on('click', function() {
         if ($("#residential_address").prop('checked') == false) {
            $(".enable_residential").prop('disabled',false);

} else {
            $(".enable_residential").prop('disabled',true);
}

    });

    $('.Membership_type').on('click', function() {
        // alert();
        if ($('.Membership_type:checked').val() == 1) {
            // $('.enable_member_type').show();
            $('.enable_member_type').removeAttr('disabled');

        } else{
            // $('.enable_member_type').hide();
            $('.enable_member_type').attr('disabled','disabled');
        }
    });
    
    


    //  $('#submit_mem').click(function(){
    //     alert("1");
    //     $("#horizontal-wizard").submit();
    // });

});

// $('#Member_profile').on('change', function () {
    function profilechange(e){
    // alert(e);
    var files = e.files;
            
            if (files && files[0]) {
                readImage1(files[0], '#Member_profile');
            } else { 
                default_src = $('#imagePreview').attr('default_src');
                $('#imagePreview').attr('src', default_src);
            }
}
function readImage1(file, element) {
    // alert();
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('#imagePreview').attr('default_src');
            $('#imagePreview').attr('src', default_src);
            error = 0;
        } else {
            var reader = new FileReader();
            var image = new Image();
            reader.readAsDataURL(file);
            reader.onload = function (_file) {
                image.src = _file.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;
                    if (width < 150 || height < 150) {
                        $(element).closest('div.form-group').find('.error_msg').text('Image resolution should be higher than 150x150').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        s
                        default_src = $('#imagePreview').attr('default_src');
                        $('#imagePreview').attr('src', default_src);
                        error = 0;
                    } else {
                        $('#imagePreview').attr('src', _file.target.result);
                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            }
        }
        return error;
    }

        function panchange(e){
    // alert(e);
    var files = e.files;
            
            if (files && files[0]) {
                readImage2(files[0], '#Pan_image');
            } else { 
                default_src = $('#imagePreview2').attr('default_src');
                $('#imagePreview2').attr('src', default_src);
            }
}
function readImage2(file, element) {
    // alert();
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('#imagePreview2').attr('default_src');
            $('#imagePreview2').attr('src', default_src);
            error = 0;
        } else {
            var reader = new FileReader();
            var image = new Image();
            reader.readAsDataURL(file);
            reader.onload = function (_file) {
                image.src = _file.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;
                    if (width < 150 || height < 150) {
                        $(element).closest('div.form-group').find('.error_msg').text('Image resolution should be higher than 150x150').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        s
                        default_src = $('#imagePreview2').attr('default_src');
                        $('#imagePreview2').attr('src', default_src);
                        error = 0;
                    } else {
                        $('#imagePreview2').attr('src', _file.target.result);
                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            }
        }
        return error;
    }

     

     function aadharchange(e){
    // alert(e);
    var files = e.files;
            
            if (files && files[0]) {
                readImage3(files[0], '#Aadhar_image');
            } else { 
                default_src = $('#imagePreview3').attr('default_src');
                $('#imagePreview3').attr('src', default_src);
            }
}
function readImage3(file, element) {
    // alert();
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('#imagePreview3').attr('default_src');
            $('#imagePreview3').attr('src', default_src);
            error = 0;
        } else {
            var reader = new FileReader();
            var image = new Image();
            reader.readAsDataURL(file);
            reader.onload = function (_file) {
                image.src = _file.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;
                    if (width < 150 || height < 150) {
                        $(element).closest('div.form-group').find('.error_msg').text('Image resolution should be higher than 150x150').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        s
                        default_src = $('#imagePreview3').attr('default_src');
                        $('#imagePreview3').attr('src', default_src);
                        error = 0;
                    } else {
                        $('#imagePreview3').attr('src', _file.target.result);
                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            }
        }
        return error;
    }

    function chequechange(e){
    // alert(e);
    var files = e.files;
            
            if (files && files[0]) {
                readImage4(files[0], '#Cheque_image');
            } else { 
                default_src = $('#imagePreview4').attr('default_src');
                $('#imagePreview4').attr('src', default_src);
            }
}
function readImage4(file, element) {
    // alert();
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('#imagePreview4').attr('default_src');
            $('#imagePreview4').attr('src', default_src);
            error = 0;
        } else {
            var reader = new FileReader();
            var image = new Image();
            reader.readAsDataURL(file);
            reader.onload = function (_file) {
                image.src = _file.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;
                    if (width < 150 || height < 150) {
                        $(element).closest('div.form-group').find('.error_msg').text('Image resolution should be higher than 150x150').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        s
                        default_src = $('#imagePreview4').attr('default_src');
                        $('#imagePreview4').attr('src', default_src);
                        error = 0;
                    } else {
                        $('#imagePreview4').attr('src', _file.target.result);
                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            }
        }
        return error;
    }



function submit_member(){
    //alert('Done');
    check=$('.balance_pay').val();
    if(check!=0){
        return 0;
        //alert('Please Complete Payment Mode !');
    }else{
        return 1;  
}
}

function calculate_total(){
    // alert(balance_pay);
      var sum = 0;
        $(".Payment_amount").each(function() {
            var value = $(this).val();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
            total=balance_pay-sum;
            $(".balance_pay").text(total);
            $(".balance_pay").val(total);
        });
}

function range_quantity(id){
    
   var value = $('.payment_amount_'+id).val();
    if ((value !== '') && (value.indexOf('.') === -1)) {
        $('.payment_amount_'+id).val(Math.max(Math.min(value, $('.balance_pay').val())), -$('.balance_pay').val());
    }
}

function mobile_duplicate(){
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>membership/Membership/get_pincode_details",
    data: {pincode: '641001'},
    cache: true,
    dataType:'json',
    async: false,
    success: function(data){
     alert(data);
    result = data;
    }
    });
}

function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
    }

</script>