<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Membership extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('is_logged_in') == '') {
            
            redirect('login');
            session_destroy();

        }
        $this->load->library('excel');
        $this->load->model('member/Membership_model');
        $this->load->model('master/Upload_model');
    }

	public function index($platform='web')
	{
        $platform = $this->input->post('platform');
        if(empty($platform)) {
            $platform = 'web';
        }
    	$template['page']            ='membership/viewmembership';
        $template['bank']            =  $this->Membership_model->getall_bank();
        $template['payment_mode']    =  $this->Membership_model->getall_payment_modes();
        $template['topup']           =  $this->Membership_model->getall_topups();
        $template['payout']          =  $this->Membership_model->getall_payouts_franchasie();
        $template['membership_type'] =  $this->Membership_model->getall_membershiptype();
        $template['invest_type']     =  $this->Membership_model->getall_invest_type();
        // var_dump($template['membership_type']);die();
        $data['data'] = ['bank'                => $template['bank'],
                             'payment_mode'    => $template['payment_mode'],
                             'topup'           => $template['topup'],
                             'payout'          => $template['payout'],
                             'membership_type' => $template['membership_type'],
                             'invest_type' => $template['invest_type']];
        if(!empty($data) & $platform != 'web') {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
        $this->load->view('template',$template);
        }
	}

public function members()
    {
        $this->load->model('member/Membership_model');
        $template['page']='membership/pending_members';
        $status=5;
        $status1='';
        $template['increment_code'] = $this->db->count_all_results('gc_membership');
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);

        $this->db->where('Status',6);
        $template['bank_status'] =  $this->db->count_all_results('gc_member_banks');

        $this->db->where('Status',6);
        $this->db->group_by('Membership_ID');
        $template['document_status'] =  $this->db->count_all_results('gc_member_documents');

        $this->db->where('Payment_status',6);
        $this->db->group_by('Membership_ID');
        $template['payment_status'] =  $this->db->count_all_results('gc_member_payments');

        
        $this->db->join('gc_membership as members', 'members.Membership_ID = gc_member_banks.Membership_ID', 'left');
        $this->db->where('gc_member_banks.Status',5);
        $this->db->where('members.Status',5);
        $this->db->from('gc_member_banks');
        $template['bank_status1'] =  $this->db->count_all_results();


        $this->db->select('members.*');
        $this->db->from('gc_membership members');
        $this->db->join('gc_member_documents', 'gc_member_documents.Membership_ID = members.Membership_ID', 'left');
        $this->db->where('gc_member_documents.Status',5);
        $this->db->where('members.Status',5);
        $this->db->group_by('gc_member_documents.Membership_ID');
        $template['document_status1'] =  $this->db->count_all_results();


        // $template['document_status'] =  $this->Membership_model->getall_members();
        // $template['payment_status'] =  $this->Membership_model->getall_members();

        // var_dump($template['membership_type']);die();
        $this->load->view('template',$template);
    }

    public function pending_members()
    {
        $this->load->model('member/Membership_model');
        $template['page']='membership/pending_members';
        $status=5;
        $status1='';
        $template['increment_code'] = $this->db->count_all_results('gc_membership');
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);
        $this->db->where('Status',6);
        $template['bank_status'] =  $this->db->count_all_results('gc_member_banks');

        $this->db->where('Status',6);
        $this->db->group_by('Membership_ID');
        $template['document_status'] =  $this->db->count_all_results('gc_member_documents');

        $this->db->where('Payment_status',6);
        $this->db->group_by('Membership_ID');
        $template['payment_status'] =  $this->db->count_all_results('gc_member_payments');
        // $template['document_status'] =  $this->Membership_model->getall_members();
        // $template['payment_status'] =  $this->Membership_model->getall_members();

        $this->db->join('gc_membership as members', 'members.Membership_ID = gc_member_banks.Membership_ID', 'left');
        $this->db->where('gc_member_banks.Status',5);
        $this->db->where('members.Status',5);
        $this->db->from('gc_member_banks');
        $template['bank_status1'] =  $this->db->count_all_results();


        $this->db->select('members.*');
        $this->db->from('gc_membership members');
        $this->db->join('gc_member_documents', 'gc_member_documents.Membership_ID = members.Membership_ID', 'left');
        $this->db->where('gc_member_documents.Status',5);
        $this->db->where('members.Status',5);
        $this->db->group_by('gc_member_documents.Membership_ID');
        $template['document_status1'] =  $this->db->count_all_results();


        // $this->db->select('members.*');
        // $this->db->from('gc_membership members');
        // $this->db->join('gc_member_payments', 'gc_member_payments.Membership_ID = members.Membership_ID', 'left');
        // $this->db->where('gc_member_payments.Payment_status!=',6);
        // $this->db->where('members.Status',5);
        // $this->db->group_by('gc_member_payments.Membership_ID');
        // $template['payment_status1'] =  $this->db->count_all_results();



        // var_dump($template['membership_type']);die();
        $this->load->view('template',$template);
    }

    // public function pending_members()
    // {
    //     $this->load->model('member/Membership_model');
    //     $template['page']='membership/processing_members';
    //     $status = 4;  
    //     $status1 = $this->input->post("status1");  
    //     $this->load->model('member/Membership_model');
    //     $template['members'] =  $this->Membership_model->getall_members($status,$status1);

    //     $this->load->view('template',$template);
    // }

        public function processing_members()
    {
        $this->load->model('member/Membership_model');
        $template['page']='membership/processing_members';
        $status=4;
        $status1='';
        $template['increment_code'] = $this->db->count_all_results('gc_membership');
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);
        $this->db->where('Status',6);
        $template['bank_status'] =  $this->db->count_all_results('gc_member_banks');

        $this->db->where('Status',6);
        $this->db->group_by('Membership_ID');
        $template['document_status'] =  $this->db->count_all_results('gc_member_documents');

        $this->db->where('Payment_status',6);
        $this->db->group_by('Membership_ID');
        $template['payment_status'] =  $this->db->count_all_results('gc_member_payments');
        // $template['document_status'] =  $this->Membership_model->getall_members();
        // $template['payment_status'] =  $this->Membership_model->getall_members();

        $this->db->join('gc_membership as members', 'members.Membership_ID = gc_member_banks.Membership_ID', 'left');
        $this->db->where('gc_member_banks.Status',5);
        $this->db->where('members.Status',4);
        $this->db->from('gc_member_banks');
        $template['bank_status1'] =  $this->db->count_all_results();


        $this->db->select('members.*');
        $this->db->from('gc_membership members');
        $this->db->join('gc_member_documents', 'gc_member_documents.Membership_ID = members.Membership_ID', 'left');
        $this->db->where('gc_member_documents.Status',5);
        $this->db->where('members.Status',4);
        $this->db->group_by('gc_member_documents.Membership_ID');
        $template['document_status1'] =  $this->db->count_all_results();

        // var_dump($template['membership_type']);die();
        $this->load->view('template',$template);
    }

    public function activated_members()
    {
        $this->load->model('member/Membership_model');
        $template['page']='membership/activated_members';
        $status=6;
        $status1='';
        $template['increment_code'] = $this->db->count_all_results('gc_membership');
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);
        $this->db->where('Status',6);
        $template['bank_status'] =  $this->db->count_all_results('gc_member_banks');

        $this->db->where('Status',6);
        $this->db->group_by('Membership_ID');
        $template['document_status'] =  $this->db->count_all_results('gc_member_documents');

        $this->db->where('Payment_status',6);
        $this->db->group_by('Membership_ID');
        $template['payment_status'] =  $this->db->count_all_results('gc_member_payments');

        $this->load->view('template',$template);
    }

    public function rejected_members()
    {
        $this->load->model('member/Membership_model');
        $template['page']='membership/rejected_members';
        $status=['7','8'];
        $status1='';
        $template['increment_code'] = $this->db->count_all_results('gc_membership');
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);
        $this->db->where('Status',6);
        $template['bank_status'] =  $this->db->count_all_results('gc_member_banks');

        $this->db->where('Status',6);
        $this->db->group_by('Membership_ID');
        $template['document_status'] =  $this->db->count_all_results('gc_member_documents');

        $this->db->where('Payment_status',6);
        $this->db->group_by('Membership_ID');
        $template['payment_status'] =  $this->db->count_all_results('gc_member_payments');

        $this->load->view('template',$template);
    }

    

    
