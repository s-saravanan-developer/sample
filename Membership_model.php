<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends CI_Model { 

    function getall_bank() {

        $this->db->select('*');
        $this->db->where('Status',1);
        $this->db->order_by("ID", "DESC");
        $query = $this->db->get('gc_bank');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }

    function get_member_by_details($id) {

        $this->db->select('gc_membership.Membership_ID');

        if(!empty($id)){
        $where = '(Membership_code="'.$id.'" or Mobile = "'.$id.'")';
        $this->db->where($where);}

        $query = $this->db->get('gc_membership');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }
 // function get_contract_by($id) {
 //    var_dump($id);
 //    $this->db->select('member.*,topup.Franchise');
 //    $this->db->from('gc_member_franchisee_contract as member');
 //    $this->db->join('gc_member_topup as topup', 'topup.ID = member.Topup_ID', 'left');

 //    $this->db->where('member.Contract_ID',$id);

 //    $query = $this->db->get();
 //    if ($query->num_rows() > 0) {
 //        return  $query->result_array();
 //    }
 //    return NULL;
 //    }

 function get_contract_by($id,$date) {
// var_dump($id);
    $this->db->select('member.*,topup.Franchise,membership.First_name,membership.Last_name,withdraw.Withdraw_type');
    $this->db->from('gc_membership as membership');
    $this->db->join('gc_member_franchisee_contract as member','member.Membership_ID = membership.Membership_ID', 'left');
    $this->db->join('gc_member_topup as topup', 'topup.ID = member.Topup_ID', 'left');
    $this->db->join('gc_withdraw as withdraw', 'withdraw.ID = member.Request_type', 'left');

    $this->db->where('member.Request_status',2);
    // $this->db->where('membership.Membership_code',$id);

    if ($id != "") {
        $this->db->where('membership.Membership_code',$id);
    }

    //  if ($date != "") {
    //     $this->db->where('member.Request_date',$date);
    // }

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return  $query->result_array();
    }
    return NULL;
    }

 function get_contract_by_success($id,$date) {
// var_dump($date);
    $this->db->select('member.*,topup.Franchise,membership.First_name,membership.Last_name,withdraw.Withdraw_type');
    $this->db->from('gc_membership as membership');
    $this->db->join('gc_member_franchisee_contract as member','member.Membership_ID = membership.Membership_ID', 'left');
    $this->db->join('gc_member_topup as topup', 'topup.ID = member.Topup_ID', 'left');
    $this->db->join('gc_withdraw as withdraw', 'withdraw.ID = member.Request_type', 'left');

    $this->db->where('member.Request_status',3);

    if ($id != "") {
        $this->db->where('membership.Membership_code',$id);
    }

     if ($date != "") {
        $this->db->where('member.Request_date',$date);
    }

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return  $query->result_array();
    }
    return NULL;
    }

     function get_contract_by_failed($id,$date) {
// var_dump($date);
    $this->db->select('member.*,topup.Franchise,membership.First_name,membership.Last_name,withdraw.Withdraw_type');
    $this->db->from('gc_membership as membership');
    $this->db->join('gc_member_franchisee_contract as member','member.Membership_ID = membership.Membership_ID', 'left');
    $this->db->join('gc_member_topup as topup', 'topup.ID = member.Topup_ID', 'left');
    $this->db->join('gc_withdraw as withdraw', 'withdraw.ID = member.Request_type', 'left');

    $this->db->where('member.Request_status',4);

    if ($id != "") {
        $this->db->where('membership.Membership_code',$id);
    }

     if ($date != "") {
        $this->db->where('member.Request_date',$date);
    }

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return  $query->result_array();
    }
    return NULL;
    }

    function get_member_detailbyid($id) {

        $this->db->select('gc_membership.Membership_ID');
        $where = '(Membership_code="'.$id.'" or Mobile = "'.$id.'")';
        $this->db->where($where);
        $query = $this->db->get('gc_membership');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }
    function getall_payment_modes() {

        $this->db->select('*');
        $this->db->where('Status',1);
        $query = $this->db->get('gc_payment_mode');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }

function get_doc_records($id) {

        $this->db->select('*');
        $this->db->where('Membership_ID',$id);
        $query = $this->db->get('gc_member_documents');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }

function get_pays_records($id) {

        $this->db->select('*');
        $this->db->where('Membership_ID',$id);
        $query = $this->db->get('gc_member_payments');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    
    }

function getall_members($status,$status1) {

        $this->db->select('member.*,contract.*,payments.*,nominees.*,member.Status as Member_status,contract.Status as Cont_status,address.*,type.Membership_type,topup.Franchise,bank.Status as Bank_status,payments.Payment_status,bank.*,bank.Bank_ID as Bank_Bank_ID,gc_bank.Bank_name,users.email_address as loginemail,users.og_password as loginpassword');
        $this->db->from('gc_membership as member');
        $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_member_payments as payments', 'payments.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_member_nominees as nominees', 'nominees.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_member_address as address', 'address.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_membershiptype as type', 'type.ID = member.Membership_type', 'left');
        $this->db->join('gc_member_topup as topup', 'topup.ID = contract.Topup_id', 'left');
        $this->db->join('gc_member_banks as bank', 'bank.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_bank as gc_bank', 'gc_bank.ID = bank.Bank_ID', 'left');
        $this->db->join('gc_member_documents as documents', 'documents.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_users as users', 'users.id = member.Membership_ID', 'left');

        // $this->db->join('gc_member_documents as document', 'document.Membership_ID = member.Membership_ID', 'left');
        $this->db->group_by("member.Membership_ID");
        if($status!=1){
        $this->db->where_in("member.Status",$status);}
        if($status1==10 || $status1==11){
            if($status1==10){
                $this->db->where("bank.Status",5);
            }elseif($status1==11){
                $this->db->where("documents.Status",5);
            }
        }
        $this->db->group_by("payments.Membership_ID");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }


