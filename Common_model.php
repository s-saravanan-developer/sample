<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {


	// Unique Array Result Function
	/*
		Use Like This
		$details = unique_multidim_array($details,'id'); 
	*/
	function unique_multidim_array($array, $key) { 
	    $temp_array = array(); 
	    $i = 0; 
	    $key_array = array(); 
	    
	    foreach($array as $val) { 
	        if (!in_array($val[$key], $key_array)) { 
	            $key_array[$i] = $val[$key]; 
	            $temp_array[$i] = $val; 
	        } 
	        $i++; 
	    } 
	    return $temp_array; 
	} 	


	public function download($h1,$a1,$empInfo,$name)
    {

        // create file name
        $fileName = $name.'.xls';  
        // load excel library
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // set Header
        $cnt = 0;
        for ($i=0; $i < count($h1['h1']); $i++) { 
             
        $objPHPExcel->getActiveSheet()->SetCellValue($h1['h1'][$cnt], $h1['h2'][$cnt]);
        $cnt++;
        }
       
        // set Row
       $rowCount = 2;
        
        if(!empty($empInfo)){
        foreach ($empInfo as $element) {
            $cnt_2 = 0;
             for ($i=0; $i < count($a1['a1']); $i++) {
                $objPHPExcel->getActiveSheet()->SetCellValue($a1['a1'][$cnt_2]. $rowCount, $element[$a1['a2'][$cnt_2]]);
                $cnt_2++;
            }
          
            $rowCount++;
        } }

        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
        //exit();
    }

    // get Team details
    public function get_team_details() {
        $this->db->select('*');
        $this->db->from('gc_team_details');
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    // get Batch details
    public function get_batch_number() {
        $this->db->select('*');
        $this->db->from('gc_batch_card as batch');
        $this->db->where('batch.Status', 1);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    // get customer details
    public function get_customer() {
        $this->db->select('*');
        $this->db->from('gc_customers as customer');
        $this->db->where('customer.Status', 1);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    // get Producr details
    public function get_product() {
        $this->db->select('*');
        $this->db->from('gc_products as product');
        $this->db->where('product.Status', 1);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_branch() {
        $this->db->select('*');
        $this->db->from('gc_hub_branch');        
        $this->db->where('gc_hub_branch.Status', 1);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }


    public function regionbased_team($id) {
        $this->db->select('team_d.id,team_d.team_name');
        $this->db->from('gc_team as team');
        $this->db->join('gc_hub_branch as region', 'region.id = team.region_id', 'left');
        $this->db->join('gc_team_details as team_d', 'team_d.id = team.team_detail_id', 'left');
        $this->db->where('team.Status', 1);
        $this->db->where('region.id', $id);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }


    public function regionbased_customer($id) {
        $this->db->select('customer.Customer_id as id,customer.Customer_name');
        $this->db->from('gc_customers as customer');
        $this->db->where('customer.Status!=', 3);
        $this->db->where('customer.Division_id', $id);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function transporter_number() {
        $this->db->select('*');
        $this->db->from('gc_transporter as transporter');
        $this->db->where('transporter.Status!=', 3);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function banks() {
        $this->db->select('*');
        $this->db->from('gc_banks as bank');
        $this->db->where('bank.Status',1);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_stock_quantity($region,$product,$batch)
    {
        $this->db->select('sum(stock.Quantity) as quantity');
        $this->db->from('gc_batch_stocks as stock');
        $this->db->where('stock.Batch_id',$batch);
        $this->db->where('stock.Region_id',$region);
        $this->db->where('stock.Product_id',$product);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_batch_id_as_batch_number($bat_no)
    {
        $this->db->select('batch.Batch_setting_id');
        $this->db->from('gc_batch_card as batch');
        $this->db->where('batch.Batch_no', $bat_no);
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_unit_based_on_product_id($team_id,$region_id)
    {
        $this->db->select('products.Product_id,products.Item_name');
        $this->db->from('gc_team_child as child');
        $this->db->join('gc_team as master', 'master.id = child.team_setting_id', 'left');
        $this->db->join('gc_products as products', 'products.Product_id = child.product_id', 'left');
        $this->db->where('child.Status!=', 3);
        $this->db->where('master.Status!=', 3);
        $this->db->where('master.team_detail_id', $team_id);
        // $this->db->where('master.month', date("M"));
        $this->db->where('master.region_id',$region_id);
        $this->db->group_by('products.Product_id');
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;       
    }

    public function get_product_unit($product_id)
    {
                $this->db->select('product.Product_id,product.Purchase_units,units.unit_name,units.id,super_cat.super_cat_name,super_cat.id as super_cat_id,categories.category_name,sub_cat.sub_cat_name')->from('gc_products as product');
                $this->db->join('gc_units as units', 'units.id = product.Purchase_units', 'left');
                $this->db->join('gc_super_categories as super_cat', 'super_cat.id = product.Material_type_id', 'left');
                $this->db->join('gc_categories as categories', 'categories.id = product.Category_id', 'left');
                $this->db->join('gc_sub_categories as sub_cat', 'sub_cat.id = product.Sub_cat_id', 'left');
                $this->db->where('product.Status!=', 3);
                 $this->db->where('product.company_id', $this->session->userdata('CompanyId'));
                $this->db->where('product.Product_id', $product_id);
                $query = $this->db->get();        
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                return NULL;
    }

    public function get_batch_suggession_select($region,$product)
    {
        $this->db->select('batch.Batch_setting_id,batch.Batch_no');
        $this->db->from('gc_batch_card as batch');
        $this->db->join('gc_batch_card_details as details', 'details.Batch_id = batch.Batch_setting_id', 'left');
        $this->db->where('batch.Status', 1);
        $this->db->where('details.Region_id', $region);
        $this->db->where('details.product_id', $product);
        $repeat_val  = $this->input->post('repeat_val');
        if(isset($repeat_val)){  
            $data = explode(',', $repeat_val);
            $this->db->where_not_in('batch.Batch_setting_id',$data);
        }        
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            $data =  $query->result_array();
            $select = $data[0]['Batch_setting_id'];
                if(isset($data)){
                    echo '<option>Select Batch</option>';            
                foreach ($data as $value) {
                     if($value == $select){                
                     echo '<option value="'.$value['Batch_setting_id'].'" selected>'.$value['Batch_no'].'</option>';
                     }else{
                     echo '<option value="'.$value['Batch_setting_id'].'">'.$value['Batch_no'].'</option>';
                 }
                }}else{
                    echo '<option>Select Customer</option>';            
                }
        }
        return NULL;
    }

    public function get_all_product_select()
    {
        $this->db->select('*');
        $this->db->from('gc_products as product');
        $query = $this->db->get();        
        if ($query->num_rows() > 0) {
            $data =  $query->result_array();
            $select = $data[0]['Product_id'];
                if(isset($data)){
                    // echo '<option>Select Product</option>';            
                foreach ($data as $value) {
                     if($value == $select){                
                     echo '<option value="'.$value['Product_id'].'" selected>'.$value['Item_name'].'</option>';
                     }else{
                     echo '<option value="'.$value['Product_id'].'">'.$value['Item_name'].'</option>';
                 }
                }}else{
                    // echo '<option>Select Product</option>';            
                }
        }
        return NULL;
    }

    public function batch_select_unit($product_id)
    {
                $this->db->select('product.Product_id,product.Purchase_units,units.unit_name,units.id,super_cat.super_cat_name,super_cat.id as super_cat_id,categories.category_name,sub_cat.sub_cat_name')->from('gc_products as product');
                $this->db->join('gc_units as units', 'units.id = product.Purchase_units', 'left');
                $this->db->join('gc_super_categories as super_cat', 'super_cat.id = product.Material_type_id', 'left');
                $this->db->join('gc_categories as categories', 'categories.id = product.Category_id', 'left');
                $this->db->join('gc_sub_categories as sub_cat', 'sub_cat.id = product.Sub_cat_id', 'left');
                $this->db->where('product.Status!=', 3);
                 $this->db->where('product.company_id', $this->session->userdata('CompanyId'));
                $this->db->where('product.Product_id', $product_id);
                $query = $this->db->get();        
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                return NULL;
    }


}


// SNIPPET

// TRUNCATE `gc_advice`;
// TRUNCATE `gc_advice_details`;
// TRUNCATE `gc_batch_card`;
// TRUNCATE `gc_batch_card_details`;
// TRUNCATE `gc_batch_rates`;
// TRUNCATE `gc_batch_rates_details`;
// TRUNCATE `gc_batch_stocks`;
// TRUNCATE `gc_hub_branch`;
// TRUNCATE `gc_item_stocks`;
// TRUNCATE `gc_prefix_setting`;
// TRUNCATE `gc_products`;
// TRUNCATE `gc_product_rate_setting`;
// TRUNCATE `gc_product_suppliers`;
// TRUNCATE `gc_product_units`;
// TRUNCATE `gc_purchase_details`;
// TRUNCATE `gc_purchase_table`;
// TRUNCATE `gc_schemes`;
// TRUNCATE `gc_schemes_details`;
// TRUNCATE `gc_stock_details`;
// TRUNCATE `gc_stock_transfer`;
// TRUNCATE `gc_team`;
// TRUNCATE `gc_team_child`;
// TRUNCATE `gc_transaction_prefix`;
// TRUNCATE `gc_transaction_prefix_region`;
// TRUNCATE `gc_customers`;
// TRUNCATE `gc_customer_address`;
// TRUNCATE `gc_gst`;
// TRUNCATE `gc_gst_states`;
// TRUNCATE `gc_ventors_table`;

//$Units_data['company_id']=$this->session->userdata('CompanyId');
//$Units_data['financial_yr_id']=$this->session->userdata('Financial_yr_id');


// $UserCode = $this->session->userdata('UserCode');
// $UserId = $this->session->userdata('UserId');
// $UserTypeID = $this->session->userdata('UserTypeID');
// $UserTypeName = $this->session->userdata('UserTypeName');
// $CompanyId = $this->session->userdata('CompanyId');
// $BranchID = $this->session->userdata('BranchID');
// $BranchID = $this->session->userdata('financial_yr');
// $BranchID = $this->session->userdata('Financial_yr_id');
// $BranchID = $this->session->userdata('Financial_month');
// $BranchID = $this->session->userdata('is_logged_in');



// $data['Package_date']   = date("Y-m-d", strtotime($data['Package_date']));



// TRUNCATE `gc_advice`;
// TRUNCATE `gc_advice_details`;
// TRUNCATE `gc_batch_card`;
// TRUNCATE `gc_batch_card_details`;
// TRUNCATE `gc_batch_rates`;
// TRUNCATE `gc_batch_rates_details`;
// TRUNCATE `gc_batch_stocks`;
// TRUNCATE `gc_customers`;
// TRUNCATE `gc_customer_address`;
// TRUNCATE `gc_gst`;
// TRUNCATE `gc_gst_states`;
// TRUNCATE `gc_hub_branch`;
// TRUNCATE `gc_item_stocks`;
// TRUNCATE `gc_products`;
// TRUNCATE `gc_product_rate_setting`;
// TRUNCATE `gc_product_suppliers`;
// TRUNCATE `gc_product_units`;
// TRUNCATE `gc_purchase_details`;
// TRUNCATE `gc_purchase_table`;
// TRUNCATE `gc_schemes`;
// TRUNCATE `gc_schemes_details`;
// TRUNCATE `gc_stock_details`;
// TRUNCATE `gc_stock_transfer`;
// TRUNCATE `gc_super_categories`;
// TRUNCATE `gc_supplier_address`;
// TRUNCATE `gc_team`;
// TRUNCATE `gc_team_child`;
// TRUNCATE `gc_team_details`;
// TRUNCATE `gc_transaction_prefix_region`;
// TRUNCATE `gc_ventors_table`;

/*


<div class="btn btn-info btn-sm editusertype" style="background: #63a2dc; border: #63a2dc;"><i class="zmdi zmdi-edit zmdi-hc-fw" style="font-size: 17px;color:  white; "></i>
                                  </div>




<?php if ($list['delete_status'] == 1) { ?> 

    <div class="btn btn-accent btn-sm">
    <i class="zmdi zmdi-delete zmdi-hc-fw" style="font-size: 17px;color:  white;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
    </div>  

<?php }else{ ?>

<?php } ?>



// (region_id,product_id,batch_id,class_for_change)
get_current_stock(<?php echo $Quarantine[0]['region_id']; ?>,<?php echo $Quarantine[0]['Product_id'] ?>,<?php echo $Quarantine[0]['batch_id'] ?>,'.avail_qty_1');




<script>
  get_current_stock(<?php echo $dc[0]['region_id']; ?>,<?php echo $value['product_id']; ?>,<?php echo $value['batch_id']; ?>,'.stock_<?php echo $key; ?>');
</script>



//$Units_data['company_id']=$this->session->userdata('CompanyId');
//$Units_data['financial_yr_id']=$this->session->userdata('Financial_yr_id');


$this->db->where('product.company_id', $this->session->userdata('CompanyId'));


$company_id=$this->session->userdata('CompanyId');
if(!empty($company_id)){
    $this->db->where('company_id', $company_id);
}

            $this->session->set_flashdata('gst_success', 'Updated');


<script>
   <?php
         if ($this->session->flashdata('gst_success')) 
         {
            echo "var data = ' ".$this->session->flashdata('gst_success')."';";
            echo "success(data);";
         }
   ?>
</script>


<div class="col-md-6">
  <div class="card" style="padding-bottom: 12px;">
    <div class="form-body">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            1
          </div>
          <div class="col-md-6">
            2
          </div>
        </div>
      </div>
    </div>  
  </div>  
</div> 

*/