public function get_referer_by_code()
        {
        $referer = $this->input->post("referer");
        
        $data['referer'] =  $this->Membership_model->get_referer_by_code($referer);
        $data['bank']            =  $this->Membership_model->getall_bank();
        $data['payment_mode']    =  $this->Membership_model->getall_payment_modes();
        $data['topup']           =  $this->Membership_model->getall_topups();
        $data['payout']          =  $this->Membership_model->getall_payouts();
        $data['membership_type'] =  $this->Membership_model->getall_membershiptype();
        if($data['referer']!=0){
        // var_dump($template['membership_type']);die();
        $temp['data'] = ['value'             => 'Success',
                        'referer'             => $data['referer'],
                         'bank'                => $data['bank'],
                         'payment_mode'        => $data['payment_mode'],
                         'topup'               => $data['topup'],
                         'payout'              => $data['payout'],
                         'membership_type'     => $data['membership_type']];
                     }else{
                        $temp['data'] = ['value'             => 'Failure',
                            'referer'             => $data['referer'],
                         'bank'                => $data['bank']="",
                         'payment_mode'        => $data['payment_mode']="",
                         'topup'               => $data['topup']="",
                         'payout'              => $data['payout']="",
                         'membership_type'     => $data['membership_type']=""];
                     }

        header('Content-Type: application/json');
        echo json_encode($temp);
    }

public function get_referer_detail()
        {
        $referer = $this->input->post("referer");
        
        $temp['referer'] =  $this->Membership_model->get_referer_by_code($referer);
         if($data['referer']!=0){
        $data['data'] = ['value'             => 'Success',
                        'referer'             => $temp['referer']];
    }else{
        $data['data'] = ['value'             => 'Failure',
                        'referer'             => $temp['referer']];
    }
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }

public function status_wise_members()
        {
        $status = $this->input->post("status");  
        $status1 = $this->input->post("status1");  
        $this->load->model('member/Membership_model');
        //$template['page']='membership/manage_members';
        $template['members'] =  $this->Membership_model->getall_members($status,$status1);

        

        if($status==5){
        $this->db->join('gc_membership as members', 'members.Membership_ID = gc_member_banks.Membership_ID', 'left');
        $this->db->where('gc_member_banks.Status',5);
        $this->db->where('members.Status',5);
        $this->db->from('gc_member_banks');
        $template['bank_status1'] =  $this->db->count_all_results();


        $this->db->select('members.*');
        $this->db->from('gc_membership members');
        $this->db->join('gc_member_documents', 'gc_member_documents.Membership_ID = members.Membership_ID', 'left');
        $this->db->where('gc_member_documents.Status',5);
        $this->db->where('members.Status',5);
        $this->db->group_by('gc_member_documents.Membership_ID');
        $template['document_status1'] =  $this->db->count_all_results();
    }elseif($status==4){
        $this->db->join('gc_membership as members', 'members.Membership_ID = gc_member_banks.Membership_ID', 'left');
        $this->db->where('gc_member_banks.Status',5);
        $this->db->where('members.Status',4);
        $this->db->from('gc_member_banks');
        $template['bank_status1'] =  $this->db->count_all_results();


        $this->db->select('members.*');
        $this->db->from('gc_membership members');
        $this->db->join('gc_member_documents', 'gc_member_documents.Membership_ID = members.Membership_ID', 'left');
        $this->db->where('gc_member_documents.Status',5);
        $this->db->where('members.Status',4);
        $this->db->group_by('gc_member_documents.Membership_ID');
        $template['document_status1'] =  $this->db->count_all_results();
    }
        $this->load->view('membership/ajax_members',$template);
    
    }