function calculate_commission($Cal_date) {


$Cal_date=date('Y-m-d',strtotime($Cal_date));
$final_dates=[];
$yrl_dates_0=[];
        $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);
            $final_days=[];
            $final_days1=[];


        $yr=[date('Y')-1,date('Y')+0,date('Y')+1];
        foreach($yr as $key => $y){
        $yrl_dates_0[$key]=$this->get_three_yrs_holidays($y,$week_days);
    
        }
        $final_dates=array_merge($yrl_dates_0[0],$yrl_dates_0[1],$yrl_dates_0[2]);
        

                $this->db->select('Date');
                $query = $this->db->get('gc_individual_calendar');
                if ($query->num_rows() > 0) {
                    $db_leave=$query->result_array();
                }else{
                    $db_leave=[];
                }

                $empt_leave=[];
                foreach($db_leave as $lv){
                    array_push($empt_leave,$lv['Date']);

                }
                // echo "<pre>";
                // print_r($empt_leave);echo "</pre>";die();
                //print_r($db_leave);die();
                $final_dates=array_values(array_diff($final_dates,$empt_leave));
                //echo "<pre>";
                //print_r($final_dates);echo "</pre>";die();
            //if(in_array(date('Y-m-d'), $final_dates)){
            if(in_array($Cal_date, $final_dates)){


                //$previous_trading=$this->get_previous_date(date('Y-m-d'));
                $previous_trading=$this->get_previous_date1($Cal_date);

                $this->db->where('Commision_date',$previous_trading);
                $comision_status=  $this->db->count_all_results('gc_member_commission');
                if($comision_status<=0){
                    //echo ' insert';
                    //echo 'insert';die();
                // Get Transaction Tabl
                    $samparr=[];
                // $this->db->select('transaction.*,contract.Payment_status_date,contract.Contract_ID');
                $this->db->select('transaction.*,contract.Payment_status_date,contract.Contract_ID,member.Members_count');
                $this->db->from('gc_transaction as transaction');
                $this->db->join('gc_membership as member', 'member.Membership_ID = transaction.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = transaction.Contract_ID', 'left');
                $this->db->join('gc_transaction_details as t_det', 't_det.Transaction_ID = transaction.Transaction_ID', 'left');

                $this->db->where('transaction.Transaction_status',1);
                $this->db->where('member.Status',6);
                $this->db->where('contract.Withdrawn_status',5);
                $this->db->group_by('t_det.Transaction_ID');
                $this->db->where('transaction.Transaction_date <=',date('Y-m-d',strtotime($previous_trading)));
                $query1 = $this->db->get();
                if ($query1->num_rows() > 0) {
                    $transaction=$query1->result_array();
                     //var_dump($transaction);die();
                    foreach($transaction as $tran){
                        //echo $tran['Payment_status_date'];
                        $pay_date=$tran['Payment_status_date'];
                        $this->db->select('*');
                        $this->db->from('gc_payout_setting');
                        $query = $this->db->get();
                        if ($query->num_rows() > 0) {
                    $set_day=$query->result_array();
                    $setting_day=$set_day[0]['Schedule_day'];

                }else{
                    $setting_day=0;
                }
                //echo $pay_date;
                $cms_start=$this->get_advance_date1($setting_day,date('Y-m-d',strtotime($pay_date)));
                //die();
                if($Cal_date > $cms_start){

                    $this->db->select('sum(topup.Value) as Volume');
                    // $this->db->select('level.Child_ID');
                     $this->db->from('gc_member_level_details as level');
                     $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = level.Child_ID', 'left');
                     $this->db->join('gc_member_topup as topup', 'topup.ID = contract.Topup_id', 'left');
                     $this->db->join('gc_membership as member', 'member.Membership_ID = level.Child_ID', 'left');
                     $this->db->where('level.Membership_ID',$tran['Membership_ID']);
                     $this->db->where('level.Level_ID',1);
                     $this->db->where('member.Status',6);
                     $this->db->where('contract.Withdrawn_status',5);
                      $query_volume = $this->db->get();
                      $Volume_amnt=$query_volume->result_array();

                      $this->db->select('*');
                    $this->db->from('gc_commission_setting');
                    $this->db->where('Status',1);
                    $query_commission = $this->db->get();
                      $commission_setting=$query_commission->result_array();

                      if($commission_setting[0]['Members_count']>=$members[0]['Members_count'] || $commission_setting[0]['Volume_amount']>=$Volume_amnt[0]['Volume']){
                        //echo 'eligible';
                      
                    //echo "insert1"; die();
                    $commision_data=array(
                            'Company_id'       => $this->session->userdata('CompanyId'),
                            'Branch_id'        => $this->session->userdata('CompanyId'),
                            'Transaction_ID'   => $tran['Transaction_ID'],
                            'Membership_ID'    => $tran['Membership_ID'], 
                            'Contract_ID'      => $tran['Contract_ID'], 
                            'Transaction_type' => '',
                            'Commision_date'   => date('Y-m-d',strtotime($previous_trading)), 
                            'Remarks'          => '',
                            'Created_by'       => $this->session->userdata('UserId')
                            );
                    
                

                    $this->db->insert('gc_member_commission',$commision_data);
                    $commision_id=$this->db->insert_id();
                    // $commision_id=1;

                    // Get Transaction detail Table
                    $this->db->select('tran_det.*,gc_lvl.Payout_type');
                    $this->db->from('gc_transaction_details as tran_det');
                    $this->db->join('gc_membership as member', 'member.Membership_ID = tran_det.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = tran_det.Contract_ID', 'left');
                $this->db->join('gc_member_level_details as lvl_det', 'lvl_det.Member_level_detail_ID = tran_det.Member_level_detail_ID', 'left');
                $this->db->join('gc_level as gc_lvl', 'gc_lvl.ID = lvl_det.Level_ID', 'left');
                    $this->db->where('tran_det.Status',1);
                    $this->db->where('tran_det.Transaction_ID',$tran['Transaction_ID']);
                    $this->db->where('member.Status',6);
                    $this->db->where('contract.Withdrawn_status',5);
                    $this->db->where('contract.Contract_status',6);
                    $query2 = $this->db->get();
                      if ($query2->num_rows() > 0) {

                        $transaction_detail=$query2->result_array();

                        foreach($transaction_detail as $tran_det){
                            if($tran_det['Member_level_detail_ID']!=''){
                                $payout_member=$tran_det['Payout_type'];
                            }else{
                                $payout_member=$tran_det['Payout_ID'];
                            }
                            $commision_detail_data=array(
                            'Company_id'               => $this->session->userdata('CompanyId'),
                            'Branch_id'                => $this->session->userdata('CompanyId'),
                            'Commission_ID'            => $commision_id,
                            'Transaction_ID'           => $tran_det['Transaction_ID'],
                            'Transaction_detail_ID'    => $tran_det['Transaction_detail_ID'],
                            'Member_level_detail_ID'   => $tran_det['Member_level_detail_ID'],
                            'Membership_ID'            => $tran_det['Membership_ID'], 
                            'Contract_ID'              => $tran_det['Contract_ID'], 
                            'Commision_type'           => $tran_det['Commision_type'],
                            'Payout_ID'                => $payout_member,
                            'Commision_date'           => date('Y-m-d',strtotime($previous_trading)), 
                            'Amount'                   => $tran_det['Amount'], 
                            'Commision'                => $tran_det['Commision'],
                            'Remarks'                  => '', 
                            'Created_by'               => $this->session->userdata('UserId')
                            );
                            $this->db->insert('gc_member_commission_details',$commision_detail_data);

                        }
                         //print_r($commision_detail_data);die();

                      }

                    } // Memberscount or Volume if End

                  }
            }

          }else{
            // For Blocked Members Commission
                $this->db->select('min(member.Membership_ID) as Membership_ID,contract.Contract_ID,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
                $this->db->from('gc_membership as member');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = member.Membership_ID', 'left');
                $query_member = $this->db->get();
                if ($query_member->num_rows() > 0) {
                    $root_member=$query_member->result_array();
                    $root_id=$root_member[0]['Membership_ID'];
                    $root_contract=$root_member[0]['Contract_ID'];
                    if($root_member[0]['Payout_status']==2){
                    $root_payout_id=$root_member[0]['New_payout_ID'];
                    }else{
                    $root_payout_id=$root_member[0]['Old_payout_ID'];
            }
                }
        


                $this->db->select('transaction.*,contract.Payment_status_date,contract.Contract_ID');
                $this->db->from('gc_transaction as transaction');
                $this->db->join('gc_membership as member', 'member.Membership_ID = transaction.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = transaction.Contract_ID', 'left');

                $this->db->where('transaction.Transaction_status',1);
                $this->db->where('member.Status',8);
                $this->db->where('contract.Withdrawn_status',5);
                $this->db->group_by('t_det.Transaction_ID');
                $this->db->where('transaction.Transaction_date <=',date('Y-m-d',strtotime($previous_trading)));
                $query1 = $this->db->get();
                if ($query1->num_rows() > 0) {
                    $transaction=$query1->result_array();
                     //print_r($transaction);
                    foreach($transaction as $tran){
                        $pay_date=$tran['Payment_status_date'];
                        $this->db->select('*');
                        $this->db->from('gc_payout_setting');
                        $query = $this->db->get();
                        if ($query->num_rows() > 0) {
                    $set_day=$query->result_array();
                    $setting_day=$set_day[0]['Schedule_day'];

                }else{
                    $setting_day=0;
                }
                //echo $pay_date;
                $cms_start=$this->get_advance_date1($setting_day,date('Y-m-d',strtotime($pay_date)));

                if($Cal_date > $cms_start){
                    //echo "insert1";
                    $commision_data=array(
                            'Company_id'       => $this->session->userdata('CompanyId'),
                            'Branch_id'        => $this->session->userdata('CompanyId'),
                            'Transaction_ID'   => $tran['Transaction_ID'],
                            'Membership_ID'    => $root_member, 
                            'Contract_ID'      => $root_contract,
                            'Transaction_type' => $tran['Transaction_ID'],
                            'Commision_date'   => date('Y-m-d',strtotime($previous_trading)), 
                            'Remarks'          => 'Blocked Push-up Commisoin by '.$tran_det['Membership_ID'],
                            'Created_by'       => $this->session->userdata('UserId')
                            );
                    //print_r($commision_data);
                    $this->db->insert('gc_member_commission',$commision_data);
                    $commision_id=$this->db->insert_id();
                    // $commision_id=1;

                    // Get Transaction detail Table
                    $this->db->select('tran_det.*,gc_lvl.Payout_type');
                    $this->db->from('gc_transaction_details as tran_det');
                    $this->db->join('gc_membership as member', 'member.Membership_ID = tran_det.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = tran_det.Contract_ID', 'left');
                $this->db->join('gc_member_level_details as lvl_det', 'lvl_det.Member_level_detail_ID = tran_det.Member_level_detail_ID', 'left');
                $this->db->join('gc_level as gc_lvl', 'gc_lvl.ID = lvl_det.Level_ID', 'left');
                    $this->db->where('tran_det.Status',1);
                    $this->db->where('tran_det.Transaction_ID',$tran['Transaction_ID']);
                    $this->db->where('member.Status',8);
                    $this->db->where('contract.Withdrawn_status',5);
                    $this->db->where('contract.Contract_status',8);
                    $query2 = $this->db->get();
                      if ($query2->num_rows() > 0) {

                        $transaction_detail=$query2->result_array();

                        foreach($transaction_detail as $tran_det){
                            if($tran_det['Member_level_detail_ID']!=''){
                                $payout_member=$tran_det['Payout_type'];
                            }else{
                                $payout_member=$root_payout_id;
                            }
                            $commision_detail_data=array(
                            'Company_id'               => $this->session->userdata('CompanyId'),
                            'Branch_id'                => $this->session->userdata('CompanyId'),
                            'Commission_ID'            => $commision_id,
                            'Transaction_ID'           => $tran_det['Transaction_ID'],
                            'Transaction_detail_ID'    => $tran_det['Transaction_detail_ID'],
                            'Member_level_detail_ID'   => $tran_det['Member_level_detail_ID'],
                            'Membership_ID'            => $root_member, 
                            'Contract_ID'              => $root_contract, 
                            'Commision_type'           => 3,
                            'Payout_ID'                => $payout_member,
                            'Commision_date'           => date('Y-m-d',strtotime($previous_trading)), 
                            'Amount'                   => $tran_det['Amount'], 
                            'Commision'                => $tran_det['Commision'],
                            'Remarks'                  => 'Blocked Push-up Commisoin by '.$tran_det['Membership_ID'], 
                            'Created_by'               => $this->session->userdata('UserId')
                            );
                            $this->db->insert('gc_member_commission_details',$commision_detail_data);

                        }
                         //print_r($commision_detail_data);die();

                      }

                  }
            }

          }


          } //else End
                     }
                        //die();
               

        }

    }

}

public function get_three_yrs_holidays($year,$week_days){

//$week_days=['6','7'];
            //var_dump($week_days);
$date=new DateTime();
//$year=date('Y');
$date->setDate($year, 01, 01);
$dt = $date->format('Y-m-d');
$day=date('l', strtotime($dt));
$search =date('N', strtotime($day));

$arr = [];
$arr2 = [];

for ($i=0 ;$i < count($week_days); $i++) {

    if($week_days[$i] == $search){
        $arr[$i] = $week_days[$i];
        $search = $week_days[$i] + 1;
    }else{
        $arr2[$i] = $week_days[$i];
    }
}

$action = array_merge($arr,$arr2);
$days = array(
     '1' => 'Monday',
     '2' => 'Tuesday',
     '3' => 'Wednesday',
     '4' => 'Thursday',
     '5' => 'Friday',
     '6' => 'Saturday',
     '7' => 'Sunday'
 );
$final_dt=[];
//var_dump($action);
foreach($action as $da){
if (array_key_exists($da,$days))
  {
    //$sim=array('N' => $days[$da], 'A' => $da);
  array_push($final_dt,$days[$da]);
  }

}
//var_dump($final_dt);

$final_dates=[];
for($i=1; $i<=52; $i++){
        foreach($final_dt as $newval){
        //date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))).'<br>';
        array_push($final_dates,date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))));
        }
    }
    return $final_dates;
}

public function get_advance_date($ad_days,$cur_date){

    $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);
            //var_dump($week_days);
$date=new DateTime();
$year=date('Y');
$date->setDate($year, 01, 01);
$dt = $date->format('Y-m-d');
$day=date('l', strtotime($dt));
$search =date('N', strtotime($day));

$arr = [];
$arr2 = [];

for ($i=0 ;$i < count($week_days); $i++) {

    if($week_days[$i] == $search){
        $arr[$i] = $week_days[$i];
        $search = $week_days[$i] + 1;
    }else{
        $arr2[$i] = $week_days[$i];
    }
}

$action = array_merge($arr,$arr2);
$days = array(
     '1' => 'Monday',
     '2' => 'Tuesday',
     '3' => 'Wednesday',
     '4' => 'Thursday',
     '5' => 'Friday',
     '6' => 'Saturday',
     '7' => 'Sunday'
 );
$final_dt=[];

foreach($action as $da){
if (array_key_exists($da,$days))
  {
  array_push($final_dt,$days[$da]);
  }

}

//var_dump($final_dt);
$final_dates=[];
for($i=1; $i<=52; $i++){
        foreach($final_dt as $newval){
        //date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))).'<br>';
        array_push($final_dates,date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))));
        }
    }
   $cur_date=date("Y-m-d", strtotime($cur_date));
    
    //var_dump($final_dates);
    foreach($final_dates as $key=> $fin){
if($cur_date < $fin){
    $keyval= $key+$ad_days;
    if(isset($final_dates[$keyval])){
        return $final_dates[$keyval];
    }else{
        return date('Y-01-01');
    }
    
    break;
}else{
    $keyval=$key;
    $final_dates[$keyval];
}
    }
    //echo $serch_date=$final_dates[$keyval];
}

    }

public function get_advance_date1($ad_days,$cur_date){
$final_dates=[];
$yrl_dates_0=[];
    $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);

            $yr=[date('Y')-1,date('Y')+0,date('Y')+1];
        foreach($yr as $key => $y){
        $yrl_dates_0[$key]=$this->get_three_yrs_holidays($y,$week_days);
    
        }
        $final_dates=array_merge($yrl_dates_0[0],$yrl_dates_0[1],$yrl_dates_0[2]);

        $this->db->select('Date');
                $query = $this->db->get('gc_individual_calendar');
                if ($query->num_rows() > 0) {
                    $db_leave=$query->result_array();
                }else{
                    $db_leave=[];
                }
                $empt_leave=[];
                foreach($db_leave as $lv){
                    array_push($empt_leave,$lv['Date']);

                }
                
                //print_r($db_leave);die();
                $final_dates=array_values(array_diff($final_dates,$empt_leave));


    foreach($final_dates as $key=> $fin){
if($cur_date < $fin){
    $keyval= $key+$ad_days;
    if(isset($final_dates[$keyval])){
        return $final_dates[$keyval];
    }else{
        return date('Y-01-01');
    }
    
    break;
}else{
    $keyval=$key;
    $final_dates[$keyval];
}
    }
}

    }    
    
public function getDays($y,$m,$d){ 
    $date = "$y-$m-01";
    $first_day = date('N',strtotime($date));
    $first_day = $d - $first_day + 1;
    $last_day =  date('t',strtotime($date));
    $days = array();
    for($i=$first_day; $i<=$last_day; $i=$i+7 ){
        $days[] = $y.'-'.$m.'-'.$i;
        //$days[] = implode(',',$days);
    }
    return $days;
}
    
public function getall_topups() {
        $this->db->select('*');
        $this->db->where('Status',1);
        $query = $this->db->get('gc_member_topup');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }

public function getall_payouts() {
        $this->db->select('*');
        $this->db->where('Status',1);
        $query = $this->db->get('gc_payout_type');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }


public function getall_payouts_franchasie() {
        $this->db->select('*');
        $this->db->where('Status',1);
        $this->db->where('Level_type_id',1);
        $query = $this->db->get('gc_payout_type');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }

public function update_bank_status($data,$Membership_ID) {
    $id=$data['Member_bank_ID'];
    unset($data['Member_bank_ID']);
        $this->db->where('Member_bank_ID',$id);
        $this->db->update('gc_member_banks',$data);
        
        $data1['Status']=4;
        $this->db->where('Membership_ID',$Membership_ID);
        if($this->db->update('gc_membership',$data1)){
            return 1;
        }else{
            return 0;
        }
        
    }

public function update_document_status($data,$Membership_ID) {
    $id=$data['Document_ID'];
    unset($data['Document_ID']);
        $this->db->where('Document_ID',$id);
        $this->db->update('gc_member_documents',$data);

        $data1['Status']=4;
        $this->db->where('Membership_ID',$Membership_ID);
        if($this->db->update('gc_membership',$data1)){
            return 1;
            }else{
                return 0;
            }
    }

    
    public function block_member_contract($Membership_ID,$reason) {
        $data['Status']=8;
        $data['Blocking_reason']=$reason;
        $this->db->where('Membership_ID',$Membership_ID);
        $this->db->update('gc_membership',$data);

        $data1['Contract_status_date']=date('Y-m-d');
        $data1['Contract_status']=8;
        $this->db->where('Membership_ID',$Membership_ID);
        if($this->db->update('gc_member_franchisee_contract',$data1)){
            return 1;
        }else{
            return 0;
        }


    }

public function Activate_member_contract($Membership_ID,$Contract_ID) {
        $data['Status']=6;
        $this->db->where('Membership_ID',$Membership_ID);
        $this->db->update('gc_membership',$data);

        $this->db->select('topup.Validity,Value,Return,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
        $this->db->from('gc_member_topup as topup');
        $this->db->join('gc_member_franchisee_contract as contract', 'contract.Topup_id = topup.ID', 'left');

        $this->db->where('contract.Contract_ID',$Contract_ID);
        $this->db->where('contract.Membership_ID',$Membership_ID);
        $query = $this->db->get();
        $contract=$query->result_array();
        if(!empty($contract)){
            $month=$contract[0]['Validity'];
            $Amount=$contract[0]['Value'];
            $Return=$contract[0]['Return'];
            if($contract[0]['Payout_status']==2){
                $payout_id=$contract[0]['New_payout_ID'];
            }else{
                $payout_id=$contract[0]['Old_payout_ID'];
            }
        }else{
            $month=0;
            $Amount=0;
            $Return=0;
        }
// Transaction Insert Start        
        $transaction=array(
                            'Company_id' => $this->session->userdata('CompanyId'),
                            'Branch_id' => $this->session->userdata('CompanyId'), 
                            'Membership_ID' => $Membership_ID, 
                            'Contract_ID' => $Contract_ID, 
                            'Transaction_type' => 1,
                            'Transaction_date' => date('Y-m-d'), 
                            'Remarks' => '', 
                            'Created_by' => $this->session->userdata('UserId') 
                        );
        $this->db->insert('gc_transaction',$transaction);
        $transaction_id=$this->db->insert_id();
// Transaction Insert End
// Transaction Detail (Top-up) Insert Start        
        $Comission_amount=$Amount*$Return/100;
        $transaction_detail=array(
                            'Company_id' => $this->session->userdata('CompanyId'),
                            'Branch_id' => $this->session->userdata('CompanyId'), 
                            'Membership_ID' => $Membership_ID, 
                            'Contract_ID' => $Contract_ID,
                            'Member_level_detail_ID' => NULL, 
                            'Transaction_ID' => $transaction_id, 
                            'Commision_type' => 1, 
                            'Payout_ID' => $payout_id,
                            'Amount' => $Comission_amount, 
                            'Commision' => $Return,
                            'Remarks' => '' 
                        );
        $this->db->insert('gc_transaction_details',$transaction_detail);
// Transaction Detail (Top-up) Insert End   

// Transaction History (Debit) Insert start 
$history_data=array(
                 'Company_id'               => $this->session->userdata('CompanyId'),
                 'Branch_id'                => $this->session->userdata('CompanyId'), 
                 'Membership_ID' => $Membership_ID,
                 'Contract_ID'   => $Contract_ID,
                 'Payout_ID' => $payout_id,
                 'Date'  => date('Y-m-d'),
                 'History_for'   => ' Topup Amount of  '.$Amount,
                 'Credit_amount' => 0,
                 'Debit_amount' => $Amount,
                  );
            $this->db->insert('gc_transaction_history',$history_data);  

// Transaction History (Debit) Insert End  

// Transaction Details (Direct&Push-up) Insert Start
        $this->db->select('Reference_ID');
        $this->db->from('gc_membership');
        $this->db->where('Membership_ID',$Membership_ID);
        $query = $this->db->get();
        $membership=$query->result_array();


$ref_ID="";$level_insert_id="";
        for($i=1;$i<=9;$i++){ 
            if($i==1){
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Contract_ID,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$membership[0]['Reference_ID']);
            //$this->db->where('contract.Contract_status',6);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            $crnt_lvl=$binary[0]['Current_level'];
            //if($crnt_lvl<=$i){
            $level['Level_ID']=$i;
            //}
            //else{
               //$level['Level_ID']=$crnt_lvl;
            //}
            $ref_ID=$binary[0]['Reference_ID'];

            $this->db->select('level.Member_level_detail_ID,topup.Validity,topup.Value,lvl.Return,contract.Contract_ID,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_member_level_details as level');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID ='.$binary[0]['Contract_ID'], 'left');
            $this->db->join('gc_member_topup as topup', 'topup.ID =contract.Topup_id', 'left');
            $this->db->join('gc_level as lvl', 'lvl.ID ='.$level['Level_ID'], 'left');
            $this->db->where('level.Child_ID',$Membership_ID);
            $this->db->where('level.Membership_ID',$membership[0]['Reference_ID']);
            //$this->db->where('level.Level_ID',$level['Level_ID']);
            $query= $this->db->get();
            $level_details=$query->result_array();


                        $Comission_amount1=$Amount*$level_details[0]['Return']/100;
            $this->db->select('Payout_type');
            $this->db->from('gc_level');
            $this->db->where('ID',$level['Level_ID']);
            $query_lvl= $this->db->get();
            if($query_lvl->num_rows() > 0) {
            $level_payout=$query_lvl->result_array();
            $payout_id1=$level_payout[0]['Payout_type'];
            }else{
                if($level_details[0]['Payout_status']==2){
                $payout_id1=$level_details[0]['New_payout_ID'];
                }else{
                $payout_id1=$level_details[0]['Old_payout_ID'];
                        }
                    }
// Transaction Details Insert start 
$transaction_detail1=array(
                            'Company_id' => $this->session->userdata('CompanyId'),
                            'Branch_id' => $this->session->userdata('CompanyId'), 
                            'Membership_ID' => $binary[0]['Membership_ID'], 
                            'Contract_ID' => $binary[0]['Contract_ID'],
                            'Member_level_detail_ID' => $level_details[0]['Member_level_detail_ID'], 
                            'Transaction_ID' => $transaction_id, 
                            'Commision_type' => 2,
                            'Payout_ID' => $payout_id1, 
                            'Amount' => $Comission_amount1, 
                            'Commision' => $level_details[0]['Return'],
                            'Remarks' => '' 
                        );
        $this->db->insert('gc_transaction_details',$transaction_detail1);
// Transaction Details Insert start


        }
    }
    else{
            $this->db->select('*');
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Contract_ID,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$ref_ID);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            $crnt_lvl=$binary[0]['Current_level'];
            $level['Level_ID']=$i;
           //  if($crnt_lvl<=$i){
            
           //  }
           //  else{
           //     $level['Level_ID']=$crnt_lvl;
           // }
            $ref_ID=$binary[0]['Reference_ID'];

            $this->db->select('level.Member_level_detail_ID,topup.Validity,topup.Value,lvl.Return,contract.Contract_ID,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_member_level_details as level');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID ='.$binary[0]['Contract_ID'], 'left');
            $this->db->join('gc_member_topup as topup', 'topup.ID =contract.Topup_id', 'left');
            $this->db->join('gc_level as lvl', 'lvl.ID ='.$level['Level_ID'], 'left');
            $this->db->where('level.Child_ID',$Membership_ID);
            $this->db->where('level.Membership_ID',$binary[0]['Membership_ID']);
            //$this->db->where('level.Level_ID',$level['Level_ID']);
            $query= $this->db->get();
            $level_details=$query->result_array();
                        $Comission_amount1=$level_details[0]['Value']*$level_details[0]['Return']/100;
                        $this->db->select('Payout_type');
            $this->db->from('gc_level');
            $this->db->where('ID',$level['Level_ID']);
            $query_lvl= $this->db->get();
            if($query_lvl->num_rows() > 0) {
            $level_payout=$query_lvl->result_array();
            $payout_id1=$level_payout[0]['Payout_type'];
            }else{
                        if($level_details[0]['Payout_status']==2){
                        $payout_id1=$level_details[0]['New_payout_ID'];
                        }else{
                        $payout_id1=$level_details[0]['Old_payout_ID'];
                        }
                    }
// Transaction Details Insert start 
$transaction_detail1=array(
                            'Company_id' => $this->session->userdata('CompanyId'),
                            'Branch_id' => $this->session->userdata('CompanyId'), 
                            'Membership_ID' => $binary[0]['Membership_ID'], 
                            'Contract_ID' => $binary[0]['Contract_ID'],
                            'Member_level_detail_ID' => $level_details[0]['Member_level_detail_ID'], 
                            'Transaction_ID' => $transaction_id, 
                            'Commision_type' => 3,
                            'Payout_ID' => $payout_id1, 
                            'Amount' => $Comission_amount1, 
                            'Commision' => $level_details[0]['Return'],
                            'Remarks' => ''  
                        );
        $this->db->insert('gc_transaction_details',$transaction_detail1);
// Transaction Details Insert start
// Transaction Details (Direct&Push-up) Insert End        

                }

            }
        }

        $data1['Start_date']=date('Y-m-d');
        $data1['End_date']=date('Y-m-d', strtotime('+'.$month.'months'));
        $data1['Contract_status']=6;
        $data1['Contract_status_date']=date('Y-m-d');
        $this->db->where('Membership_ID',$Membership_ID);
        $this->db->where('Contract_ID',$Contract_ID);
        if($this->db->update('gc_member_franchisee_contract',$data1)){
            return 1;
        }else{
            return 0;
        }
    }
    
function get_referer_by_code($referer) {

        $this->db->select('Membership_ID,First_name,Last_name,Membership_code');
        $this->db->where('Status!=',7);
        $this->db->where('Status!=',8);
        $where = '(Membership_code="'.$referer.'" or Mobile = "'.$referer.'")';
        $this->db->where($where);
        $query = $this->db->get('gc_membership');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }

function get_payments_details($pay_type) {

        $this->db->select('ID');
        $this->db->where("Payment_mode LIKE '%$pay_type%'");
        $query = $this->db->get('gc_payment_mode');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }    

function get_cntrct_details($topup) {   

        $this->db->select('ID,Value,Payout_type');
        $this->db->where('Value',$topup);
        $query = $this->db->get('gc_member_topup');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }    
    

    

function mobile_verify($mobile) {

        $this->db->select('Membership_ID,First_name,Last_name,Membership_code,Status');
        $this->db->where('Mobile',$mobile);
        $query = $this->db->get('gc_membership');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }
    

function get_topup_details($topup) {

        $this->db->select('ID,Value,Validity,Payout_type,Return');
        $this->db->where('ID',$topup);
        $this->db->where('Status',1);
        $query = $this->db->get('gc_member_topup');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }

    function getall_membershiptype() {

        $this->db->select('*');
        $this->db->where('Status',1);
        $query = $this->db->get('gc_membershiptype');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }

    function getall_invest_type() {

        $this->db->select('*');
        $this->db->where('Status',1);
        $this->db->where('Level_type_id',1);
        $query = $this->db->get('gc_invest_type');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return 0;
    }   

    function get_all_topup_list_by_invest_type($id,$level_type) {

        $this->db->select('*');
        $this->db->where('Status',1);
        $this->db->where('Level_type_id',$level_type);
        $this->db->where('Invest_type_id',$id);
        $query = $this->db->get('gc_member_topup');
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }



