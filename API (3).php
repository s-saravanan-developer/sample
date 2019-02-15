<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class API extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // if ($this->session->userdata('is_logged_in') == '') {
            
        //     redirect('login');
        //     session_destroy();

        // }
        $this->load->model('member/Membership_model');
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
        $template['payout']          =  $this->Membership_model->getall_payouts();
        $template['membership_type'] =  $this->Membership_model->getall_membershiptype();
        // var_dump($template['membership_type']);die();
        $data['data'] = ['bank'                => $template['bank'],
                             'payment_mode'    => $template['payment_mode'],
                             'topup'           => $template['topup'],
                             'payout'          => $template['payout'],
                             'membership_type' => $template['membership_type']];
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
        $template['page']='membership/manage_members';
        $template['members'] =  $this->Membership_model->getall_members();
        $template['bank_status'] =  $this->Membership_model->getall_members();
        $template['document_status'] =  $this->Membership_model->getall_members();
        $template['payment_status'] =  $this->Membership_model->getall_members();

        // var_dump($template['membership_type']);die();
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
        
        $data['referer'] =  $this->Membership_model->get_referer_by_code($referer);
         if($data['referer']!=0){
         $temp['data'] = ['value'             => 'Success',
                        'referer'             => $data['referer']];
                     }else{
                        $temp['data'] = ['value'             => 'Failure',
                            'referer'             => $data['referer']=[]];
                     }
        header('Content-Type: application/json');
        echo json_encode($temp);
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
            $verify['temp_id']  =  "";

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
            $verify['temp_id']  =  $temp_id;
            $verify['value']  =  'Success';

        }
        $data['data'] = ['content'             => $verify['content'],
                         'status'             => $verify['status'],
                         'mobile'               =>$verify['mobile'],
                         'temp_id'               =>$verify['temp_id'],
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
            $query          = $this->db->get('gc_temp_user');
            if ($query->num_rows() > 0) {
               $this->db->where('OTP',$otp);
               $this->db->where('Mobile',$mobile);
               $query          = $this->db->delete('gc_temp_user'); 
            $verify['content'] =  'OTP Verified!';
            $verify['status']  =  '1';
            $verify['mobile']  =  $mobile;
            $verify['value']  =  "Success";

        }else{
            $verify['content'] =  'Invalid OTP!';
            $verify['status']  =  '0';
            $verify['mobile']  =  $mobile;
            $verify['value']  =  "Failure";
        }

            $data['data'] = ['content'              => $verify['content'],
                             'status'               => $verify['status'],
                             'mobile'               => $verify['mobile'],
                            'value'               => $verify['value']];
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

    
public function member()
    {

// $data['member']='';        
// $data['address']='';
// $data['nominee']='';
// $data['profile']='';
// $this->session->set_userdata($data);
extract($_POST);
if(!empty($_POST)){

// $data['member']=array(
//                       'Reference_ID'=>$Reference_ID,
//                       'Prefix'=>$Prefix,
//                       'First_name'=>$First_name,
//                       'Last_name'=>$Last_name,
//                       'F_prefix'=>$F_prefix,
//                       'F_f_name'=>$F_f_name,
//                       'F_l_name'=>$F_l_name,
//                       'Gender'=>$Gender,
//                       'DOB'=>$DOB,
//                       'Mobile'=>$Mobile,
//                       'Email'=>$Email
//                       );

// $data['address']=array(
//               'Pincode'=> $Pincode,
//               'Area'=> $Area,
//               'City'=> $City,
//               'State'=> $State,
//               'Country'=> $Country,
//               'Address_1'=> $Address_1,
//               'Address_2'=> $Address_2,
//               'Landmark'=> $Landmark,
//               'Address_type'=> $Address_type
//               );
// $data['nominee']=array(
//               'Nominee_name' => $Nominee_name,
//               'Nominee_relationship' => $Nominee_relationship,
//               'Nominee_mobile' => $Nominee_mobile
//               );

$data=array(
              'Reference_ID'=>$Reference_ID,
              'Prefix'=>$Prefix,
              'First_name'=>$First_name,
              'Last_name'=>$Last_name,
              'F_prefix'=>$F_prefix,
              'F_f_name'=>$F_f_name,
              'F_l_name'=>$F_l_name,
              'Gender'=>$Gender,
              'DOB'=>$DOB,
              'Mobile'=>$Mobile,
              'Email'=>$Email,
              'Pincode'=> $Pincode,
              'Area'=> $Area,
              'City'=> $City,
              'State'=> $State,
              'Country'=> $Country,
              'Address_1'=> $Address_1,
              'Address_2'=> $Address_2,
              'Landmark'=> $Landmark,
              'Address_type'=> $Address_type,
              'Nominee_name' => $Nominee_name,
              'Nominee_relationship' => $Nominee_relationship,
              'Nominee_mobile' => $Nominee_mobile
);

if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}else{
  if($this->db->insert('gc_member_temp',$data)){
    $Temp_ID=$this->db->insert_id();
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}

}else{
    $temp['value']="Empty";
    $temp['Temp_ID']='';
}
    //     if(!empty($this->session->userdata($member))){

    //     $this->session->set_userdata($member);
    // }else{
    //     unset($this->session->userdata($member));
    //     $this->session->set_userdata($member);
    // }

//         $address_data = $this->input->post("address_data");
//         $nominee_data = $this->input->post("nominee_data");
//         $bank_data = $this->input->post("bank_data");
//         $upload_rows = $this->input->post('upload_rows');
//         $upload_rows=explode(',',$upload_rows);
//         foreach($upload_rows as $val){
//              $upload_data['upload_data_'.$val]                  = $this->input->post('upload_data_'.$val);
// }
        // $Upload_data = $this->input->post("Upload_data");
//         $contract_data = $this->input->post("contract_data");

//         $unique_id = $this->input->post('unique_id');
//         $unique=explode(',',$unique_id);
//         foreach($unique as $val1){
//              $payment_data['payment_data_'.$val1]                  = $this->input->post('payment_data_'.$val1);
// }
        // $payment_data = $this->input->post("payment_data");
        // $agreement_data = $this->input->post("agreement_data");

        // $events1 = $this->Membership_model->add_membership($member,$address_data,$nominee_data,$bank_data,$upload_data,$contract_data,$payment_data,$agreement_data);

     
$member['data'] = ['value'              => $temp['value'],
                'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($member);

        // var_dump($agreement_data);
    }

public function profile_upload(){

   // error_reporting(0);

extract($_POST);
$data['profile']='';
$this->session->set_userdata($data);
extract($_POST);
if(!empty($_POST)){

$data=array(
//'mobile' => $mobile_upload,
// 'Photo' => base64_decode($Photo)
'Photo' => $Photo
);

if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}else{
  if($this->db->insert('gc_member_temp',$data)){
    $Temp_ID=$this->db->insert_id();
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}
}else{
    $temp['value']="Empty";
    $temp['Temp_ID']=''; 
}

// $ref_no="sarvan";
// $name="profile";
// if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                   }
//                   $dir_exist = true; // flag for checking the directory exist or not
//                   if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                       $dir_exist = false; // dir not exist
//                   }
//     define('UPLOAD_DIR', './attachments/Members/'.$ref_no.'/');
//     $image_base64 = base64_decode($Photo);

//     $file = UPLOAD_DIR . $ref_no.'_'.$name . '.jpg';
//     $success=file_put_contents($file, $image_base64);
//     if($success){
//         $temp['value']='Success';
//     }else{
//         $temp['value']='Failed';
//     }

//var_dump($image);


$profile['data'] = ['value'              => $temp['value'],
                'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($profile);

}   

public function member_bank(){

$data['bank']='';
$this->session->set_userdata($data);
extract($_POST);
if(!empty($_POST)){
    $data=array(
                        'Bank_ID' => $Bank_ID,
                        'Account_holder' => $Account_holder,
                        'Account_no' => $Account_no,
                        'Branch' => $Branch,
                        'IFSC' => $IFSC
                        );

if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}
}else{
    $temp['value']="Temp ID Empty";
    $temp['Temp_ID']='';


}

$bank['data'] = ['value'              => $temp['value'],
                'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($bank);

} 

public function pan2(){
  extract($_POST);
  

  $photo_name = $this->upload_api_image($Membership_code='sarvana',$profile_type='pan',$Document_image_pan);
  echo $path="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$Membership_code.'/';
}
public function pan_upload(){

extract($_POST);
if(!empty($_POST)){

$data=array(
'Document_type_pan' => $Document_type_pan,
//'mobile' => $mobile_upload,
'Document_no_pan' => $Document_no_pan,
// 'Document_name_pan' => base64_decode($Document_image_pan)
'Document_name_pan' => $Document_image_pan
);

if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}
}else{
    $temp['value']="Temp ID Empty"; 
    $temp['Temp_ID']='';
}

// $ref_no="sarvan";
// $name="pan";
// if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                   }
//                   $dir_exist = true; // flag for checking the directory exist or not
//                   if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                       $dir_exist = false; // dir not exist
//                   }
//     define('UPLOAD_DIR', './attachments/Members/'.$ref_no.'/');
//     $image_base64 = base64_decode($_POST['Document_image_pan']);

//     $file = UPLOAD_DIR . $ref_no.'_'.$name . '.jpg';
//     $success=file_put_contents($file, $image_base64);
//     if($success){
//         $temp['value']='Success';
//     }else{
//         $temp['value']='Failed';
//     }

//var_dump($image);


$pan['data'] = ['value'              => $temp['value'],
                'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($pan);

}   

public function addhar_upload(){

extract($_POST);
if(!empty($_POST)){

$data=array(
//'Document_no_pan' => $Document_no_pan,
//'mobile' => $mobile_upload,
'Document_type_aadhar' => $Document_type_addhar,
'Document_no_aadhar' => $Document_no_addhar,
// 'Document_name_aadhar' => base64_decode($Document_image_addhar)
'Document_name_aadhar' => $Document_image_addhar
);
if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}
}else{
    $temp['value']="Temp ID Empty";
    $temp['Temp_ID']='';
}


// $ref_no="sarvan";
// $name="aadhar";
// if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                   }
//                   $dir_exist = true; // flag for checking the directory exist or not
//                   if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                       $dir_exist = false; // dir not exist
//                   }
//     define('UPLOAD_DIR', './attachments/Members/'.$ref_no.'/');
//     $image_base64 = base64_decode($Document_image_addhar);

//     $file = UPLOAD_DIR . $ref_no.'_'.$name . '.jpg';
//     $success=file_put_contents($file, $image_base64);
//     if($success){
//         $temp['value']='Success';
//     }else{
//         $temp['value']='Failed';
//     }

      $aadhar['data'] =  ['value'              => $temp['value'],
                        'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($aadhar);

}

public function check_upload(){

extract($_POST);
if(!empty($_POST)){

$data=array(
'Document_type_cheque' => $Document_type_check,
'Document_no_cheque' => $Document_no_check,
// 'Document_name_cheque' => base64_decode($Document_image_check)
'Document_name_cheque' => $Document_image_check
);
if($Temp_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){
  //$this->session->set_userdata($data);
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
}
}


}else{
    $temp['value']="Temp ID Empty";
    $temp['Temp_ID']='';
}
// $ref_no="sarvan";
// $name="cheque";
// if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                   }
//                   $dir_exist = true; // flag for checking the directory exist or not
//                   if (!is_dir('./attachments/Members/'.$ref_no))
//                   {
//                       mkdir('./attachments/Members/'.$ref_no, 0777, true);
//                       $dir_exist = false; // dir not exist
//                   }
//     define('UPLOAD_DIR', './attachments/Members/'.$ref_no.'/');
//     $image_base64 = base64_decode($Document_image_check);

//     $file = UPLOAD_DIR . $ref_no.'_'.$name . '.jpg';
//     $success=file_put_contents($file, $image_base64);
//     if($success){
//         $temp['value']='Success';
//     }else{
//         $temp['value']='Failed';
//     }


        $cheque['data'] = ['value'              => $temp['value'],
                        'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($cheque);

}

public function add_payment(){

extract($_POST);
if(!empty($_POST)){
    
    $data=array(
        'Temp_ID' => $Temp_ID,
        'Payment_type_ID' => $Payment_type_ID,
        'Bank_ID' => $Bank_ID,
        'Reference_no' => $Reference_no,
        'Date' => $Date,
        'Amount' => $Amount,
        'Remarks' => $Remarks 
    );

//$payment['payment']=$this->session->userdata('payment');
if($Temp_ID!='' && $Payment_ID!=''){
  $this->db->where('Temp_ID',$Temp_ID);
  $this->db->where('Payment_ID',$Payment_ID);
  if($this->db->update('gc_payment_temp',$data)){
  //$this->session->set_userdata($data);

    $this->db->select('*');
    $this->db->where('Temp_ID',$Temp_ID);
    $query=$this->db->get('gc_payment_temp');
    if ($query->num_rows() > 0) {
          $temp['Payment']=$query->result_array();
        }else{
          $temp['Payment']='';
        }
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
    $temp['Payment_ID']=$Payment_ID;
}
}elseif($Temp_ID!='' && $Payment_ID ==''){
  if($this->db->insert('gc_payment_temp',$data)){
    $Payment_ID=$this->db->insert_id();
  //$this->session->set_userdata($data);
    $temp['value']="success";
    //$temp['Temp_ID']=$Temp_ID;
    //$temp['Payment_ID']=$Payment_ID;

    $this->db->select('*');
    $this->db->where('Temp_ID',$Temp_ID);
    $query1=$this->db->get('gc_payment_temp');
    if ($query1->num_rows() > 0) {
          $temp['Payment']=$query1->result_array();
        }else{
          $temp['Payment']='';
        }

    //$payment['payment']=$Payment_ID;
}
}
}else{
    $temp['value']="Empty";
    //$temp['Temp_ID']='';
    //$temp['Payment_ID']='';
    $temp['Payment']='';
}

$payment['data'] = ['value'                   => $temp['value'],
                    //'Temp_ID'                 => $temp['Temp_ID'],
                    //'Payment_ID'              => $temp['Payment_ID'],
                    'Payment'                 => $temp['Payment']];
        header('Content-Type: application/json');                   
        echo json_encode($payment);

}

public function view_payment(){

extract($_POST);
if(!empty($_POST)){
  if($Temp_ID!=''){
        $this->db->select('temp.*,gc_bank.Bank_name,mode.Payment_mode');
        $this->db->from('gc_payment_temp as temp');
        $this->db->join('gc_bank as gc_bank', 'gc_bank.ID = temp.Bank_ID', 'left');
        $this->db->join('gc_payment_mode as mode', 'mode.ID = temp.Payment_type_ID', 'left');
        $this->db->where('temp.Temp_ID',$Temp_ID);
    $query=$this->db->get();
    if ($query->num_rows() > 0) {
          $temp['Payment']=$query->result_array();
          $temp['value']="success";
        }else{
          $temp['Payment']=[];
          $temp['value']="Failed";
        }
    
  }
}else{
    $temp['value']="Failed";
    $temp['Payment']=[];
}

$payment['data'] = ['value'              => $temp['value'],
                    'Payment'                 => $temp['Payment']];
        header('Content-Type: application/json');                   
        echo json_encode($payment);
}

public function delete_payment(){

extract($_POST);
if(!empty($_POST)){

    if($Temp_ID!='' && $Payment_ID!=''){
      $this->db->where('Payment_ID',$Payment_ID);
      $this->db->where('Temp_ID',$Temp_ID);
      $this->db->delete('gc_payment_temp');

    $this->db->select('*');
    $this->db->where('Temp_ID',$Temp_ID);
    $query=$this->db->get('gc_payment_temp');
    if ($query->num_rows() > 0) {
          $temp['Payment']=$query->result_array();
        }else{
          $temp['Payment']='';
        }
    $temp['value']="success";
    $temp['Temp_ID']=$Temp_ID;
  }

}else{
    $temp['value']="Empty";
    $temp['Temp_ID']=$Temp_ID;
    $temp['Payment']='';
}

$payment['data'] = ['value'              => $temp['value'],
                    'Temp_ID'                 => $temp['Temp_ID'],
                    'Payment'                 => $temp['Payment']];
        header('Content-Type: application/json');                   
        echo json_encode($payment);

}

public function final_url(){
extract($_POST);
if(!empty($_POST)){
  if($Temp_ID!=''){
    $data=array(
'Temp_ID' => $Temp_ID,
'Membership_type' => $Membership_type,
'Topup_id' => $Topup_id,
'Old_payout_ID' => $Old_payout_ID,
'New_payout_ID' => $New_payout_ID,
'Payout_status' => $Payout_status,
'Delivery_mode' => $Delivery_mode,
'Referal_ID' => $Referal_ID,
//'Auth_Name' => $Auth_Name,
//'Auth_Mobile' => $Auth_Mobile,
'Address' => $Address,
//'Landmark' => $Landmark,
'Alter_No' => $Alter_No,
'Register_from' => $Register_from);
  $this->db->where('Temp_ID',$Temp_ID);
  if($this->db->update('gc_member_temp',$data)){

    $this->db->select('*');
    $this->db->where('Temp_ID',$Temp_ID);
    $query=$this->db->get('gc_member_temp');
    if ($query->num_rows() > 0) { // Row IF Start
        

        $member_table=$query->result_array();
        // Membership Code

        $pan=$member_table[0]["Document_no_pan"];
        
        $newpan = substr($pan, -5);
        $newmob = substr($member_table[0]["Mobile"], -5);
        $Membership_code=$newpan.$newmob;

        $profile = $member_table[0]["Photo"];
        $pan_name = $member_table[0]["Document_name_pan"];
        $aadhar_name = $member_table[0]["Document_name_aadhar"];
        $cheque_name = $member_table[0]["Document_name_cheque"];
        $profile_type="Profile";
        $pan_type=$member_table[0]["Document_type_pan"];
        $aadhar_type=$member_table[0]["Document_type_aadhar"];
        $cheque_type=$member_table[0]["Document_type_cheque"];
        $photo_name = $this->upload_api_image($Membership_code,$profile_type,$profile);
        $pan_name = $this->upload_api_image($Membership_code,$pan_type,$pan_name);
        $aadhar_name = $this->upload_api_image($Membership_code,$aadhar_type,$aadhar_name);
        $cheque_name = $this->upload_api_image($Membership_code,$cheque_type,$cheque_name);
        $increment_code = $this->db->count_all_results('gc_membership')+1;


        
// Membership Insert start
        $this->load->helper('string');
            $random_id=random_string('alnum',10);
        $member_data=array(
                      'Company_id'=>1,
                      'Branch_id'=>1,
                      'Member_no'=>"GRNC-MEM-0000".$increment_code,
                      'Membership_code'=>$Membership_code,
                      'Member_sequence'=>$increment_code-1,
                      'DOB'=>date("Y-m-d", strtotime($member_table[0]['DOB'])),
                      'Status'=>5,
                      'Photo'=>$photo_name,
                      'Photo_path'=> 'http://'.$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$Membership_code.'/',
                      'Created_by'=>$member_table[0]['Mobile'],
                      'Reference_ID'=>$member_table[0]['Reference_ID'],
                      'Prefix'=>$member_table[0]['Prefix'],
                      'First_name'=>$member_table[0]['First_name'],
                      'Last_name'=>$member_table[0]['Last_name'],
                      'F_prefix'=>$member_table[0]['F_prefix'],
                      'F_f_name'=>$member_table[0]['F_f_name'],
                      'F_l_name'=>$member_table[0]['F_l_name'],
                      'Random_ID' => $random_id,
                      'Gender'=>$member_table[0]['Gender'],
                      'DOB'=>$member_table[0]['DOB'],
                      'Mobile'=>$member_table[0]['Mobile'],
                      'Email'=>$member_table[0]['Email'],
                      'Membership_type'=>$member_table[0]['Membership_type'],
                      'Register_from' => $member_table[0]['Register_from'],
                      'Terms_status' => 1
                      );

        //var_dump($member_data);

        if($this->db->insert('gc_membership', $member_data)){
            $Membership_ID=$this->db->insert_id();
        }
// Membership Insert end   

//start Member upload_data Insert
        $pan_data=array(
                      'Company_id'=>1,
                      'Branch_id'=>1,
                      'Membership_ID'=>$Membership_ID,
                      'Document_type' => $member_table[0]["Document_type_pan"],
                      'Document_no' => $member_table[0]["Document_no_pan"],
                      'Document_name' => $pan_name,
                      'File_path'=>"http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$Membership_code.'/'
        );
        $this->db->insert('gc_member_documents', $pan_data);

        $aadhar_data=array(
                      'Company_id'=>1,
                      'Branch_id'=>1,
                      'Membership_ID'=>$Membership_ID,
                      'Document_type' => $member_table[0]["Document_type_aadhar"],
                      'Document_no' => $member_table[0]["Document_no_aadhar"],
                      'Document_name' => $aadhar_name,
                      'File_path'=>"http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$Membership_code.'/'
        );
        $this->db->insert('gc_member_documents', $aadhar_data);

        $cheque_data=array(
                      'Company_id'=>1,
                      'Branch_id'=>1,
                      'Membership_ID'=>$Membership_ID,
                      'Document_type' => $member_table[0]["Document_type_cheque"],
                      'Document_no' => $member_table[0]["Document_no_cheque"],
                      'Document_name' => $cheque_name,
                      'File_path'=>"http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$Membership_code.'/'
        );
        $this->db->insert('gc_member_documents', $cheque_data);

//end Member upload_data Insert     

//start Member Address Insert

$address_data=array(
              'Company_id'           =>1,
              'Branch_id'            =>1,
              'Membership_ID'        =>$Membership_ID,
              'Pincode'              => $member_table[0]['Pincode'],
              'Area'                 => $member_table[0]['Area'],
              'City'                 => $member_table[0]['City'],
              'State'                => $member_table[0]['State'],
              'Country'              => $member_table[0]['Country'],
              'Address_1'            => $member_table[0]['Address_1'],
              'Address_2'            => $member_table[0]['Address_2'],
              'Landmark'             => $member_table[0]['Landmark'],
              'Address_type'         => $member_table[0]['Address_type']
              );

        $this->db->insert('gc_member_address', $address_data);
//end Member Address Insert

// start User Insert
       $user_data['user_id']         = $Membership_ID;
       $user_data['company_id']      = 1;
       $user_data['branch_id']       = 1;
       $user_data['firstname']       = $member_data['First_name'];
       $user_data['username']        = $member_data['Membership_code'];
       $user_data['password']        = md5($member_data['Mobile']);
       $user_data['og_password']     = $member_data['Mobile'];
       $user_data['email_address']   = $member_data['Email'];
       $user_data['mobile_number']   = $member_data['Mobile'];
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

    $reg = array('firstname'         => $member_data['First_name'],
                 'lastname'          => $member_data['Last_name'],
                 'customer_group_id' => '1',
                 'language_id'       => '1',
                 'email'             => $member_data['Email'],
                 'telephone'         => $member_data['Mobile'],
                 'status'            => '1',
                 'email'             => $member_data['Email'],                         
                 'password'          => md5($member_data['Mobile']),                         
                 'Member_id'         => $Membership_ID,                         
                );
        $opencart = $this->load->database('wixsite_greencart', TRUE);
        // opencart
        if ($opencart->insert('greencrest_customer', $reg)) {
             $opencart->insert_id();
        } 
// End Open Cart Table
//start Member nominee_data Insert
$nominee_data=array(
              'Company_id'           =>1,
              'Branch_id'            =>1,
              'Membership_ID'        =>$Membership_ID,
              'Nominee_name'         => $member_table[0]['Nominee_name'],
              'Nominee_relationship' => $member_table[0]['Nominee_relationship'],
              'Nominee_mobile'       => $member_table[0]['Nominee_mobile']
              );
              $this->db->insert('gc_member_nominees', $nominee_data);
//end Member nominee_data Insert

//start Member bank_data Insert
    $bank_data=array(
                'Company_id'          =>1,
                'Branch_id'           =>1,
                'Membership_ID'       =>$Membership_ID,
                'Bank_ID'             => $member_table[0]['Bank_ID'],
                'Account_holder'      => $member_table[0]['Account_holder'],
                'Account_no'          => $member_table[0]['Account_no'],
                'Branch'              => $member_table[0]['Branch'],
                'IFSC'                => $member_table[0]['IFSC']
                );

        $this->db->insert('gc_member_banks', $bank_data);
//end Member bank_data Insert

$increment_code1 = $this->db->count_all_results('gc_member_franchisee_contract')+1;
//start Member contract_data Insert
        $contract_data=array(
                            'Company_id'          =>1,
                            'Branch_id'           =>1,
                            'Membership_ID'       =>$Membership_ID,
                            'Membership_type' => $member_table[0]['Membership_type'],
                            'Contract_ref_no' => "GRNC-CNT-0000".$increment_code1,
                            'Topup_id'        => $member_table[0]['Topup_id'],
                            'Old_payout_ID' => $member_table[0]['Old_payout_ID'],
                            'New_payout_ID' => $member_table[0]['New_payout_ID'],
                            'Payout_status' => $member_table[0]['Payout_status'],
                              );
            if($this->db->insert('gc_member_franchisee_contract', $contract_data)){
                $Contract_ID=$this->db->insert_id();
            }
          
//end Member contract_data Insert


//start Member payment_data Insert

    $this->db->select('*');
    $this->db->where('Temp_ID',$Temp_ID);
    $query=$this->db->get('gc_payment_temp');
    if ($query->num_rows() > 0) { // Row IF Start
        //$temp['value']="success";

        $payments=$query->result_array();

            foreach($payments as $payment)
            {
              $payment_data=array(
               'Company_id'          =>1,
              'Branch_id'           =>1,
              'Membership_ID'       =>$Membership_ID,
              'Contract_ID'       =>$Contract_ID,
              'Payment_type_ID' => $payment['Payment_type_ID'],
              'Bank_ID' => $payment['Bank_ID'],
              'Reference_no' => $payment['Reference_no'],
              'Date' => date('Y-m-d',strtotime($payment['Date'])),
              'Amount' => $payment['Amount'],
              'Remarks' => $payment['Remarks'],
              'Payment_status' => 5);
              $this->db->insert('gc_member_payments', $payment_data);

            }
            
          
        }    
//end Member payment_data Insert    

//start Member agreement_data Insert

        $aggreement_data=array(
                      'Company_id'          =>1,
                      'Branch_id'           =>1,
                      'Membership_ID'       =>$Membership_ID,
                      'Contract_ID'       =>$Contract_ID,
                      'Delivery_mode' => $member_table[0]['Delivery_mode'],
                      'Referal_ID' => $member_table[0]['Referal_ID'],
                      'Address' => $member_table[0]['Address'],
                      'Alter_No' => $member_table[0]['Alter_No']
                      );
        $this->db->insert('gc_member_agreement', $aggreement_data);
//end Member agreement_data Insert 

//start Member Franchisee Member Relationship Insert
        $franchisee_relation['Child_ID']        = $Membership_ID;
        $franchisee_relation['Level_type_ID']   = 1;
        $franchisee_relation['Parent_id']   = $member_data['Reference_ID'];
        // $franchisee_relation['Position']   = 1;
        $this->db->where('Parent_ID',$member_data['Reference_ID']);  
        $member_seq = $this->db->count_all_results('gc_franchisee_member_relation')+1;

        $franchisee_relation['Position']   = $member_seq;
        if($franchisee_relation['Position'] % 2 == 0){ 
            $determin = "2";  
        }else{ 
            $determin = "1"; 
        }
        $franchisee_relation['Determination']   = $determin;
        $franchisee_relation['Company_id']   = 1;
        $franchisee_relation['Branch_id']   = 1;
        $this->db->insert('gc_franchisee_member_relation', $franchisee_relation);
//end Member Franchisee Member Relationship Insert      

//start Member binary Member Relationship Insert
        $binary_relation['Child_ID']        = $Membership_ID;
        $binary_relation['Level_type_ID']   = 2;
        // $binary_relation['Refer_parent_ID']   = 1;
        $binary_relation['Refer_parent_ID']   = $member_data['Reference_ID'];
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
        // $binary_relation['Company_id']   =  $Company_ID;
        // $binary_relation['Branch_id']    =  $Company_ID;
        // $binary_relation['Date']   = ;
        $binary_relation['Company_id']   =  1;
        $binary_relation['Branch_id']    =  1;
        $this->db->insert('gc_binary_member_relation', $binary_relation);
//end Member binary Member Relationship Insert



//start Membership  Update
$member_update['Members_count']   = $member_seq;
$this->db->where('Membership_ID', $member_data['Reference_ID']);
$this->db->update('gc_membership', $member_update);
//endMembership  Update

//start Member binary Member Levels Insert
$ref_ID="";$level_insert_id="";
        for($i=1;$i<=9;$i++){ 
            if($i==1){
            $this->db->select('member.Membership_ID,member.Reference_ID,member.Current_level,contract.Old_payout_ID,contract.New_payout_ID,contract.Payout_status');
            $this->db->from('gc_membership as member');
            $this->db->join('gc_member_franchisee_contract as contract', 'contract.Membership_ID = member.Membership_ID', 'left');
            $this->db->where('member.Membership_ID',$member_data['Reference_ID']);
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
            $levels_master['Company_id']       =  1;
            $levels_master['Branch_id']        =  1;
            $levels_master['Level_ID']         =  1;
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $this->db->insert('gc_member_levels', $levels_master);
            $level_insert_id=$this->db->insert_id();
// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  1;
            $levels_data['Branch_id']        =  1;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
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
            $levels_master['Company_id']       =  1;
            $levels_master['Branch_id']        =  1;
            $levels_master['Level_ID']         =  $level['Level_ID'];
            $levels_master['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_master['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_master['Payout_status']    =  $binary[0]['Payout_status'];
            $this->db->insert('gc_member_levels', $levels_master);
            $level_insert_id=$this->db->insert_id();
// Member Level Master Insert end         
// Member Level Details Insert start 
            $levels_data['Member_level_ID']  =  $level_insert_id;
            $levels_data['Membership_ID']    =  $binary[0]['Membership_ID'];
            $levels_data['Child_ID']         =  $Membership_ID;
            $levels_data['Company_id']       =  1;
            $levels_data['Branch_id']        =  1;
            $levels_data['Level_ID']         =  $level['Level_ID'];
            $levels_data['Position']         =  $binary_relation['Ex_position_type'];
            $levels_data['Old_payout_ID']    =  $binary[0]['Old_payout_ID'];
            $levels_data['New_payout_ID']    =  $binary[0]['New_payout_ID'];
            $levels_data['Payout_status']    =  $binary[0]['Payout_status'];
            $this->db->insert('gc_member_level_details', $levels_data);
// Member Level Details Insert start
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

// Membership Current Level Insert start
            $mem_lvl['Current_level']=$member_level;
            $this->db->where('Membership_ID',$binary[0]['Membership_ID']);
            $this->db->update('gc_membership', $mem_lvl);
// Membership Current Level Insert end
                }

            }
        }
        $temp['value']="Inserted Successfully";

        }  // Row If end
        else{ //Row Else Start
          $temp['Value']='Failed';
        } // Row Else End

  //$this->session->set_userdata($data);
    // $temp['value']="success";
    // $temp['Temp_ID']=$Temp_ID;
}
}
  //echo $temp_ID;



    

  // $final=array(
  // 'New_payout_ID' => $New_payout_ID,
  // 'Payout_status' => $Payout_status,
  // 'Delivery_mode' => $Delivery_mode,
  // 'Delivery_mode' => $Delivery_mode,
  // 'Referal_ID' => $Referal_ID,
  // 'Mobile' => $Mobile,
  // 'Delivery_mode' => $Delivery_mode,
  // 'Courier_name' => $Courier_name,
  // 'Reference_no' => $Reference_no,
  // 'Date' => $Date,
  // 'Address' => $Address,
  // 'Landmark' => $Landmark,
  // 'Mobile' => $Mobile,
  // 'Terms_status' => $Terms_status);


}else{
    $temp['value']="Temp ID Empty";
    $temp['Temp_ID']='';
}

$data['data'] = ['value'              => $temp['value'],
                'Temp_ID'              => $temp['Temp_ID']];
        header('Content-Type: application/json');                   
        echo json_encode($data);

}

function random_strings($length_of_string) { 

    return substr(bin2hex(random_bytes($length_of_string)),0, $length_of_string); 

}

public function upload_api_image($Membership_code,$name,$image_file){
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
    
    $image_base64 = base64_decode($image_file);

    $file = UPLOAD_DIR . $Membership_code.'_'.$name . '.jpg';
    $success=file_put_contents($file, $image_base64);
    if($success){
      return $Membership_code.'_'.$name . '.jpg';
    }else{
      return NULL;
    }
}


public function generatePIN($digits = 5){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
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
         var_dump($config['file_name']);
         
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

    public function check2(){
      $this->db->select('*');
    $this->db->where('Temp_ID',1);
    $query1=$this->db->get('gc_payment_temp');
    if ($query1->num_rows() > 0) {
          $payment['Payment']=$query1->result_array();
          var_dump($payment['Payment']);
        }else{
          $payment['Payment']='';
          var_dump($payment['Payment']);
        }
    }

    function check20(){
      $this->db->select('*');
    $this->db->where('Temp_ID',6);
    $query=$this->db->get('gc_payment_temp');
    if ($query->num_rows() > 0) { // Row IF Start
        //$temp['value']="success";

        $payments=$query->result_array();

            foreach($payments as $payment)
            {
              $payment_data=array(
               'Company_id'          =>1,
              'Branch_id'           =>1,
              'Membership_ID'       =>1,
              'Contract_ID'       =>1,
              'Payment_type_ID' => $payment['Payment_type_ID'],
              'Bank_ID' => $payment['Bank_ID'],
              'Reference_no' => $payment['Reference_no'],
              'Date' => $payment['Date'],
              'Amount' => $payment['Amount'],
              'Remarks' => $payment['Remarks'],
              'Payment_status' => 5);

              //$this->db->insert('gc_member_payments', $payment_data);

            }
            var_dump($payment_data);
          
        }
    }

}