public function calculate_commission()
        {
        $status = $this->input->post("status");
        $Cal_date = $this->input->post("Cal_date");
        
        //$template['page']='membership/manage_members';
        $template['members'] =  $this->Membership_model->calculate_commission($Cal_date);
        //$this->load->view('membership/ajax_members',$template);
    }

    

public function mobile_verify()
        {
        $mobile = $this->input->post("mobile");
        // $temp['referer'] =  $this->Membership_model->mobile_verify($mobile);
        $this->db->select('Membership_ID,First_name,Last_name,Membership_code,Status');
        $this->db->where('Mobile',$mobile);
        $query = $this->db->get('gc_membership');
        if ($query->num_rows() > 0) {
            $verify['content'] =  'Member Already Exist!';
            $verify['status']  =  '1';
            $verify['value']  =  'Failiure';
            $verify['mobile']  =  "";

        }else{
            $temp['Mobile']=$mobile;
            $temp['OTP']=$this->generatePIN();
            if($this->db->insert('gc_temp_user',$temp)){
                $temp_id=$this->db->insert_id();
                $sms_content="Please Use This OTP : ".$temp['OTP'];

                // $sms_url='http://mysms.mequals.me/api/sendhttp.php?authkey=ZmQxNzA1OWEyZTE&mobiles='.$mobile.'&message='.$sms_content.'&sender=PKSEVA&type=1&route=2';
                $sms_url='http://bulksmscoimbatore.co.in/sendsms?uname=mequals&pwd=mequals@123&senderid=BUGFIX&to='.$mobile.'&msg='.urlencode($sms_content).'&route=SID';

                $ch = curl_init($sms_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sms_url);
                $response=curl_exec($ch);
                // curl_close($ch);

                if (curl_errno($ch)) {
                    $error = curl_error($ch);
                }
                $curl_data = explode(',', $response);
                curl_close($ch);
                
            }
            $verify['content'] =  'Please Enter OTP';
            $verify['status']  ='0';
            $verify['mobile']  =  $mobile;
            $verify['value']  =  'Success';

        }
        $data['data'] = ['content'             => $verify['content'],
                         'status'             => $verify['status'],
                         'mobile'               =>$verify['mobile'],
                         'value'                => $verify['value']];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
// Mobile Verity OTP End //


// Resend OTP Start //
public function resend_otp()
        {
            $mobile = $this->input->post("mobile");
            //$id = $this->input->post("temp_id");

            $temp['Mobile']=$mobile;
            $temp['OTP']=$this->generatePIN();
            $this->db->where('Mobile',$mobile);
            $this->db->delete('gc_temp_user');
            $this->db->where('Mobile',$mobile);
            if($this->db->insert('gc_temp_user',$temp)){
                $sms_content="Please Use This OTP : ".$temp['OTP'];

                // $sms_url='http://mysms.mequals.me/api/sendhttp.php?authkey=ZmQxNzA1OWEyZTE&mobiles='.$mobile.'&message='.$sms_content.'&sender=PKSEVA&type=1&route=2';
                $sms_url='http://bulksmscoimbatore.co.in/sendsms?uname=mequals&pwd=mequals@123&senderid=BUGFIX&to='.$mobile.'&msg='.urlencode($sms_content).'&route=SID';

                $ch = curl_init($sms_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sms_url);
                $response=curl_exec($ch);
                // curl_close($ch);

                if (curl_errno($ch)) {
                    $error = curl_error($ch);
                }
                $curl_data = explode(',', $response);
                curl_close($ch);
                
            }

            $verify['content']  =  'Please Enter OTP';
            $verify['status']   =  '0';
            $verify['mobile']   =  $mobile;
            

             $data['data'] = ['Content'             => $verify['content'],
                         'status'                   => $verify['status'],
                         'mobile'                   => $verify['mobile'],
                         'value'                    => "Success" ];
        header('Content-Type: application/json');
        echo json_encode($data);

        
        }
// Resend OTP END //

// Expiry OTP Start //
public function expiry_otp()
        {
            $mobile         = $this->input->post("mobile");
            $this->db->where('Mobile',$mobile);
            $query          = $this->db->delete('gc_temp_user');
            $temp['content']='OTP Expired!';
            $temp['status'] =3;


            $data['data'] = ['content'             => $temp['content'],
                            'status'               => $temp['status'],
                            'value'               => "Success"];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
// Expiry OTP End //

// Verity OTP Start //
public function verify_otp()
        {
            $mobile          = $this->input->post("mobile");
            $otp             = $this->input->post("otp");
            $this->db->select('*');
            $this->db->where('OTP',$otp);
            $this->db->where('Mobile',$mobile);
            $query           = $this->db->get('gc_temp_user');
            if ($query->num_rows() > 0) {
               $this->db->where('OTP',$otp);
               $this->db->where('Mobile',$mobile);
               $query          = $this->db->delete('gc_temp_user'); 
            $verify['content'] =  'OTP Verified!';
            $verify['status']  =  '1';
            $verify['mobile']  =  $mobile;
            $verify['value']   =  "Success";

        }else{
            $verify['content'] =  'Invalid OTP!';
            $verify['status']  =  '0';
            $verify['mobile']  =  $mobile;
            $verify['value']   =  "Failure";
        }

            $data['data'] = ['content'              => $verify['content'],
                             'status'               => $verify['status'],
                             'mobile'               => $verify['mobile'],
                            'value'                 => $verify['value']];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
// Verity OTP End //


public function get_pincode_details()
        {
            $pincode         = $this->input->post("pincode");

        $this->db->select('area.id as taluk_id,area.area_name as taluk_name,city.id as City_id,city.city_name as City_name,state.id as State_id,state.state_name as State_name,country.id as Country_id,country.country_name as Country_name');

        $this->db->from('gc_areas as area');
        $this->db->join('gc_cities as city', 'city.id = area.city_id', 'left');
        $this->db->join('gc_states as state', 'state.id = area.state_id', 'left');
        $this->db->join('gc_countries as country', 'country.id = area.country_id', 'left');
        $this->db->where("area.Pincode",$pincode);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $temp['pincode'] = $query->result_array();
            $temp['value']= "Success";
        }else{
        $temp['pincode']= "";
        $temp['value']= "Failure";

    }

            // $this->db->where('ID',$id);
            // $query          = $this->db->delete('gc_temp_user');
            // $temp['content']='OTP Expired!';
            // $temp['status'] =3;

            $data['data'] = ['pincode'             => $temp['pincode'],
                            'value'             => $temp['value']];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

public function get_topup_details()
    {
        $topup = $this->input->post("topup");
        $temp['topup'] =  $this->Membership_model->get_topup_details($topup);
        if($temp['topup']!=0){

        header('Content-Type: application/json');
        $data['data'] = ['topup'              => $temp['topup'],
                            'value'    =>"Success"];
                        }else{
                            $data['data'] = ['topup'              => $temp['topup']="",
                            'value'    =>"Failure"];
                        }
          header('Content-Type: application/json');                   
        echo json_encode($data);
    }

    
public function add()
    {
        $member = $this->input->post("member");
        $photo = $this->input->post("Photo");
        $upload1 = $this->input->post("upload1");
        $upload2 = $this->input->post("upload2");
        $upload3 = $this->input->post("upload3");
        $address_data = $this->input->post("address_data");
        $nominee_data = $this->input->post("nominee_data");
        $bank_data = $this->input->post("bank_data");
        $upload_rows = $this->input->post('upload_rows');
        $upload_rows=explode(',',$upload_rows);

        foreach($upload_rows as $val){
        $upload_data['upload_data_'.$val] = $this->input->post('upload_data_'.$val);

        $profile_name = 'upload'.$val;

        // Membership Code
        $pan=$upload_data["upload_data_1"]["Document_no"];

        if(!empty($pan)){
        $newpan = substr($pan, -5);
        }
        $newmob = substr($member['Mobile'], -5);
        $Membership_code=$newpan.$newmob;

        $docs_name = $this->Membership_model->member_profile_attachment_1($Membership_code,$profile_name,$upload_data['upload_data_'.$val]['Document_type']);

        $upload_data['upload_data_'.$val]['Folder_name']=$Membership_code;
        $upload_data['upload_data_'.$val]['Document_name']=$docs_name;
            }
        // $Upload_data = $this->input->post("Upload_data");
        $contract_data = $this->input->post("contract_data");

        $unique_id = $this->input->post('unique_id');
        $unique=explode(',',$unique_id);
        foreach($unique as $val1){
             $payment_data['payment_data_'.$val1] = $this->input->post('payment_data_'.$val1);
             $payment_data['payment_data_'.$val1]['Date']   = date('Y-m-d',strtotime($payment_data['payment_data_'.$val1]['Date']));
            }
        // $payment_data = $this->input->post("payment_data");
        $agreement_data = $this->input->post("agreement_data");

        $events1 = $this->Membership_model->add_membership($member,$address_data,$nominee_data,$bank_data,$upload_data,$contract_data,$payment_data,$agreement_data,$photo,$upload1,$upload2,$upload3);

        redirect('membership/Membership/members');

        // var_dump($agreement_data);
    }

    
    
public function tree_view()
    {
        $this->load->model('member/Membership_model');
        $id=$this->input->get('id');
        $template['page']            ='membership/tree_view';
        $template['member']          =  $this->Membership_model->get_parent_detail($id);
        // var_dump($template['member']);die();
        $template['child_parent']    =  $this->Membership_model->get_child_by_parent($template['member'][0]['Membership_ID']);
        $template['child_parent_binary']    =  $this->Membership_model->get_child_by_parent_binary($template['member'][0]['Membership_ID']);
        // var_dump($template['child_parent_binary']);
        $this->load->view('template',$template);
        
}
        

public function tree_view1()
    {
        $this->load->model('member/Membership_model');
        $Membership_ID = $this->input->get("id");
        $template['Membership_code']            =$Membership_ID;
        $template['page']            ='membership/tree_view';
        // $template['member']          =  $this->Membership_model->get_parent_detail($id);
        // // var_dump($template['member']);die();
        // $template['child_parent']    =  $this->Membership_model->get_child_by_parent($template['member'][0]['Membership_ID']);
        // $template['child_parent_binary']    =  $this->Membership_model->get_child_by_parent_binary($template['member'][0]['Membership_ID']);
        // var_dump($template['child_parent_binary']);
        $this->load->view('template',$template);
        
}

public function tabular_tree_view1()
    {
        $this->load->model('member/Membership_model');
        $Membership_ID = $this->input->get("id");
        $template['Membership_code']            =$Membership_ID;
        $template['page']            ='membership/tabular_tree_view';
        $this->load->view('template',$template);
        
    }

public function tree()
{
$template['page']            ='membership/search_tree_view';
$this->load->view('template',$template);
}

public function get_topup_list() {

    $invest_type = $this->input->post('invest_type');
    $data = $this->Membership_model->get_all_topup_list_by_invest_type($invest_type,$level_type=1);
      
    if(isset($data)){
        echo '<option value="">Select Top-up</option>';      
    foreach ($data as $value)  {
        echo '<option value="'.$value['ID'].'">'.$value['Franchise'].'</option>'; 
        }}else{
            echo '<option value="">Select Select Top-up</option>';            
      }
    }

public function get_tree_details()
    {   

        $id = $this->input->post("mobile"); 

        $this->load->model('member/Membership_model');
        $template['member_id']   =  $this->Membership_model->get_member_detailbyid($id);
        $template['member']   =  $this->Membership_model->get_parent_detail($template['member_id'][0]['Membership_ID']);
        if(!empty($template['member'] )){
        $member_refer= $template['member'][0]['Reference_ID'];
        $template['member_refer1']  =  $this->Membership_model->get_parent_referer($member_refer);
        if(!empty($template['member_refer1'])){
        $template['member_refer'] =$template['member_refer1'][0]['Membership_code'];
    }else{
         $template['member_refer'] =0;
    }
    }else{
        $template['member_refer']=0;
    }
      // echo ($template['member'][0]['Membership_code']);
        $template['child_parent']    =  $this->Membership_model->get_child_by_parent($template['member'][0]['Membership_ID']);
        $template['child_parent_binary']    =  $this->Membership_model->get_child_by_parent_binary($template['member'][0]['Membership_ID']);
       // var_dump($template['child_parent_binary']);die();
        $this->load->view('membership/ajax_tree',$template);
    }

public function get_tabular_tree_details()
    {   
        ini_set('display_errors', 0);
        $id = $this->input->post("mobile"); 

        $this->load->model('member/Membership_model');
        $template['member_id']   =  $this->Membership_model->get_member_detailbyid($id);
        $template['member']   =  $this->Membership_model->get_parent_detail($template['member_id'][0]['Membership_ID']);
        if(!empty($template['member'] )){
        $member_refer= $template['member'][0]['Reference_ID'];
        $template['member_refer1']  =  $this->Membership_model->get_parent_referer($member_refer);
        if(!empty($template['member_refer1'])){
        $template['member_refer'] =$template['member_refer1'][0]['Membership_code'];
    }else{
         $template['member_refer'] =0;
    }
    }else{
        $template['member_refer']=0;
    }
      // echo ($template['member'][0]['Membership_code']);
        $template['child_parent']    =  $this->Membership_model->get_child_by_parent($template['member'][0]['Membership_ID']);
        $template['child_parent_binary']    =  $this->Membership_model->get_child_by_parent_binary($template['member'][0]['Membership_ID']);
       // var_dump($template['child_parent_binary']);die();
        $this->load->view('membership/ajax_tree',$template);
    }

public function update_bank_status()
    {
        $bank_verify = $this->input->post("bank_verify");
        $Membership_ID = $this->input->post("Membership_ID");
        $temp['banks'] =  $this->Membership_model->update_bank_status($bank_verify,$Membership_ID);
        echo  $temp['banks'];
    }
        
    public function update_document_status()
    {
        $upload_rows = $this->input->post('upload_rows');
        $Membership_ID = $this->input->post('Membership_ID');

        $upload_rows=explode(',',$upload_rows);
        foreach($upload_rows as $val){
             $upload_data['doc_verify_'.$val]                  = $this->input->post('doc_verify_'.$val);
             $temp['docs'] =  $this->Membership_model->update_document_status($upload_data['doc_verify_'.$val],$Membership_ID);
         }
            
        echo 1;
}

public function contract()
    {
        $Membership_ID = $this->input->get("id");  

        $template['page']            ='contract/contract';
        $template['Membership_code']            =$Membership_ID;
        
        $this->load->view('template',$template);
    }


    public function members_import()
    {
        // Upload Function ## Parameter $folder_name
        $file = $this->Upload_model->Upload_excel('Members_data');
        // File Path

        $inputFileName = FCPATH . "attachments/Members_data/".$file;
        // print_r($inputFileName);

        // Process
        
            try {
                //require_once( APPPATH . 'third_party/PHPExcel.php');
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array(
                'First_name',
                'Last_name',
                'Referal_ID',
                'Mobile',
                'Gender',
                'Email',
                'DOB',
                'F_f_name',
                'F_l_name',
                'Address_1',
                'Address_2',
                'Pincode',
                'Nominee_name',
                'Nominee_relationship',
                'Nominee_mobile',
                'Reg_date',
                'Account_holder',
                'Bank_ID',
                'Account_no',
                'Branch',
                'IFSC',
                'Document_no_pan',
                'Document_no_aadhar',
                'Document_no_cheque',
                'Membership_type',
                'Topup_id',
                'Invest_type',
                'Payment_type_ID',
                'Reference_no',
                'Date'
            );

            $makeArray = array(
                'First_name'            => 'First_name',
                'Last_name'             => 'Last_name',
                'Referal_ID'            => 'Referal_ID',
                'Mobile'                => 'Mobile',
                'Gender'                => 'Gender',
                'Email'                 => 'Email',
                'DOB'                   => 'DOB',
                'F_f_name'              => 'F_f_name',
                'F_l_name'              => 'F_l_name',
                'Address_1'             => 'Address_1',
                'Address_2'             => 'Address_2',
                'Pincode'               => 'Pincode',
                'Nominee_name'          => 'Nominee_name',
                'Nominee_relationship'  => 'Nominee_relationship',
                'Nominee_mobile'        => 'Nominee_mobile',
                'Reg_date'              => 'Reg_date',
                'Account_holder'        => 'Account_holder',
                'Bank_ID'               => 'Bank_ID',
                'Account_no'            => 'Account_no',
                'Branch'                => 'Branch',
                'IFSC'                  => 'IFSC',
                'Document_no_pan'       => 'Document_no_pan',
                'Document_no_aadhar'    => 'Document_no_aadhar',
                'Document_no_cheque'    => 'Document_no_cheque',
                'Membership_type'       => 'Membership_type',
                'Topup_id'              => 'Topup_id',
                'Invest_type'            => 'Invest_type',
                'Payment_type_ID'       => 'Payment_type_ID',
                'Reference_no'          => 'Reference_no',
                'Date'                  => 'Date'
            );
            
            $SheetDataKey = array();

            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            
            $data = array_diff_key($makeArray, $SheetDataKey);
            
           
            if (empty($data)) {
                $flag = 1;
            }

            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    // $cus_code = $this->Customer_model->get_prefix();
                    // $incre_id = $this->Customer_model->get_increment_code();
                    $fetchData[$i]  = array(
                            'First_name'            => filter_var(trim($allDataInSheet[$i][$SheetDataKey['First_name']]), FILTER_SANITIZE_STRING),
                            'Last_name'             => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Last_name']]), FILTER_SANITIZE_STRING),
                            'Referal_ID'            => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Referal_ID']]), FILTER_SANITIZE_STRING),
                            'Mobile'                => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Mobile']]), FILTER_SANITIZE_STRING),
                            'Gender'                => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Gender']]), FILTER_SANITIZE_STRING),
                            'Email'                 => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Email']]), FILTER_SANITIZE_STRING),
                            'DOB'                   => filter_var(trim($allDataInSheet[$i][$SheetDataKey['DOB']]), FILTER_SANITIZE_STRING),
                            'F_f_name'              => filter_var(trim($allDataInSheet[$i][$SheetDataKey['F_f_name']]), FILTER_SANITIZE_STRING),
                            'F_l_name'              => filter_var(trim($allDataInSheet[$i][$SheetDataKey['F_l_name']]), FILTER_SANITIZE_STRING),
                            'Address_1'             => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Address_1']]), FILTER_SANITIZE_STRING),
                            'Address_2'             => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Address_2']]), FILTER_SANITIZE_STRING),
                            'Pincode'               => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Pincode']]), FILTER_SANITIZE_STRING),
                            'Nominee_name'          => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Nominee_name']]), FILTER_SANITIZE_STRING),
                            'Nominee_relationship'  => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Nominee_relationship']]), FILTER_SANITIZE_STRING),
                            'Nominee_mobile'        => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Nominee_mobile']]), FILTER_SANITIZE_STRING),
                            'Reg_date'              => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Reg_date']]), FILTER_SANITIZE_STRING),
                            'Account_holder'        => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Account_holder']]), FILTER_SANITIZE_STRING),
                            'Bank_ID'               => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Bank_ID']]), FILTER_SANITIZE_STRING),
                            'Account_no'            => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Account_no']]), FILTER_SANITIZE_STRING),
                            'Branch'                => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Branch']]), FILTER_SANITIZE_STRING),
                            'IFSC'                  => filter_var(trim($allDataInSheet[$i][$SheetDataKey['IFSC']]), FILTER_SANITIZE_STRING),
                            'Document_no_pan'       => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Document_no_pan']]), FILTER_SANITIZE_STRING),
                            'Document_no_aadhar'    => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Document_no_aadhar']]), FILTER_SANITIZE_STRING),
                            'Document_no_cheque'    => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Document_no_cheque']]), FILTER_SANITIZE_STRING),
                            'Membership_type'       => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Membership_type']]), FILTER_SANITIZE_STRING),
                            'Topup_id'              => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Topup_id']]), FILTER_SANITIZE_STRING),
                            'Invest_type'            => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Invest_type']]), FILTER_SANITIZE_STRING),
                            'Payment_type_ID'       => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Payment_type_ID']]), FILTER_SANITIZE_STRING),
                            'Reference_no'          => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Reference_no']]), FILTER_SANITIZE_STRING),
                            'Date'                  => filter_var(trim($allDataInSheet[$i][$SheetDataKey['Date']]), FILTER_SANITIZE_STRING),

                    );
                    //$result = $this->Customer_model->adding_customers($fetchData[$i]);
                   $result =  $this->Membership_model->adding_excel_data($fetchData[$i]);
                   // die();
                }
               
            } else {
                echo "Please import correct file";
            }
    }



public function Activate_member()
        {
        $Membership_ID = $this->input->post("Membership_ID");  
        $Contract_ID = $this->input->post("Contract_ID");
        $result =  $this->Membership_model->Activate_member_contract($Membership_ID,$Contract_ID);
        echo $result;
    }

public function block_member()
        {
        $Membership_ID = $this->input->post("Membership_ID");  
        $reason = $this->input->post("reason");
        $result =  $this->Membership_model->block_member_contract($Membership_ID,$reason);
        echo $result;
    }

    

 public function sms()
        {
            $mobile="8122325955";
        $sms_content="Hi Satheesh I Love U...";
        $sms_url='http://bulksmscoimbatore.co.in/sendsms?uname=mequals&pwd=mequals@123&senderid=BUGFIX&to='.$mobile.'&msg='.urlencode($sms_content).'&route=SID';

                $ch = curl_init($sms_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sms_url);
                $response=curl_exec($ch);
                // curl_close($ch);

                if (curl_errno($ch)) {
                    $error = curl_error($ch);
                }
                $curl_data = explode(',', $response);
                curl_close($ch);
    }   

public function check()
    {   
        $Membership_ID=17;
        $membership[0]['Reference_ID']=6;
        $level['Level_ID']=1;
        $Contract_ID=16;
            $this->db->select('level.Member_level_detail_ID,topup.Validity,topup.Value,lvl.Return');
            $this->db->from('gc_member_level_details as level');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID ='.$Contract_ID, 'left');
            $this->db->join('gc_member_topup as topup', 'topup.ID =contract.Topup_id', 'left');
            $this->db->join('gc_level as lvl', 'lvl.ID ='.$level['Level_ID'], 'left');
            $this->db->where('level.Child_ID',$Membership_ID);
            $this->db->where('level.Membership_ID',$membership[0]['Reference_ID']);
            $this->db->where('level.Level_ID',$level['Level_ID']);
            $query= $this->db->get();
            $level_details=$query->result_array();
            var_dump($level_details);
}

public function generatePIN($digits = 4){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

public function check1() {
        $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',2);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);
            $final_days=[];
            $final_days1=[];
            foreach($week_days as $value){
                $new = [];
                for($i = 1;$i<=12;$i++){
                    $days = $this->getDays(date('Y'),$i,$value);
                    $final[] = $days;
                    foreach($days as $val){
                        array_push($final_days,$val);
                    }
                    
                }
                    
                // array_push($final_days)
            }
            var_dump($final_days);


            //echo date('Y-n-j');
            if(in_array(date('Y-n-j'), $final_days)){
                //echo "irukku";
            $this->db->where('Date',date('Y-m-d'));
            $query = $this->db->get('gc_individual_calendar');
            if ($query->num_rows() > 0) {
                //echo "not insert";
                //echo "illa";
            }else{
                //echo "irukku1";
               // echo $new_date=array_search(date('Y-n-j'), $final_days)-1;
               // $first_date=date('Y-m-d');

               // date('Y-m-d', strtotime("+3 months", strtotime($effectiveDate)));

               // date("Y-m-d", strtotime('+'.$i.' Monday' ,strtotime($first_date)));

               // array_push($new,date("Y-m-d", strtotime('+'.$i.' Monday')));
        }

        }

    }
}

public function get_advance_date(){
$ad_days=0;
$cur_date=date('2019-01-10');
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
        echo  $final_dates[$keyval];
    }else{
        echo date('Y-01-01');
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

    public function getDays($y,$m,$d){ 
    $date = "$y-$m-1";
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

public function check3() {

            $date=new DateTime();
        $year=date('Y');
                    $date->setDate($year, 01, 01);
                    $dt = $date->format('Y-m-d');
         $day=date('l', strtotime($dt));
        $day_of_week = date('N', strtotime($day));

        $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',2);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);
            $arr1=[];
            $arr2=[];
            foreach($week_days as $wk){
                if($day_of_week==$wk){

                }
            }
        }
    }


function check5(){
    $date=new DateTime();
$year=date('Y');
            $date->setDate($year, 01, 01);
            $dt = $date->format('Y-m-d');
 $day=date('l', strtotime($dt));
$day_of_week = date('N', strtotime($day));

$new=[];
$new1=['Tuesday','Wednesday','Thursday','Friday','Monday',];
$new2=['1'=>'Tuesday','2'=>'Wednesday','3'=>'Thursday','4'=>'Friday','5'=>'Monday',];
$first_date=date('Y-01-01');
//$count=count();
for($i=1; $i<=52; $i++){
    
        foreach($new2 as $key=> $newval){
          
        echo  date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($first_date))).'<br>';
        }

         //foreach($new2 as $key=> $newval){
       
        //echo  date("Y-m-d", strtotime('+'.$i.$newval ,strtotime($first_date))).'<br>';
        
       // }
    //}
        
}
}

public function check6(){
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
    foreach($final_dates as $key=> $fin){
if(date('Y-m-d')==$fin){
    $keyval= $key-1;
}
    }
   return $serch_date=$final_dates[$keyval];
}
}