function get_parent_detail($id) {

    $this->db->select('table.Membership_ID,table.First_name,table.Last_name,table.Membership_code,table.Reference_ID,table.Current_level,table.Photo,table.Members_count,table1.Member_color,table.Members_count,table.Created_date');
    $this->db->join('gc_tree_color_setting as table1', 'table1.Member_type = table.Membership_type', 'left');
    $this->db->where('table.Membership_ID',$id);
    $this->db->where('table1.Member_level',1);
    $query = $this->db->get('gc_membership as table');
    if ($query->num_rows() > 0) {   
        return  $query->result_array();
    }
    // return 0;
    }

    function get_parent_referer($id) {

    $this->db->select('table.Membership_code');
    $this->db->where('table.Membership_ID',$id);
    $query = $this->db->get('gc_membership as table');
    if ($query->num_rows() > 0) {   
        return  $query->result_array();
    }
    // return 0;
    }

    

function get_child_by_parent($id) { 

         $this->db->select('member.Membership_ID,member.First_name,member.Last_name,member.Membership_code,member.Current_level,tree.Child_ID,table1.Member_color,member.Photo,member.Members_count,member.Created_date,sum(table3.Value) as Franchise,tree.Parent_ID');
         $this->db->select('members.First_name as parentfname');
         $this->db->from('gc_franchisee_member_relation as tree');
         $this->db->join('gc_membership as member', 'member.Membership_ID = tree.Child_ID', 'left');
         $this->db->join('gc_membership as members', 'members.Membership_ID = tree.Parent_ID', 'left');
         $this->db->join('gc_tree_color_setting as table1', 'table1.Member_type = member.Membership_type', 'left');
         $this->db->join('gc_member_franchisee_contract as table2', 'table2.Membership_ID = member.Membership_ID', 'left');
         $this->db->join('gc_member_topup as table3', 'table3.ID = table2.Topup_id', 'left');

        $this->db->where('table1.Member_level',1);
        $this->db->where('tree.Parent_ID',$id);
        $this->db->group_by('table2.Membership_ID');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        // return 0;
    }


function get_child_by_parent_binary($id) { 

         $this->db->select('member.Membership_ID,member.First_name,member.Last_name,member.Membership_code,member.Current_level,tree.Child_ID,table1.Member_color,member.Photo,member.Members_count,member.Created_date');
         $this->db->from('gc_binary_member_relation as tree');
         $this->db->join('gc_membership as member', 'member.Membership_ID = tree.Child_ID', 'left');
         $this->db->join('gc_tree_color_setting as table1', 'table1.Member_type = member.Membership_type', 'left');

        $this->db->where('table1.Member_level',1);
        $this->db->where('tree.Parent_ID',$id);
        $this->db->order_by('tree.Position');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        // return 0;
    }


function get_child_by_parent_binary1($id) {
        // var_dump($id);
         $this->db->select('member.Membership_ID,member.First_name,member.Last_name,member.Membership_code,member.Current_level,tree.Child_ID,table1.Member_color,member.Photo,member.Members_count');
         $this->db->from('gc_binary_member_relation as tree');
         $this->db->join('gc_membership as member', 'member.Membership_ID = tree.Child_ID', 'left');
         $this->db->join('gc_tree_color_setting as table1', 'table1.Member_type = member.Membership_type', 'left');
         
        $this->db->where('table1.Member_level',1);
        $this->db->where('tree.Parent_ID',$id);
        $query = $this->db->get()->result_array();
        // var_dump($query);
        if (count($query) > 0) {
            return  $query;
        }
        return 0;
    }

function get_pincode_details($pincode){
$this->db->select('area.id as taluk_id,area.area_name as taluk_name,city.id as City_id,city.city_name as City_name,state.id as State_id,state.state_name as State_name,country.id as Country_id,country.country_name as Country_name');

        $this->db->from('gc_areas as area');
        $this->db->join('gc_cities as city', 'city.id = area.city_id', 'left');
        $this->db->join('gc_states as state', 'state.id = area.state_id', 'left');
        $this->db->join('gc_countries as country', 'country.id = area.country_id', 'left');
        $this->db->where("area.Pincode",$pincode);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }    

function get_bank_details($bank){
        $this->db->select('ID');
        $this->db->from('gc_bank');
        $this->db->where("Bank_name",$bank);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    } 

    
    function adding_excel_data($excel_member){
        //var_dump($excel_member);
        $Register_date=date('Y-m-d', strtotime(str_replace('/', '-', $excel_member['Reg_date'])));
        $reference_id=$this->get_referer_by_code($excel_member['Referal_ID']);
       $reference_id=$reference_id[0]['Membership_ID']; // 

       $pan=$excel_member["Document_no_pan"];
        if(!empty($pan)){
        $newpan = substr($pan, -5);
        }else{
           $newpan=$this->generatePIN(5); 
        }
        $newmob = substr($excel_member['Mobile'], -5);
        $Membership_code=$newpan.$newmob;

       
        
        if($excel_member['Gender']=='Male' || $excel_member['Gender']=='male'){
            $prefix=1;
        }else{
            $prefix=2;
        }
        $member=array(
            'First_name' => $excel_member['First_name'],
            'Last_name' => $excel_member['Last_name'],
            'F_f_name' => $excel_member['F_f_name'],
            'F_l_name' => $excel_member['F_l_name'],
            'Reference_ID' => $reference_id,
            'Prefix' => $prefix,
            'F_prefix' => $prefix,
            'Gender' => $excel_member['Gender'],
            'Email' => $excel_member['Email'],
            'Mobile' => $excel_member['Mobile'],
            'Reg_date' =>date('Y-m-d', strtotime(str_replace('/', '-', $excel_member['Reg_date']))),
            'DOB' => date('Y-m-d', strtotime(str_replace('/', '-', $excel_member['DOB']))),
            'Register_from' => 'Web',
        );

// var_dump($member);
        $pin=$this->get_pincode_details($excel_member['Pincode']);
        if(!empty($pin)){
            $area=$pin[0]['taluk_id'];
            $city=$pin[0]['City_id'];
            $state=$pin[0]['State_id'];
            $country=$pin[0]['Country_id'];
        }else{
             $area=2;
            $city=1;
            $state=1;
            $country=101;
        }

        $address_data=array(
             'Address_1' => $excel_member['Address_1'],
             'Address_type' => 1,
            'Address_2' => $excel_member['Address_2'],
            'Landmark' => $excel_member['Address_2'],
            'Pincode' => $excel_member['Pincode'],
            'Area' => $area,
            'City' => $city,
            'State' => $state,
            'Country' => $country,
        );
// var_dump($address_data);

if($excel_member['Invest_type']=='Initial' || $excel_member['Invest_type']=='initial'){
    $invest_type=1;
}else{
    $invest_type=2;
}
if($invest_type==1){
        if (!is_dir('./attachments/Members/'.$Membership_code))
                  {
                      mkdir('./attachments/Members/'.$Membership_code, 0777, true);
                  }
                  $dir_exist = true; // flag for checking the directory exist or not
                  if (!is_dir('./attachments/Members/'.$Membership_code))
                  {
                      mkdir('./attachments/Members/'.$Membership_code, 0777, true);
                      $dir_exist = false; // dir not exist
                  }
                  if(!define('UPLOAD_DIR','./attachments/Members/'.$Membership_code.'/')){
                    define('UPLOAD_DIR', './attachments/Members/'.$Membership_code.'/');
                  }

$file =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Profiles/pan.jpg';
$newfile =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Members/'.$Membership_code.'/'.$Membership_code.'_pan.jpg';
copy($file, $newfile); 


$file1 =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Profiles/aadhar.jpg';
$newfile1 =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Members/'.$Membership_code.'/'.$Membership_code.'_aadhar.jpg';
copy($file1, $newfile1); 


$file2 =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Profiles/cheque.jpg';
$newfile2 =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Members/'.$Membership_code.'/'.$Membership_code.'_cheque.jpg';
copy($file2, $newfile2); 
        $upload_data=[];
        for($i=1;$i<=3;$i++){
            if($i==1){
            $upload_data['upload_data_'.$i]['Document_type']='Pan';
            $upload_data['upload_data_'.$i]['Document_no']=$excel_member['Document_no_pan'];
            $upload_data['upload_data_'.$i]['Document_name']=$Membership_code.'_pan.jpg';
            $upload_data['upload_data_'.$i]['Folder_name']=$Membership_code;
        }elseif($i==2){
            $upload_data['upload_data_'.$i]['Document_type']='Aadhar';
            $upload_data['upload_data_'.$i]['Document_no']=$excel_member['Document_no_aadhar'];
            $upload_data['upload_data_'.$i]['Document_name']=$Membership_code.'_aadhar.jpg';
            $upload_data['upload_data_'.$i]['Folder_name']=$Membership_code;
        }else{
             $upload_data['upload_data_'.$i]['Document_type']='Cheque';
            $upload_data['upload_data_'.$i]['Document_no']=$excel_member['Document_no_cheque'];
            $upload_data['upload_data_'.$i]['Document_name']=$Membership_code.'_cheque.jpg';
            $upload_data['upload_data_'.$i]['Folder_name']=$Membership_code;
        }
        //var_dump($upload_data);
        }
}


// var_dump($upload_data);
        $nominee_data=array(
            'Nominee_name' => $excel_member['Nominee_name'],
             'Nominee_relationship' => $excel_member['Nominee_relationship'],
             'Nominee_mobile' => $excel_member['Nominee_mobile'],
        );
// var_dump($nominee_data);
        $bank=$this->get_bank_details($excel_member['Bank_ID']);
        if(!empty($bank)){
            $bank_id=$bank[0]['ID'];
        }else{
             $bank_id=2;
        }

    $bank_data=array(
                        'Bank_ID' => $bank_id,
                        'Account_holder' => $excel_member['Account_holder'],
                        'Account_no' => $excel_member['Account_no'],
                        'Branch' => $excel_member['Branch'],
                        'IFSC' => $excel_member['IFSC']
                    );
// var_dump($bank_data);

$peyment=$this->get_cntrct_details($excel_member['Topup_id']);
if($excel_member['Invest_type']=='Initial' || $excel_member['Invest_type']=='initial'){
    $invest_type=1;
}else{
    $invest_type=2;
}
if(!empty($peyment)){
            $Topup_id=$peyment[0]['ID'];
            $value=$peyment[0]['Value'];
            $Payout_type=$peyment[0]['Payout_type'];
        }else{
             $Topup_id=1;
             $value=50000;
             $Payout_type=1;
        }

    $contract_data=array(
                'Membership_type' => $excel_member['Membership_type'],
                'Topup_id'        => $Topup_id,
                'Old_payout_ID' => $Payout_type,
                'New_payout_ID' => 0,
                'Payout_status' => 1,
                'Invest_type' => $invest_type,

    );

// var_dump($contract_data);

 $peyment=$this->get_payments_details($excel_member['Payment_type_ID']);
if(!empty($peyment)){
            $Payment_type_ID=$peyment[0]['ID'];
        }else{
             $Payment_type_ID=6;
        }

    $payment_data=array(
        'Payment_type_ID' => $Payment_type_ID,
        'Bank_ID' => $bank_id,
        'Reference_no' => $excel_member['Reference_no'],
        'Date' => date('Y-m-d', strtotime(str_replace('/', '-', $excel_member['Date']))),
        'Amount' => $value,
        'Remarks' => '');

// var_dump($payment_data);

    $agreement_data=array(
        'Delivery_mode' =>1);

if($invest_type==1){
    // var_dump($contract_data);
//die();
    $result=$this->adding_excel_membership_data($member,$address_data,$nominee_data,$bank_data,$upload_data,$contract_data,$payment_data,$agreement_data,$Membership_code);
}else{

        $Membership_ID=$this->get_referer_by_code($excel_member['Mobile']);
       $Membership_ID=$Membership_ID[0]['Membership_ID']; //
       $contract_data['Membership_ID']=$Membership_ID;
       //var_dump($contract_data);die();
     $result=$this->add_membership_upgrade_by_excel($contract_data,$payment_data,$agreement_data);
}

        
    }

public function generatePIN($digits){
    $i = 0;
    $pin = "";
    while($i < $digits){
        $pin .= mt_rand(0, 9);
        $i++;
    }       
    return $pin;
}


    function adding_excel_membership_data($member,$address_data,$nominee_data,$bank_data,$upload_data,$contract_data,$payment_data,$agreement_data,$Membership_code) {

       $Register_date=date('Y-m-d',strtotime($member['Reg_date']));
        // Start Membership Insert
        // var_dump($upload_data);
       unset($member['Reg_date']);
            if($member['Register_from']=='Web'){
                $Company_ID=$this->session->userdata('CompanyId');
            }else{
                $Company_ID=1;
            }
        $member['Company_id']   = $Company_ID;
        $member['Branch_id']   = $Company_ID;

        if(isset($contract_data)){
            $member['Membership_type']   = $contract_data['Membership_type'];
        }
        if(!empty($contract_data['Membership_type'])){
             $member['Membership_type']   = $contract_data['Membership_type'];
         }else{
             $member['Membership_type']   = 2;
         }
            
        // Membership Code
        $pan=$upload_data["upload_data_1"]["Document_no"];
        if(!empty($pan)){
        $newpan = substr($pan, -5);
        $newmob = substr($member['Mobile'], -5);
        $member['Membership_code']=$newpan.$newmob;
        $Membership_code=$newpan.$newmob;
        }else{
            $member['Membership_code']=$Membership_code;
            $Membership_code=$member['Membership_code'];
        }
        
        

        if($member['Gender']=='Male' || $member['Gender']=='male'){
        $file =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Profiles/male.jpg';
        }else{
            $file =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Profiles/female.jpg';
        }
        
        $newfile =  $_SERVER['DOCUMENT_ROOT'] .base_url().'attachments/Members/'.$Membership_code.'/'.$Membership_code.'_Profile.jpg';
        copy($file, $newfile);


    $photo_name=$Membership_code.'_Profile.jpg';
        // $photo_name = $this->member_profile_attachment_1($member['Membership_code'],$profile_name,$names);

        $member['Random_ID']=random_string('alnum',10);
        $increment_code = $this->db->count_all_results('gc_membership')+1;
        $member['Member_no']="GRNC-MEM-0000".$increment_code;
        $member['Member_sequence']=$increment_code-1;
        $member['DOB']=date("Y-m-d", strtotime($member['DOB']));
        $member['Status']=4;
        $member['Photo']=$photo_name;
        $member['Photo_path']="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$member['Membership_code'].'/';
        $member['Created_by']=$this->session->userdata('UserId');
        $member['Created_date']=$Register_date;

// var_dump($member);
        if($this->db->insert('gc_membership', $member)){
            $Membership_ID=$this->db->insert_id();
        }

    // $Membership_ID=1;

// end Membership Insert

//start Member upload_data Insert
        foreach($upload_data as $key =>$upld)
        {
            $upld['Membership_ID']   = $Membership_ID;
            $upld['File_path']="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$member['Membership_code'].'/';
            $upld['Company_id']   = $Company_ID;
            $upld['Branch_id']   = $Company_ID;
            $upld['Status']   = 6;
            $upload_data[$key]=$upld;
        }
        // var_dump($upload_data);
        foreach($upload_data as $upld_data)
        {   
            $this->db->insert('gc_member_documents', $upld_data);
           
        }
        
        // die();
//end Member upload_data Insert

//start Member Address Insert
        $address_data['Membership_ID']   = $Membership_ID;
        $address_data['Company_id']   = $Company_ID;
        $address_data['Branch_id']   = $Company_ID;
        // var_dump($address_data);
        $this->db->insert('gc_member_address', $address_data);
//end Member Address Insert

// start User Insert
       $user_data['user_id']         = $Membership_ID;
       $user_data['company_id']      = 1;
       $user_data['branch_id']       = 1;
       $user_data['firstname']       = $member['First_name'];
       $user_data['username']        = $member['Membership_code'];
       $user_data['password']        = md5($member['Mobile']);
       $user_data['og_password']     = $member['Mobile'];
       $user_data['email_address']   = $member['Email'];
       $user_data['mobile_number']   = $member['Mobile'];
       $user_data['address_line_1']  = $address_data['Address_1'];
       $user_data['address_line_2']  = $address_data['Address_2'];
       $user_data['zipcode']         = $address_data['Pincode'];
       $user_data['country_id']         = $address_data['Country'];
       $user_data['state_id']         = $address_data['State'];
       $user_data['city_id']         = $address_data['City'];
       $user_data['user_type_id']    = 3;
       // var_dump($user_data);
       $this->db->insert('gc_users', $user_data);

// end User Insert  

// Open Cart Table

    $reg = array('firstname'         => $member['First_name'],
                 'lastname'          => $member['Last_name'],
                 'customer_group_id' => '1',
                 'language_id'       => '1',
                 'email'             => $member['Email'],
                 'telephone'         => $member['Mobile'],
                 'status'            => '1',
                 'email'             => $member['Email'],                         
                 'password'          => md5($member['Mobile']),                         
                 'Member_id'         => $Membership_ID,                         
                );
        $opencart = $this->load->database('wixsite_gcart', TRUE);
        // opencart
        if ($opencart->insert('oc_customer', $reg)) {
             $opencart->insert_id();
        } 

// End Open Cart Table


//start Member nominee_data Insert
        $nominee_data['Membership_ID']   = $Membership_ID;
        $nominee_data['Company_id']   = $Company_ID;
        $nominee_data['Branch_id']   = $Company_ID;
        // var_dump($nominee_data);
        $this->db->insert('gc_member_nominees', $nominee_data);
//end Member nominee_data Insert

//start Member bank_data Insert
        $bank_data['Membership_ID']   = $Membership_ID;
        $bank_data['Company_id']   = $Company_ID;
        $bank_data['Branch_id']   = $Company_ID;
        $bank_data['Status']   = 6;
        // var_dump($bank_data);
        $this->db->insert('gc_member_banks', $bank_data);
//end Member bank_data Insert

//start Member contract_data Insert
        if(isset($contract_data)){
            $contract_data['Membership_ID']   = $Membership_ID;
            $increment_code1 = $this->db->count_all_results('gc_member_franchisee_contract')+1;
            $contract_data['Contract_ref_no']="GRNC-CNT-0000".$increment_code1;
            $contract_data['Company_id']   = $Company_ID;
            $contract_data['Branch_id']   = $Company_ID;
            $contract_data['Branch_id']   = $Company_ID;
            $contract_data['Date']   = $Register_date;
            // var_dump($contract_data);
            if($this->db->insert('gc_member_franchisee_contract', $contract_data)){
                $Contract_ID=$this->db->insert_id();
            }
            // $Contract_ID=36;
        }    
//end Member contract_data Insert

//start Member payment_data Insert
        if(isset($payment_data)){
                $payment_data['Membership_ID']   = $Membership_ID;
                $payment_data['Contract_ID']   = $Contract_ID;
                $payment_data['Company_id']   = $Company_ID;
                $payment_data['Branch_id']   = $Company_ID;
                $payment_data['Date']   = date('Y-m-d',strtotime($payment_data['Date']));
                $payment_data['Payment_status']   = 5;
                $payment_data['Created_date']   = $Register_date;
           
            
            // var_dump($payment_data);
            $this->db->insert('gc_member_payments', $payment_data);
        }    
//end Member payment_data Insert

//start Member agreement_data Insert
        if(isset($agreement_data)){
            $agreement_data['Membership_ID']   = $Membership_ID;
            $agreement_data['Contract_ID']   = $Contract_ID;
            $agreement_data['Company_id']   = $Company_ID;
            $agreement_data['Date']   = $Register_date;
            $agreement_data['Branch_id']   = $Company_ID;
            // var_dump($agreement_data);
            $this->db->insert('gc_member_agreement', $agreement_data);
        }
//end Member agreement_data Insert


//start Member Franchisee Member Relationship Insert
        $franchisee_relation['Child_ID']        = $Membership_ID;
        $franchisee_relation['Level_type_ID']   = 1;
        $franchisee_relation['Parent_id']   = $member['Reference_ID'];
        // $franchisee_relation['Position']   = 1;
        $this->db->where('Parent_ID',$member['Reference_ID']);  
        $member_seq = $this->db->count_all_results('gc_franchisee_member_relation')+1;

        $franchisee_relation['Position']   = $member_seq;
        if($franchisee_relation['Position'] % 2 == 0){ 
            $determin = "2";  
        }else{ 
            $determin = "1"; 
        }
        $franchisee_relation['Determination']   = $determin;
        $franchisee_relation['Company_id']   = $Company_ID;
        $franchisee_relation['Branch_id']   = $Company_ID;
        $franchisee_relation['Date']   = $Register_date;
        // var_dump($franchisee_relation);
        $this->db->insert('gc_franchisee_member_relation', $franchisee_relation);
//end Member Franchisee Member Relationship Insert

//start Member binary Member Relationship Insert
        $binary_relation['Child_ID']        = $Membership_ID;
        $binary_relation['Level_type_ID']   = 2;
        $binary_relation['Refer_parent_ID']   = $member['Reference_ID'];
        $binary_relation['Position']   = $member_seq;
        // $binary_relation['Child_ID']        = 7;
        //     $binary_relation['Level_type_ID']   = 2;
        //     $binary_relation['Refer_parent_ID']   = 1;
        //     $binary_relation['Position']   = 3;
            $parent_id=$binary_relation['Refer_parent_ID'];
            if($binary_relation['Position'] % 2 == 0){ // determination if Start
                // echo 'right';
                 $p_type=2;
                $determin = 2;
                if($parent_id==1){
                    // echo 'right';
                    $Ex_position_type=2;
                }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('gc_binary_member_relation');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }

                }  // determination if End

            else{  // determination else Start
                // echo 'left';
                $p_type=1;
                $determin = 1;
                if($parent_id==1){
                    // echo 'left';
                    $Ex_position_type=1;
                    }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('gc_binary_member_relation');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }
            } // determination else End

                        $limit=1;
                        for($i=1;$i<=$limit;$i++){
                            $this->db->select('*');
                            $this->db->where('Position_type',$p_type);
                            $this->db->where('Ex_position_type',$Ex_position_type);
                            $this->db->where('Parent_ID',$parent_id);
                            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
                            $query4 = $this->db->get('gc_binary_member_relation');
                            if($query4->num_rows() > 0){
                                $binary4=$query4->result_array();
                                $parent_id=$binary4[0]['Child_ID'];
                                $limit++;
                            }
            
                        }
            //echo $parent_id;
        $binary_relation['Determination']   = $determin;
        $binary_relation['Position_type']   = $p_type;
        $binary_relation['Ex_position_type']   = $Ex_position_type;
        $binary_relation['Parent_id']    =  $parent_id;
        $binary_relation['Company_id']   =  $Company_ID;
        $binary_relation['Branch_id']    =  $Company_ID;
        $binary_relation['Date']   = $Register_date;
        // var_dump($binary_relation);die();
        $this->db->insert('gc_binary_member_relation', $binary_relation);
//end Member binary Member Relationship Insert

$member_update['Members_count']   = $member_seq;
$this->db->where('Membership_ID', $member['Reference_ID']);
$this->db->update('gc_membership', $member_update);

            