public function check7(){
        $this->db->select('Weeks');
        $this->db->where('Status',1);
        $this->db->where('ID',1);
        $query = $this->db->get('gc_leveltype');
        if ($query->num_rows() > 0) {
            $days=$query->result_array();
            $week_days=explode(',',$days[0]['Weeks']);
            $final_days=[];
            $final_days1=[];
            
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
    //var_dump($final_dates);


            if(in_array(date('Y-m-d'), $final_dates)){

            $this->db->where('Date',date('Y-m-d'));
            $query = $this->db->get('gc_individual_calendar');
            if ($query->num_rows() > 0) {
                //echo "not insert";
            }else{
               
                // Get Transaction Tabl
                $this->db->select('transaction.*');
                $this->db->from('gc_transaction as transaction');
                $this->db->join('gc_membership as member', 'member.Membership_ID = transaction.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = transaction.Contract_ID', 'left');

                $this->db->where('transaction.Transaction_status',1);
                $this->db->where('member.Status',6);
                $this->db->where('contract.Withdrawn_status',5);
                $query1 = $this->db->get();
                if ($query1->num_rows() > 0) {
                    $transaction=$query1->result_array();
                    // var_dump($final_days);die();
                    foreach($transaction as $tran){

                    $commision_data=array(
                            'Company_id'       => $this->session->userdata('CompanyId'),
                            'Branch_id'        => $this->session->userdata('CompanyId'),
                            'Transaction_ID'   => $tran['Transaction_ID'],
                            'Membership_ID'    => $tran['Membership_ID'], 
                            'Contract_ID'      => $tran['Contract_ID'], 
                            'Transaction_type' => $tran['Transaction_ID'],
                            'Commision_date'  => date('Y-m-d'), 
                            'Remarks'          => '', 
                            'Created_by'       => $this->session->userdata('UserId')
                            );
                    $this->db->insert('gc_member_commission',$commision_data);
                    $commision_id=$this->db->insert_id();

                    // Get Transaction detail Table
                    $this->db->select('*');
                    $this->db->where('Status',1);
                    $this->db->where('Transaction_ID',$tran['Transaction_ID']);
                    $query2 = $this->db->get('gc_transaction_details');
                      if ($query2->num_rows() > 0) {
                        $transaction_detail=$query2->result_array();
                        foreach($transaction_detail as $tran_det){
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
                            'Payout_ID'                => $tran_det['Payout_ID'],
                            'Commision_date'           => date('Y-m-d'), 
                            'Amount'                   => $tran_det['Amount'], 
                            'Commision'                => $tran_det['Commision'],
                            'Remarks'                  => '', 
                            'Created_by'               => $this->session->userdata('UserId')
                            );
                            $this->db->insert('gc_member_commission_details',$commision_detail_data);

                        }

                      }
            }

          }
        }

        }

    }

}
public function check10(){
            $level_counts=[];
            $grade_ids=[];
            for($j=1;$j<=9;$j++){
                $this->db->where('Membership_ID',1);
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
                $this->db->where('Membership_ID',1);
                $this->db->update('gc_membership',$membership_data);
                }
            }

            }
        }

        function check21(){
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
        }


        function check50(){

            //echo $limit=$this->db->count_all_results('gc_binary_member_relation');

            $limit=1;
            $p_type=1;
            $Ex_position_type=1;
            $parent_id=101;
            for($i=1;$i<=$limit;$i++){
                $this->db->select('*');
                $this->db->where('Position_type',$p_type);
                $this->db->where('Ex_position_type',$Ex_position_type);
                $this->db->where('Parent_ID',$parent_id);
                $this->db->order_by("Binary_relation_ID", "DESC")->limit(1);
                $query4 = $this->db->get('gc_binary_member_relation');
                if($query4->num_rows() > 0){
                    $binary4=$query4->result_array();
                    echo $parent_id=$binary4[0]['Child_ID'].'<br>';
                    $limit++;
                }

            }
            echo $parent_id;

        }

        function check51(){
            $binary_relation['Child_ID']        = 102   ;
            $binary_relation['Level_type_ID']   = 2;
            $binary_relation['Refer_parent_ID']   = 1;
            $binary_relation['Position']   = 7;
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
                        
        $binary_relation['Determination']   = $determin;
        $binary_relation['Position_type']   = $p_type;
        $binary_relation['Ex_position_type']   = $Ex_position_type;
        $binary_relation['Parent_id']    =  $parent_id;
        $binary_relation['Company_id']   =  1;
        $binary_relation['Branch_id']    =  1;
        $binary_relation['Date']   = '';
        var_dump($binary_relation);die();
        $this->db->insert('gc_binary_member_relation', $binary_relation);
        }

        function check52(){
            //echo $this->random_strings(10);
            //$this->load->helper('string');
           echo random_string('alnum',10);
        }

 function random_strings($length_of_string) { 
$this->load->helper('string');
            return substr(bin2hex(random_bytes($length_of_string)),0, $length_of_string); 

}