//start Member binary Member Levels Insert
$ref_ID="";$level_insert_id="";
        for($i=1;$i<=9;$i++){ 
            if($i==1){
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$member['Reference_ID']);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            //var_dump($binary);
            $crnt_lvl=$binary[0]['Current_level'];
             $level['Level_ID']=$i;
            if($crnt_lvl<=$i){
            $member_level=$i;
            }
            else{
                $member_level=$crnt_lvl;
            }
            $ref_ID=$binary[0]['Reference_ID'];
 // Member Level Master Insert start
            $levels_master['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_master['Company_id']       =  $Company_ID;
            $levels_master['Branch_id']        =  $Company_ID;
            $levels_master['Level_ID']         =  1;
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_master['Date']   = $Register_date;
            $this->db->insert('gc_member_levels', $levels_master);
            $level_insert_id=$this->db->insert_id();

// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  $Company_ID;
            $levels_data['Branch_id']        =  $Company_ID;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_data['Level_date']   = $Register_date;
            $this->db->insert('gc_member_level_details', $levels_data);
// Member Level Details Insert start
// Membership Current Level Insert start
            $mem_lvl['Current_level']=$member_level;
            
            $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
            $this->db->update('gc_membership', $mem_lvl);
// Membership Current Level Insert end

        }
    }
    else{
            $this->db->select('*');
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$ref_ID);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            $crnt_lvl=$binary[0]['Current_level'];
            $level['Level_ID']=$i;
            if($crnt_lvl<=$i){
            $member_level=$i;
            }
            else{
                $member_level=$crnt_lvl;
            }
            $ref_ID=$binary[0]['Reference_ID'];

 // Member Level Master Insert start
            $levels_master['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_master['Company_id']       =  $Company_ID;
            $levels_master['Branch_id']        =  $Company_ID;
            $levels_master['Level_ID']         =  $level['Level_ID'];
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $this->db->insert('gc_member_levels', $levels_master);
            $levels_master['Date']             = $Register_date;
            $level_insert_id=$this->db->insert_id();
// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  $Company_ID;
            $levels_data['Branch_id']        =  $Company_ID;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_data['Level_date']       = $Register_date;
            $this->db->insert('gc_member_level_details', $levels_data);
// Member Level Details Insert start

// Membership Current Level Insert start
            $mem_lvl['Current_level']=$member_level;
            $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
            $this->db->update('gc_membership', $mem_lvl);
// Membership Current Level Insert end            
            
// Membership Member Grade Update start            

            $level_counts=[];
            $grade_ids=[];
            for($j=1;$j<=9;$j++){
                $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
                $this->db->where('Level_ID',$j);
                $mem_counts =  $this->db->count_all_results('gc_member_levels');
                $level_counts['Level_'.$j]=$mem_counts;
            }
            //var_dump($level_counts);
                $this->db->select('*');
                $this->db->where('Status',1);
                $query =  $this->db->get('gc_grade');
                 if($query->num_rows() > 0) {
                $grade=$query->result_array();

                foreach($grade as $gradevals){
                    foreach($level_counts as $lvl){
                        $array=[];
$a=0;

  if($lvl['Level_1'] >= $gradevals['Level_1_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_2'] >= $gradevals['Level_2_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_3'] >= $gradevals['Level_3_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_4'] >= $gradevals['Level_4_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_5'] >= $gradevals['Level_5_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_6'] >= $gradevals['Level_6_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_7'] >= $gradevals['Level_7_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_8'] >= $gradevals['Level_8_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_9'] >= $gradevals['Level_9_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;

      $check=in_array(1, $array) < 0;
      if($check==true){
        array_push($grade_ids,$gradevals['ID']);
      //echo 'insert'.'<br>';
  }
  else{
  //echo 'do nothing'.'<br>';
}
                    }
                }
                //var_dump($grade_ids);
                if(!empty($grade_ids)){
                $this->db->select('ID,min(Grade_level) as Grade_level');
                $this->db->where('Status',1);
                $this->db->where_in('ID',$grade_ids);
                $least=$this->db->get('gc_grade');
                if($least->num_rows() > 0) {
                   $least_c=$least->row();
                $inserting_grade=$least_c->ID;
                $membership_data['Member_grade']=$inserting_grade;
                $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
                $this->db->update('gc_membership',$membership_data);
                }
            }

            }
        
// Membership Member Grade Update end


                }

            }
        }
    }

function random_strings($length_of_string) { 

    return substr(bin2hex(random_bytes($length_of_string)),0, $length_of_string); 

}



function add_membership($member,$address_data,$nominee_data,$bank_data,$upload_data,$contract_data,$payment_data,$agreement_data) {
       $Register_date=date('Y-m-d',strtotime($member['Reg_date']));
        // Start Membership Insert
        // var_dump($upload_data);
       unset($member['Reg_date']);
            if($member['Register_from']=='Web'){
                $Company_ID=$this->session->userdata('CompanyId');
            }else{
                $Company_ID=1;
            }
        $member['Company_id']   = $Company_ID;
        $member['Branch_id']   = $Company_ID;

        if(isset($contract_data)){
            $member['Membership_type']   = $contract_data['Membership_type'];
        }
        if(!empty($contract_data['Membership_type'])){
             $member['Membership_type']   = $contract_data['Membership_type'];
         }else{
             $member['Membership_type']   = 2;
         }
            
        // Membership Code
        $pan=$upload_data["upload_data_1"]["Document_no"];
        if(!empty($pan)){
        $newpan = substr($pan, -5);
        }
        $newmob = substr($member['Mobile'], -5);
        $member['Membership_code']=$newpan.$newmob;

        $profile_name = 'Photo';
        $names = 'Profile';
        $photo_name = $this->member_profile_attachment_1($member['Membership_code'],$profile_name,$names);

        //echo $rnd=random_strings(10);
        
        
        $member['Random_ID']=random_string('alnum',10);

        $increment_code = $this->db->count_all_results('gc_membership')+1;
        $member['Member_no']="GRNC-MEM-0000".$increment_code;
        $member['Member_sequence']=$increment_code-1;
        $member['DOB']=date("Y-m-d", strtotime($member['DOB']));
        $member['Status']=5;
        $member['Photo']=$photo_name;
        $member['Photo_path']="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$member['Membership_code'].'/';
        $member['Created_by']=$this->session->userdata('UserId');
        $member['Created_date']=$Register_date;


        if($this->db->insert('gc_membership', $member)){
            $Membership_ID=$this->db->insert_id();
        }


// end Membership Insert

//start Member upload_data Insert
        foreach($upload_data as $key =>$upld)
        {
            $upld['Membership_ID']   = $Membership_ID;
            $upld['File_path']="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$member['Membership_code'].'/';
            $upld['Company_id']   = $Company_ID;
            $upld['Branch_id']   = $Company_ID;
            $upload_data[$key]=$upld;
        }
        foreach($upload_data as $upld_data)
        {   
            $this->db->insert('gc_member_documents', $upld_data);
           
        }
        
        // die();
//end Member upload_data Insert

//start Member Address Insert
        $address_data['Membership_ID']   = $Membership_ID;
        $address_data['Company_id']   = $Company_ID;
        $address_data['Branch_id']   = $Company_ID;
        $this->db->insert('gc_member_address', $address_data);
//end Member Address Insert

// start User Insert
       $user_data['user_id']         = $Membership_ID;
       $user_data['company_id']      = 1;
       $user_data['branch_id']       = 1;
       $user_data['firstname']       = $member['First_name'];
       $user_data['username']        = $member['Membership_code'];
       $user_data['password']        = md5($member['Mobile']);
       $user_data['og_password']     = $member['Mobile'];
       $user_data['email_address']   = $member['Email'];
       $user_data['mobile_number']   = $member['Mobile'];
       $user_data['address_line_1']  = $address_data['Address_1'];
       $user_data['address_line_2']  = $address_data['Address_2'];
       $user_data['zipcode']         = $address_data['Pincode'];
       $user_data['country_id']         = $address_data['Country'];
       $user_data['state_id']         = $address_data['State'];
       $user_data['city_id']         = $address_data['City'];
       $user_data['user_type_id']    = 3;
       $this->db->insert('gc_users', $user_data);

// end User Insert  

// Open Cart Table

    $reg = array('firstname'         => $member['First_name'],
                 'lastname'          => $member['Last_name'],
                 'customer_group_id' => '1',
                 'language_id'       => '1',
                 'email'             => $member['Email'],
                 'telephone'         => $member['Mobile'],
                 'status'            => '1',
                 'email'             => $member['Email'],                         
                 'password'          => md5($member['Mobile']),                         
                 'Member_id'         => $Membership_ID,                         
                );
        $opencart = $this->load->database('wixsite_gcart', TRUE);
        // opencart
        if ($opencart->insert('oc_customer', $reg)) {
             $opencart->insert_id();
        } 

// End Open Cart Table


//start Member nominee_data Insert
        $nominee_data['Membership_ID']   = $Membership_ID;
        $nominee_data['Company_id']   = $Company_ID;
        $nominee_data['Branch_id']   = $Company_ID;
        $this->db->insert('gc_member_nominees', $nominee_data);
//end Member nominee_data Insert

//start Member bank_data Insert
        $bank_data['Membership_ID']   = $Membership_ID;
        $bank_data['Company_id']   = $Company_ID;
        $bank_data['Branch_id']   = $Company_ID;
        $this->db->insert('gc_member_banks', $bank_data);
//end Member bank_data Insert

//start Member contract_data Insert
        if(isset($contract_data)){
            $contract_data['Membership_ID']   = $Membership_ID;
            $increment_code1 = $this->db->count_all_results('gc_member_franchisee_contract')+1;
            $contract_data['Contract_ref_no']="GRNC-CNT-0000".$increment_code1;
            $contract_data['Company_id']   = $Company_ID;
            $contract_data['Branch_id']   = $Company_ID;
            $contract_data['Branch_id']   = $Company_ID;
            $contract_data['Date']   = $Register_date;
            if($this->db->insert('gc_member_franchisee_contract', $contract_data)){
                $Contract_ID=$this->db->insert_id();
            }
        }    
//end Member contract_data Insert

//start Member payment_data Insert
        if(isset($payment_data)){
            foreach($payment_data as $key =>$payment)
            {
                $payment['Membership_ID']   = $Membership_ID;
                $payment['Contract_ID']   = $Contract_ID;
                $payment['Company_id']   = $Company_ID;
                $payment['Branch_id']   = $Company_ID;
                //$payment['Date']   = date('Y-m-d',strtotime($payment_data['Date']));
                $payment['Payment_status']   = 5;
                $payment['Created_date']   = $Register_date;
                $payment_data[$key]=$payment;
            }
            $this->db->insert_batch('gc_member_payments', $payment_data);
        }    
//end Member payment_data Insert

//start Member agreement_data Insert
        if(isset($agreement_data)){
            $agreement_data['Membership_ID']   = $Membership_ID;
            $agreement_data['Contract_ID']   = $Contract_ID;
            $agreement_data['Company_id']   = $Company_ID;
            $agreement_data['Date']   = $Register_date;
            $agreement_data['Branch_id']   = $Company_ID;
            $this->db->insert('gc_member_agreement', $agreement_data);
        }
//end Member agreement_data Insert


//start Member Franchisee Member Relationship Insert
        $franchisee_relation['Child_ID']        = $Membership_ID;
        $franchisee_relation['Level_type_ID']   = 1;
        $franchisee_relation['Parent_id']   = $member['Reference_ID'];
        // $franchisee_relation['Position']   = 1;
        $this->db->where('Parent_ID',$member['Reference_ID']);  
        $member_seq = $this->db->count_all_results('gc_franchisee_member_relation')+1;

        $franchisee_relation['Position']   = $member_seq;
        if($franchisee_relation['Position'] % 2 == 0){ 
            $determin = "2";  
        }else{ 
            $determin = "1"; 
        }
        $franchisee_relation['Determination']   = $determin;
        $franchisee_relation['Company_id']   = $Company_ID;
        $franchisee_relation['Branch_id']   = $Company_ID;
        $franchisee_relation['Date']   = $Register_date;
        $this->db->insert('gc_franchisee_member_relation', $franchisee_relation);
//end Member Franchisee Member Relationship Insert

//start Member binary Member Relationship Insert
        $binary_relation['Child_ID']        = $Membership_ID;
        $binary_relation['Level_type_ID']   = 2;
        // $binary_relation['Refer_parent_ID']   = 1;
        $binary_relation['Refer_parent_ID']   = $member['Reference_ID'];
        // $binary_relation['Position']   = 1;
        $binary_relation['Position']   = $member_seq;
        // $binary_relation['Child_ID']        = 7;
        //     $binary_relation['Level_type_ID']   = 2;
        //     $binary_relation['Refer_parent_ID']   = 1;
        //     $binary_relation['Position']   = 3;
            $parent_id=$binary_relation['Refer_parent_ID'];
            if($binary_relation['Position'] % 2 == 0){ // determination if Start
                // echo 'right';
                 $p_type=2;
                $determin = 2;
                if($parent_id==1){
                    // echo 'right';
                    $Ex_position_type=2;
                }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('gc_binary_member_relation');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }

                }  // determination if End

            else{  // determination else Start
                // echo 'left';
                $p_type=1;
                $determin = 1;
                if($parent_id==1){
                    // echo 'left';
                    $Ex_position_type=1;
                    }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('gc_binary_member_relation');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }
            } // determination else End

                        $limit=1;
                        for($i=1;$i<=$limit;$i++){
                            $this->db->select('*');
                            $this->db->where('Position_type',$p_type);
                            $this->db->where('Ex_position_type',$Ex_position_type);
                            $this->db->where('Parent_ID',$parent_id);
                            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
                            $query4 = $this->db->get('gc_binary_member_relation');
                            if($query4->num_rows() > 0){
                                $binary4=$query4->result_array();
                                $parent_id=$binary4[0]['Child_ID'];
                                $limit++;
                            }
            
                        }
            //echo $parent_id;
        $binary_relation['Determination']   = $determin;
        $binary_relation['Position_type']   = $p_type;
        $binary_relation['Ex_position_type']   = $Ex_position_type;
        $binary_relation['Parent_id']    =  $parent_id;
        $binary_relation['Company_id']   =  $Company_ID;
        $binary_relation['Branch_id']    =  $Company_ID;
        $binary_relation['Date']   = $Register_date;
        
        $this->db->insert('gc_binary_member_relation', $binary_relation);
//end Member binary Member Relationship Insert

$member_update['Members_count']   = $member_seq;
$this->db->where('Membership_ID', $member['Reference_ID']);
$this->db->update('gc_membership', $member_update);

            


//start Member binary Member Levels Insert
$ref_ID="";$level_insert_id="";
        for($i=1;$i<=9;$i++){ 
            if($i==1){
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$member['Reference_ID']);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            //var_dump($binary);
            $crnt_lvl=$binary[0]['Current_level'];
             $level['Level_ID']=$i;
            if($crnt_lvl<=$i){
            $member_level=$i;
            }
            else{
                $member_level=$crnt_lvl;
            }
            $ref_ID=$binary[0]['Reference_ID'];
 // Member Level Master Insert start
            $levels_master['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_master['Company_id']       =  $Company_ID;
            $levels_master['Branch_id']        =  $Company_ID;
            $levels_master['Level_ID']         =  1;
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_master['Date']   = $Register_date;
            $this->db->insert('gc_member_levels', $levels_master);
            $level_insert_id=$this->db->insert_id();

// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  $Company_ID;
            $levels_data['Branch_id']        =  $Company_ID;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_data['Level_date']   = $Register_date;
            $this->db->insert('gc_member_level_details', $levels_data);
// Member Level Details Insert start
// Membership Current Level Insert start
            $mem_lvl['Current_level']=$member_level;
            
            $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
            $this->db->update('gc_membership', $mem_lvl);
// Membership Current Level Insert end

        }
    }
    else{
            $this->db->select('*');
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$ref_ID);
            $query= $this->db->get();
            if($query->num_rows() > 0) {
            $binary=$query->result_array();
            $crnt_lvl=$binary[0]['Current_level'];
            $level['Level_ID']=$i;
            if($crnt_lvl<=$i){
            $member_level=$i;
            }
            else{
                $member_level=$crnt_lvl;
            }
            $ref_ID=$binary[0]['Reference_ID'];

 // Member Level Master Insert start
            $levels_master['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_master['Company_id']       =  $Company_ID;
            $levels_master['Branch_id']        =  $Company_ID;
            $levels_master['Level_ID']         =  $level['Level_ID'];
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $this->db->insert('gc_member_levels', $levels_master);
            $levels_master['Date']             = $Register_date;
            $level_insert_id=$this->db->insert_id();
// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  $Company_ID;
            $levels_data['Branch_id']        =  $Company_ID;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
            $levels_data['Level_date']       = $Register_date;
            $this->db->insert('gc_member_level_details', $levels_data);
// Member Level Details Insert start

// Membership Current Level Insert start
            $mem_lvl['Current_level']=$member_level;
            $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
            $this->db->update('gc_membership', $mem_lvl);
// Membership Current Level Insert end            
            
// Membership Member Grade Update start            

            $level_counts=[];
            $grade_ids=[];
            for($j=1;$j<=9;$j++){
                $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
                $this->db->where('Level_ID',$j);
                $mem_counts =  $this->db->count_all_results('gc_member_levels');
                $level_counts['Level_'.$j]=$mem_counts;
            }
            //var_dump($level_counts);
                $this->db->select('*');
                $this->db->where('Status',1);
                $query =  $this->db->get('gc_grade');
                 if($query->num_rows() > 0) {
                $grade=$query->result_array();

                foreach($grade as $gradevals){
                    foreach($level_counts as $lvl){
                        $array=[];
$a=0;

  if($lvl['Level_1'] >= $gradevals['Level_1_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_2'] >= $gradevals['Level_2_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_3'] >= $gradevals['Level_3_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_4'] >= $gradevals['Level_4_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_5'] >= $gradevals['Level_5_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_6'] >= $gradevals['Level_6_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_7'] >= $gradevals['Level_7_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_8'] >= $gradevals['Level_8_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;
  if($lvl['Level_9'] >= $gradevals['Level_9_count']){
      $array[$a]=1;
      }else{
      $array[$a]=0;
      }
      $a++;

      $check=in_array(1, $array) < 0;
      if($check==true){
        array_push($grade_ids,$gradevals['ID']);
      //echo 'insert'.'<br>';
  }
  else{
  //echo 'do nothing'.'<br>';
}
                    }
                }
                //var_dump($grade_ids);
                if(!empty($grade_ids)){
                $this->db->select('ID,min(Grade_level) as Grade_level');
                $this->db->where('Status',1);
                $this->db->where_in('ID',$grade_ids);
                $least=$this->db->get('gc_grade');
                if($least->num_rows() > 0) {
                   $least_c=$least->row();
                $inserting_grade=$least_c->ID;
                $membership_data['Member_grade']=$inserting_grade;
                $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
                $this->db->update('gc_membership',$membership_data);
                }
            }

            }
        
// Membership Member Grade Update end


                }

            }
        }
    }
 
 public function add_membership_upgrade($contract_data,$payment_data,$agreement_data)
 {
     //start Member contract_data Insert
        if(isset($contract_data)){
            
            $increment_code1 = $this->db->count_all_results('gc_member_franchisee_contract')+1;
            $contract_data['Contract_ref_no']="GRNC-CNT-0000".$increment_code1;
            $contract_data['Company_id']   = $this->session->userdata('CompanyId');
            $contract_data['Branch_id']   = $this->session->userdata('CompanyId');
            $contract_data['Invest_type']   = 2;
            //var_dump($contract_data);
            if($this->db->insert('gc_member_franchisee_contract', $contract_data)){
                $Contract_ID=$this->db->insert_id();
            }
          
        }    
//end Member contract_data Insert
//
//start Member payment_data Insert
        if(isset($payment_data)){
            foreach($payment_data as $key =>$payment)
            {
                $payment['Membership_ID']   = $contract_data['Membership_ID'];
                $payment['Contract_ID']   = $Contract_ID;
                $payment['Company_id']   = $this->session->userdata('CompanyId');
                $payment['Branch_id']   = $this->session->userdata('CompanyId');
                $payment['Payment_status']   = 5;
                $payment['Invest_type']   = 2;

                $payment_data[$key]=$payment;
            }
            $this->db->insert_batch('gc_member_payments', $payment_data);
        }    
//end Member payment_data Insert
//
//start Member agreement_data Insert
        if(isset($agreement_data)){
            $agreement_data['Membership_ID']   = $contract_data['Membership_ID'];
            $agreement_data['Contract_ID']   = $Contract_ID;
            $agreement_data['Company_id']   = $this->session->userdata('CompanyId');
            $agreement_data['Branch_id']   = $this->session->userdata('CompanyId');
            $this->db->insert('gc_member_agreement', $agreement_data);
        }
//end Member agreement_data Insert
 }

  public function add_membership_upgrade_by_excel($contract_data,$payment_data,$agreement_data)
 {
     //start Member contract_data Insert
        if(isset($contract_data)){
            
            $increment_code1 = $this->db->count_all_results('gc_member_franchisee_contract')+1;
            $contract_data['Contract_ref_no']="GRNC-CNT-0000".$increment_code1;
            $contract_data['Company_id']   = $this->session->userdata('CompanyId');
            $contract_data['Branch_id']   = $this->session->userdata('CompanyId');
            $contract_data['Invest_type']   = 2;
            // var_dump($contract_data);
            if($this->db->insert('gc_member_franchisee_contract', $contract_data)){
                $Contract_ID=$this->db->insert_id();
            }
            //$Contract_ID=36;
        }    
//end Member contract_data Insert
//
//start Member payment_data Insert
        if(isset($payment_data)){
                $payment_data['Membership_ID']   = $contract_data['Membership_ID'];
                $payment_data['Contract_ID']   = $Contract_ID;
                $payment_data['Company_id']   = $this->session->userdata('CompanyId');
                $payment_data['Branch_id']   = $this->session->userdata('CompanyId');
                $payment_data['Payment_status']   = 5;
                $payment_data['Invest_type']   = 2;
            $this->db->insert('gc_member_payments', $payment_data);
        }    
//end Member payment_data Insert
//
//start Member agreement_data Insert
        if(isset($agreement_data)){
            $agreement_data['Membership_ID']   = $contract_data['Membership_ID'];
            $agreement_data['Contract_ID']   = $Contract_ID;
            $agreement_data['Company_id']   = $this->session->userdata('CompanyId');
            $agreement_data['Branch_id']   = $this->session->userdata('CompanyId');

            $this->db->insert('gc_member_agreement', $agreement_data);
        }
//end Member agreement_data Insert
 }

     public function member_profile_attachment($dir) { 

                  // create an album if not already exist in uploads dir
                  // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
                  //var_dump($dir);
                  if (!is_dir('./attachments/Members/' .$dir))
                  {
                      mkdir('./attachments/Members/' .$dir, 0777, true);
                  }
                  $dir_exist = true; // flag for checking the directory exist or not
                  if (!is_dir('./attachments/Members/' .$dir))
                  {
                      mkdir('./attachments/Members/' .$dir, 0777, true);
                      $dir_exist = false; // dir not exist
                  }
                      
                 $config['upload_path']          = './attachments/Members/'.$dir.'/';
                 $config['allowed_types']        = 'gif|jpg|png|doc|pdf|docx';
                 $config['max_size']             = 10000; 
                 $new_name                       = $dir.'_Profile';
                 $config['file_name']            = $new_name;
                  

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('Photo'))
                {
                         $error = array('error' => $this->upload->display_errors());
                          $file_name = '';
                          return $error;                     
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data(); 
                        $file_name =   $upload_data['file_name'];
                        
                        return $file_name;
                }
        }        


    public function member_profile_attachment_1($ref_no,$profile_name,$name) {     
         // var_dump($profile_name);
         // var_dump($name);

           if (!is_dir('./attachments/Members/'.$ref_no))
                  {
                      mkdir('./attachments/Members/'.$ref_no, 0777, true);
                  }
                  $dir_exist = true; // flag for checking the directory exist or not
                  if (!is_dir('./attachments/Members/'.$ref_no))
                  {
                      mkdir('./attachments/Members/'.$ref_no, 0777, true);
                      $dir_exist = false; // dir not exist
                  }

         $config['upload_path']          = './attachments/Members/'.$ref_no.'/';
         $config['allowed_types']        = 'gif|jpg|png';
         $new_name                       = $ref_no.'_'.$name;
         $config['file_name']            = $new_name;
         //var_dump($config['file_name']);
         
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload($profile_name))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $file_name = '';
                        print_r($error);
                        // return $file_name;                 
                }
                else
                {   
                        $data = array('upload_data' => $this->upload->data());
                        $upload_data = $this->upload->data(); 
                        $file_name =   $upload_data['file_name'];
                        // die();
                        return $file_name;
                }

    }

    function get_contract_details($mobile) {

        $this->db->select('member.Membership_ID,member.First_name,member.Last_name,member.Gender,member.Membership_code,member.Photo,member.Mobile,contract.*,type.Membership_type as Membership_name,topup.Franchise,payout.Payout_type,topup.Value,topup.Validity,topup.Return,banks.Status as bank_status,contract.Start_date,contract.End_date,aggrement.Delivery_mode,aggrement.Referer_name');
        $this->db->from('gc_membership as member');
        $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
        $this->db->join('gc_member_topup as topup', 'topup.ID = contract.Topup_ID', 'left');
        $this->db->join('gc_payout_type as payout', 'payout.id = contract.Old_payout_ID', 'left');
        $this->db->join('gc_membershiptype as type', 'type.ID = contract.Membership_type', 'left');
        $this->db->join('gc_member_banks as banks', 'banks.Member_bank_ID = member.Membership_ID', 'left');

        $this->db->join('gc_member_agreement as aggrement', 'aggrement.Membership_ID = member.Membership_ID', 'left');
        $this->db->group_by('contract.Contract_ID');
        $this->db->where('contract.Status',7);
        
        $this->db->where('contract.Membership_ID',$mobile);
        // $this->db->where('member.Membership_ID',$mobile);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return  $query->result_array();
        }
        return NULL;
    }