function check53(){
    $this->db->select('transaction.*,contract.Payment_status_date,contract.Contract_ID,member.Members_count');
                $this->db->from('gc_transaction as transaction');
                $this->db->join('gc_membership as member', 'member.Membership_ID = transaction.Membership_ID', 'left');
                $this->db->join('gc_member_franchisee_contract as contract', 'contract.Contract_ID = transaction.Contract_ID', 'left');
                $this->db->join('gc_transaction_details as t_det', 't_det.Transaction_ID = transaction.Transaction_ID', 'left');

                $this->db->where('transaction.Transaction_status',1);
                $this->db->where('member.Status',6);
                $this->db->where('contract.Withdrawn_status',5);
                $this->db->where('member.Membership_ID',1);

                $this->db->group_by('t_det.Transaction_ID');
                // $this->db->where('transaction.Transaction_date <=',date('Y-m-d',strtotime($previous_trading)));
                $query1 = $this->db->get();
                $members=$query1->result_array();
                //var_dump($members);




     $this->db->select('sum(topup.Value) as Volume');
    // $this->db->select('level.Child_ID');
     $this->db->from('gc_member_level_details as level');
     $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = level.Child_ID', 'left');
     $this->db->join('gc_member_topup as topup', 'topup.ID = contract.Topup_id', 'left');
     $this->db->join('gc_membership as member', 'member.Membership_ID = level.Child_ID', 'left');
     $this->db->where('level.Membership_ID',1);
     $this->db->where('level.Level_ID',1);
     $this->db->where('member.Status',6);
     $this->db->where('contract.Withdrawn_status',5);
      $query1 = $this->db->get();
      $transaction=$query1->result_array();

      $this->db->select('*');
    $this->db->from('gc_commission_setting');
    $this->db->where('Status',1);
    $query = $this->db->get();
      $commission=$query->result_array();

      if($commission[0]['Members_count']>=$members[0]['Members_count'] || $commission[0]['Volume_amount']>=$transaction[0]['Volume']){
        echo 'eligible';
      }else{
        'not_eligible';
      }
}
}