public function get_previous_date($cur_date){

    $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);

            $yr=[date('Y')-1,date('Y')+0,date('Y')+1];
        foreach($yr as $key => $y){
        $yrl_dates_0[$key]=$this->get_three_yrs_holidays($y,$week_days);
    
        }
        $final_dates=array_merge($yrl_dates_0[0],$yrl_dates_0[1],$yrl_dates_0[2]);

            //var_dump($week_days);
$date=new DateTime();
$year=date('Y');
$date->setDate($year, 01, 01);
$dt = $date->format('Y-m-d');
$day=date('l', strtotime($dt));
$search =date('N', strtotime($day));

$arr = [];
$arr2 = [];

for ($i=0 ;$i < count($week_days); $i++) {

    if($week_days[$i] == $search){
        $arr[$i] = $week_days[$i];
        $search = $week_days[$i] + 1;
    }else{
        $arr2[$i] = $week_days[$i];
    }
}

$action = array_merge($arr,$arr2);
$days = array(
     '1' => 'Monday',
     '2' => 'Tuesday',
     '3' => 'Wednesday',
     '4' => 'Thursday',
     '5' => 'Friday',
     '6' => 'Saturday',
     '7' => 'Sunday'
 );
$final_dt=[];

foreach($action as $da){
if (array_key_exists($da,$days))
  {
  array_push($final_dt,$days[$da]);
  }

}

//var_dump($final_dt);
$final_dates=[];
for($i=1; $i<=52; $i++){
        foreach($final_dt as $newval){
        //date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))).'<br>';
        array_push($final_dates,date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($dt))));
        }
    }
   $cur_date=date("Y-m-d", strtotime($cur_date));
    
    //var_dump($final_dates);
    foreach($final_dates as $key=> $fin){
if($cur_date==$fin){

    
    if($key>=1){
    $keyval= $key-1;
    return  $final_dates[$keyval];
}else{
    //$keyval= date("Y",strtotime("-1 year")).'-12-31';
    return  date("Y",strtotime("-1 year")).'-12-31';
}
    

}else{
    $keyval=$key;
    $final_dates[$keyval];
}
    }
    //echo $serch_date=$final_dates[$keyval];
}

    }

public function get_previous_date1($cur_date){
$final_dates=[];
$yrl_dates_0=[];
    $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);

            $yr=[date('Y')-1,date('Y')+0,date('Y')+1];
        foreach($yr as $key => $y){
        $yrl_dates_0[$key]=$this->get_three_yrs_holidays($y,$week_days);
    
        }
        $final_dates=array_merge($yrl_dates_0[0],$yrl_dates_0[1],$yrl_dates_0[2]);

                $this->db->select('Date');
                $query = $this->db->get('gc_individual_calendar');
                if ($query->num_rows() > 0) {
                    $db_leave=$query->result_array();
                }else{
                    $db_leave=[];
                }
                $empt_leave=[];
                foreach($db_leave as $lv){
                    array_push($empt_leave,$lv['Date']);

                }
                
                //print_r($db_leave);die();
                $final_dates=array_values(array_diff($final_dates,$empt_leave));

    foreach($final_dates as $key=> $fin){
if($cur_date==$fin){

    
    if($key>=1){
    $keyval= $key-1;
    return  $final_dates[$keyval];
}else{
    //$keyval= date("Y",strtotime("-1 year")).'-12-31';
    return  date("Y",strtotime("-1 year")).'-12-31';
}
    

}else{
    $keyval=$key;
    $final_dates[$keyval];
}
    }
}

    }


    function binary_tree_old(){
        //start Member binary Member Relationship Insert
        $binary_relation['Child_ID']        = $Membership_ID;
        $binary_relation['Level_type_ID']   = 2;
        $binary_relation['Refer_parent_ID']   = $member['Reference_ID'];
        $binary_relation['Position']   = $member_seq;
        if($binary_relation['Position'] % 2 == 0){
            $determin = "2";
            $p_type ="2" ; 
        $this->db->select('*');
        $this->db->where('Position_type',$p_type);
        $this->db->where('Parent_ID',$binary_relation['Refer_parent_ID']);
        $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
        $query1 = $this->db->get('gc_binary_member_relation');
        if ($query1->num_rows() > 0) {
            $binary=$query1->result_array();

            $this->db->select('*');
            $this->db->where('Position_type',$p_type);
            $this->db->where('Ex_position_type',$binary[0]['Ex_position_type']);
            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
            $query4 = $this->db->get('gc_binary_member_relation');
            $binary4=$query4->result_array();
            $parent=$binary4[0]["Child_ID"];
            $new_p_type=$binary4[0]['Ex_position_type'];

        }else{
            $parent=$binary_relation['Refer_parent_ID'];
            $this->db->select('*');
            $this->db->where('Child_ID',$binary_relation['Refer_parent_ID']);
            $query5 = $this->db->get('gc_binary_member_relation');
            $binary5=$query5->result_array();
            $new_p_type=$binary5[0]['Ex_position_type'];
        }
        }else{
            $determin = "1";
            $p_type ="1"; 
        $this->db->select('*');
        $this->db->where('Position_type',$p_type);
        $this->db->where('Parent_ID',$binary_relation['Refer_parent_ID']);
        $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
        $query = $this->db->get('gc_binary_member_relation');
        if($query->num_rows() > 0) {
            $binary=$query->result_array();
            $this->db->select('*');
            $this->db->where('Position_type',$p_type);
            $this->db->where('Ex_position_type',$binary[0]['Ex_position_type']);
            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
            $query4 = $this->db->get('gc_binary_member_relation');
            $binary4=$query4->result_array();
            $parent=$binary4[0]["Child_ID"];
            $new_p_type=$binary4[0]['Ex_position_type'];
        }else{
            $parent=$binary_relation['Refer_parent_ID'];
            $this->db->select('*');
            $this->db->where('Child_ID',$binary_relation['Refer_parent_ID']);
            $query3 = $this->db->get('gc_binary_member_relation');
            $binary1=$query3->result_array();
            $new_p_type=$binary1[0]['Ex_position_type'];
        }
        }
        $binary_relation['Determination']   = $determin;
        $binary_relation['Position_type']   = $p_type;
        
        $this->db->select('*');
        $query1 = $this->db->get('gc_binary_member_relation');
        $row=$query1->num_rows();
        if($row==0){
            $binary_relation['Position_type']   = "";
            $binary_relation['Ex_position_type']   = "";
        }elseif($row==1){
            $binary_relation['Ex_position_type']   = $p_type;
        }elseif($row==2){
            $binary_relation['Ex_position_type']   = $p_type;
        }else{
            $binary_relation['Ex_position_type']   = $new_p_type;
        }

        $binary_relation['Parent_id']    =  $parent;
        $binary_relation['Company_id']   =  $Company_ID;
        $binary_relation['Branch_id']    =  $Company_ID;
        $binary_relation['Date']   = $Register_date;
        // var_dump($binary_relation);die();
        $this->db->insert('gc_binary_member_relation', $binary_relation);
//end Member binary Member Relationship Insert
    }

    function binary_tree_new(){
        //start Member binary Member Relationship Insert
        $binary_relation['Child_ID']        = $Membership_ID;
        $binary_relation['Level_type_ID']   = 2;
        $binary_relation['Refer_parent_ID']   = $member['Reference_ID'];
        $binary_relation['Position']   = $member_seq;
        // $binary_relation['Child_ID']        = 7;
        //     $binary_relation['Level_type_ID']   = 2;
        //     $binary_relation['Refer_parent_ID']   = 1;
        //     $binary_relation['Position']   = 3;
            $parent_id=$binary_relation['Refer_parent_ID'];
            if($binary_relation['Position'] % 2 == 0){ // determination if Start
                // echo 'right';
                 $p_type=2;
                $determin = 2;
                if($parent_id==1){
                    // echo 'right';
                    $Ex_position_type=2;
                }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('testing_tree');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }

                         $limit=1;
                        for($i=1;$i<=$limit;$i++){
                            $this->db->select('*');
                            $this->db->where('Position_type',$p_type);
                            $this->db->where('Ex_position_type',$Ex_position_type);
                            $this->db->where('Parent_ID',$parent_id);
                            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
                            $query4 = $this->db->get('testing_tree');
                            if($query4->num_rows() > 0){
                                $binary4=$query4->result_array();
                                $parent_id=$binary4[0]['Child_ID'];
                                $limit++;
                            }
            
                        }
                        
            }  // determination if End
            else{  // determination else Start
                // echo 'left';
                $p_type=1;
                $determin = 1;
                if($parent_id==1){
                    // echo 'left';
                    $Ex_position_type=1;
                    }
                else{
                    $this->db->select('*');
                    $this->db->where('Child_ID',$parent_id);
                    $query = $this->db->get('testing_tree');
                    $binary=$query->result_array();
                    $Ex_position_type=$binary[0]['Ex_position_type'];
                }

                        $limit=1;
                        for($i=1;$i<=$limit;$i++){
                            $this->db->select('*');
                            $this->db->where('Position_type',$p_type);
                            $this->db->where('Ex_position_type',$Ex_position_type);
                            $this->db->where('Parent_ID',$parent_id);
                            $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
                            $query4 = $this->db->get('testing_tree');
                            if($query4->num_rows() > 0){
                                $binary4=$query4->result_array();
                                $parent_id=$binary4[0]['Child_ID'];
                                $limit++;
                            }
            
                        }
                         
            }  // determination else End
            //echo $parent_id;
        $binary_relation['Determination']   = $determin;
        $binary_relation['Position_type']   = $p_type;
        $binary_relation['Ex_position_type']   = $Ex_position_type;
        $binary_relation['Parent_id']    =  $parent_id;
        $binary_relation['Company_id']   =  $Company_ID;
        $binary_relation['Branch_id']    =  $Company_ID;
        $binary_relation['Date']   = $Register_date;
        // var_dump($binary_relation);die();
        $this->db->insert('gc_binary_member_relation', $binary_relation);
//end Member binary Member Relationship Insert
    }



}



