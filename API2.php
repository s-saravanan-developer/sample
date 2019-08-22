<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('api/API_model');
		$this->load->model('master/Users_model');
		$this->load->library('ci_qr_code');
        $this->config->load('qr_code');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function homepage(){
		$user_id=$this->input->post('user_id');
		$temp['status']       =  "success";
		$total_reg=$this->API_model->total_reg($user_id);
		$today_reg=$this->API_model->get_today_reg($user_id);
		$total_amt=$this->API_model->get_total_amt($user_id);
		$temp['data']=['total_reg'            => $total_reg,
					   'today_reg'            => $today_reg,
					   'total_amt'            => $total_amt,
					   'user_id'              => $user_id];

		 header('Content-Type: application/json');
         echo json_encode($temp);

	}

public function check_registered_url($code='CB051902000003'){  
  $url = 'https://vokkaligar.in/API/check_registered';
  $master_data=array('code'=>'CB071904017227','platform'=>'web');
  
      $ch = curl_init($url);
      # Form data string
      $postString1 = http_build_query($master_data, '', '&');

  
      # Setting our options
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postString1);  
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      # Get the response
      $response = curl_exec($ch);
      curl_close($ch);
     
      print_r($response);
      }


	public function check_registered(){
	   
	    $code=$this->input->post('code');
		$platform=$this->input->post('platform');

		if (!empty($code)) {

			if ($platform!='web' || empty($platform)) {
			$data=$this->db->where(array('member.membership_code'=>$code))->join('dsp_circle as circle', 'circle.circle_id = member.circle_id', 'left')->join('dsp_branch as branch', 'branch.branch_id = member.branch_id', 'left')->join('dsp_kulam as kulam', 'kulam.kulam_id = member.kulam', 'left')->get('dsp_membership as member')->result_array();

				if (empty($data[0]['gender'])) { $gender = 0; }elseif($data[0]['gender']=='Male'){ $gender = 1; }else{ $gender = 2; }

				if (!empty($data)) {

					$response['status_code']	=	200;
					$response['status']			=	'true';
					$response['message']		=	'Success';
					$response['membership_id']	=	$data[0]['membership_id'];					
					$response['membership_name']=	$data[0]['membership_name'];
					$response['membership_code']=	$data[0]['membership_code'];
					$response['mobile']			=	$data[0]['mobile'];
					$response['gender']			=	$gender;
					$response['kulam']			=	$data[0]['kulam_name'];
					$response['kulam_id']		=	$data[0]['kulam'];
					$response['branch']			=	$data[0]['branch_name'];
					$response['branch_id']		=	$data[0]['branch_id'];
					$response['circle']			=	$data[0]['circle_name'];
					$response['circle_id']		=	$data[0]['circle_id'];

				}else{	

					$response['status_code']	=	409;
					$response['status']			=	'False';
					$response['message']		=	'User does not exist';

				}
				
				 header('Content-Type: application/json');
			     echo json_encode($response);

			}else{
			    
				 $data=$this->db->where(array('member.membership_code'=>$code))->join('dsp_circle as circle', 'circle.circle_id = member.circle_id', 'left')->join('dsp_branch as branch', 'branch.branch_id = member.branch_id', 'left')->join('dsp_kulam as kulam', 'kulam.kulam_id = member.kulam', 'left')->get('dsp_membership as member')->result_array();

				if (empty($data[0]['gender'])) { $gender = 0; }elseif($data[0]['gender']=='Male'){ $gender = 1; }else{ $gender = 2; }

				if (!empty($data)) {
				    // var_dump($data);die();
					$response['status_code']	=	200;
					$response['status']			=	'true';
					$response['message']		=	'Success';
					$response['membership_id']	=	$data[0]['membership_id'];					
					$response['membership_name']=	$data[0]['membership_name'];
					$response['membership_code']=	$data[0]['membership_code'];
					$response['mobile']			=	$data[0]['mobile'];
					$response['gender']			=	$gender;
					$response['kulam']			=	$data[0]['kulam_name'];
					$response['kulam_id']		=	$data[0]['kulam'];
					$response['branch']			=	$data[0]['branch_name'];
					$response['branch_id']		=	$data[0]['branch_id'];
					$response['circle']			=	$data[0]['circle_name'];
					$response['circle_id']		=	$data[0]['circle_id'];
				}else{
					$response['status_code']=409;
					$response['status']='Invalid Credentials';

				}
				
				 //echo json_encode($response);
				 print_r($response);
			}
	}

	}


	public function add_new(){
		$temp['status']       =  "success";
		$kulam=$this->API_model->get_kulam();
		// $occupation=$this->API_model->get_occupation();
		$city=$this->API_model->get_city();
		$price=$this->API_model->get_price();
		if(!empty($kulam)){
			$kulam=$kulam;
		}else{
			$kulam=[];
		}
		// if(!empty($occupation)){
		// 	$occupation=$occupation;
		// }else{
		// 	$occupation=[];
		// }
		if(!empty($city)){
			$city=$city;
		}else{
			$city=[];
		}
		if(!empty($occupation)){
			$occupation=$occupation;
		}else{
			$occupation=[];
		}
		if(!empty($price)){
			$price=$price;
		}else{
			$price=[];
		}

		$temp['data']=['kulam'                => $kulam,
					   // 'occupation'           => $occupation_otherson,
					   'city'                 => $city,
					   'price'                => $price];

		 header('Content-Type: application/json');
         echo json_encode($temp);

	}

	public function education(){

		$mode=$this->input->post('eq_mode');
		$education=$this->API_model->get_education($mode);
		if(!empty($education)){
			$education=$education;
		}else{
			$education=[];
		}

		$temp['data']=['education'  => $education];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}

	public function occupation(){

		$mode=$this->input->post('occ_mode');
		$occupation=$this->API_model->get_occupation($mode);
		// var_dump($occupation);die();
		if(!empty($occupation)){
			$occupation=$occupation;
		}else{
			$occupation=[];
		}

		$temp['data']=['occupation'  => $occupation];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}

	public function circle(){

		$city=$this->input->post('city');
		$circle=$this->API_model->get_circle($city);
		if(!empty($circle)){
			$circle=$circle;
		}else{
			$circle=[];
		}
		$temp['data']=['circle'                => $circle];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}	

	public function branch(){

		$circle=$this->input->post('circle');
		$branch=$this->API_model->get_branch($circle);
		if(!empty($branch)){
			$branch=$branch;
		}else{
			$branch=[];
		}
		$temp['data']=['branch'                => $branch];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}

	public function mobile(){

		$mobile=$this->input->post('mobile');
		$mobile=$this->API_model->get_mobile($mobile);

		if(!empty($mobile)){
			$temp['status']='failure';
			$text='Mobile Already Exist';
		}else{
			$temp['status']='success';
			$text='Mobile does not Exist';
		}
		
		$temp['response']=['text'                => $text];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}	

public function email(){ 

		$email=$this->input->post('email');
		$email=$this->API_model->get_email($email);

		if(!empty($email)){
			$temp['status']='failure';
			$text='Email Already Exist';
		}else{
			$temp['status']='success';
			$text='Email does not Exist';
		}
		
		$temp['response']=['text'                => $text];

		 header('Content-Type: application/json');
         echo json_encode($temp);
	}

function check1011(){
echo $city_code=$this->db->get_where('dsp_city',array('city_id' => 1))->row()->city_code;
echo $circle_code=$this->db->get_where('dsp_circle',array('circle_id' => 1))->row()->circle_code;
echo $this->db->where('city',1)->count_all_results('dsp_membership')+1;
}

public function insert(){
	extract($_POST);
	$city_code=$this->db->get_where('dsp_city',array('city_id' => $city))->row()->city_code;
	$circle_code=$this->db->get_where('dsp_circle',array('circle_id' => $circle))->row()->circle_code;

	$increment=$this->db->where(array('city'=>$city,'status'=>1))->count_all_results('dsp_membership')+1;
	
	$increment1=(substr($this->db->select('membership_code')->where(array('city'=>$city,'status' =>1))->order_by('membership_id','desc')->limit(1)->get('dsp_membership')->row('membership_code'),8))+1;

	// $membership_code='DSP-MEM-00000'.$increment;
	// sprintf("%'.05d", $increment1);
	$membership_code=$city_code.date('m').date('y').$circle_code.sprintf("%'.06d", $increment1);
	$profile='Profile';
	if(isset($profile_image)){
		$profile_name=$this->upload_api_image($membership_code,$profile,$profile_image);
		$profile_path="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$membership_code.'/'.$profile_name;
	}else{
		$profile_name='profile.jpg';
		$profile_path="http://".$_SERVER['HTTP_HOST'].base_url().'attachments/Members/'.$profile_name;
	}
$dob=str_replace('/', '-', $dob);
$dob=date('Y-m-d',strtotime($dob));
// $from = new DateTime('1994-06-22');
// $to   = new DateTime('today');
// $age=$dob->diff($to)->y;
$age=date_diff(date_create($dob), date_create('today'))->y;
	
$QR_name='QR_'.$membership_code.'.png';

$QR_path=$this->print_qr($name,$membership_code,$dob,$address_1,$address_2,$pincode,$bld_grp,$mobile_no,$email,$aadhaar_no,$edu_qual,$occ,$age);


		if(!empty($eq_mode)){
			$eq_mode=$eq_mode;
		}else{
			$eq_mode='';
		}

		if(!empty($edu_qual)){
			$edu_qual=$edu_qual;
		}else{
			$edu_qual='';
		}

		if(!empty($eq_others)){
			$eq_others=$eq_others;
		}else{
			$eq_others='';
		}

		if(!empty($occ_mode)){
			$occ_mode=$occ_mode;
		}else{
			$occ_mode='';
		}

		if(!empty($occ)){
			$occ=$occ;
		}else{
			$occ='';
		}

		if(!empty($occ_others)){
			$occ_others=$occ_others;
		}else{
			$occ_others='';
		}

	$membership=array('membership_code'         => $membership_code,
					  'membership_name'		    => $name,
					  'father_name'		        => $father_name,
					  'kulam'		            => $kulam,
					  'dob'		                => $dob,
					  'gender'		            => $gender,
					  'prefix'		            => $stn_prefix,
					  'blood_grp'		        => $bld_grp,
					  'age'		                => $age,
					  'address_1'		        => $address_1,
					  'address_2'		        => $address_2,
					  'pincode'		            => $pincode,
					  'city'		            => $city,
					  'circle_ID'		        => $circle,
					  'branch_ID'		        => $branch,
					  'profile'                 => $profile_name,
					  'file_path'               => $profile_path,
					  'qr_name'                 => $QR_name,
					  'qr_path'                 => $QR_path,
					  'reg_date'		        => date('Y-m-d'),
					  'mobile'		            => base64_decode($mobile_no),
					  'aadhar'		            => base64_decode($aadhaar_no),
					  'email'		            => $email,
					  'eq_mode'		            => $eq_mode,
					  'education'		        => $edu_qual,
					  'eq_others'		        => $eq_others,
					  'occ_mode'		        => $occ_mode,
					  'occupation'		        => $occ,
					  'occupation_others'		=> $occ_others,
					  'price'		            => $id_card_charges,
					  'created_by'		        => $user_id);
	
	if($this->db->insert('dsp_membership',$membership)){
		$mobile=base64_decode($mobile_no);
		$sms_content  ='Hi '.$name.',';
		$sms_content .= "\n";
		$sms_content .='Your ID Card Charge Rs.'.$id_card_charges.' is Received,Your Membership Code is '.$membership_code.',Membership Card will be delivered shortly.';

		// echo $sms_content;die();
		// $sms_url='http://bulksmscoimbatore.co.in/sendsms?uname=mequals&pwd=mequals@123&senderid=BUGFIX&to='.$mobile.'&msg='.urlencode($sms_content).'&route=SID';
		// $url='http://mysms.mequals.me/api/sendhttp.php?authkey=ZTFkYzA3NDY4ZTQ&mobiles=9842157682&message=Hi saravanan&sender=BILLER&type=1&route=2'

		$sms_url='http://mysms.mequals.me/api/sendhttp.php?authkey=NGU1ZDU0MTdlNDc&mobiles='.$mobile.'&message='.urlencode($sms_content).'&sender=VOSCAT&type=1&route=2';

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
                // var_dump($curl_data);die();

		$text='Success';
	}else{
		$text='Failure';
	}

$temp['data']=['status'                => $text];

		 header('Content-Type: application/json');
         echo json_encode($temp);
//var_dump($membership);die();

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
    // $image_file = str_replace('data:image/png;base64,', '', $image_file);
	// $image_file = str_replace(' ', '+', $image_file);
    $image_base64 = base64_decode($image_file);

    $file = UPLOAD_DIR . $Membership_code.'_'.$name . '.jpg';
    $success=file_put_contents($file, $image_base64);
    if($success){
      return $Membership_code.'_'.$name . '.jpg';
    }else{
      return NULL;
    }
}

    function print_qr($name,$Membership_code,$dob,$address_1,$address_2,$pincode,$bld_grp,$mobile_no,$email,$aadhaar_no,$edu_qual,$occ,$age)
    {
		$qr_code_config = array();
        $qr_code_config['cacheable'] = $this->config->item('cacheable');
        $qr_code_config['cachedir'] = $this->config->item('cachedir');
        $qr_code_config['imagedir'] = $this->config->item('imagedir');
        $qr_code_config['errorlog'] = $this->config->item('errorlog');
        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
        $qr_code_config['quality'] = $this->config->item('quality');
        $qr_code_config['size'] = $this->config->item('size');
        $qr_code_config['black'] = $this->config->item('black');
        $qr_code_config['white'] = $this->config->item('white');
        $this->ci_qr_code->initialize($qr_code_config);

		$codeContents = "Name :";
        $codeContents .= $name;
        $codeContents .= "\n";
        $codeContents .= "ID :";
        $codeContents .= $Membership_code;
        $codeContents .= "\n";
        $codeContents .= "Mobile :";
        $codeContents .= base64_decode($mobile_no);
        $codeContents .= "\n";
        $codeContents .= "Email :";
        $codeContents .= $email;
        $codeContents .= "\n";
        $codeContents .= "Aadhar No :";
        $codeContents .= base64_decode($aadhaar_no);
        $codeContents .= "\n";
        $codeContents .= "Age :";
        $codeContents .= $age;
        $codeContents .= "\n";
        $codeContents .= "Blood Group :";
        $codeContents .= $bld_grp;
        $codeContents .= "\n";
        $codeContents .= "Address :";
        $codeContents .= $address_1.','.$address_2.'-'.$pincode;

        $params['data'] = $codeContents;
        $params['level'] = 'L';
        $params['size'] = 2;

        // $Membership_code='sarath';
        $image_name = "QR_".$Membership_code.".png";
        if (!is_dir('attachments/QR_codes/'.$Membership_code))
                  {
                      mkdir('attachments/QR_codes/'.$Membership_code, 0777, true);
                  }
                  $dir_exist = true; // flag for checking the directory exist or not
                  if (!is_dir('attachments/QR_codes/'.$Membership_code))
                  {
                      mkdir('attachments/QR_codes/'.$Membership_code, 0777, true);
                      $dir_exist = false; // dir not exist
                  }
// echo $params['savename']=UPLOAD_DIR . $Membership_code.'_'.$image_name;die();
        $params['savename'] = FCPATH . 'attachments/QR_codes/' .$Membership_code.'/'.$image_name;
        if($this->ci_qr_code->generate($params)){
           return "http://".$_SERVER['HTTP_HOST'].base_url().'attachments/QR_codes/'.$Membership_code.'/'.$image_name;
        }else{
            return '';
        }
 }


     function print_qr_code()
    {
    	extract($_POST);
		$qr_code_config = array();
        $qr_code_config['cacheable'] = $this->config->item('cacheable');
        $qr_code_config['cachedir'] = $this->config->item('cachedir');
        $qr_code_config['imagedir'] = $this->config->item('imagedir');
        $qr_code_config['errorlog'] = $this->config->item('errorlog');
        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
        $qr_code_config['quality'] = $this->config->item('quality');
        $qr_code_config['size'] = $this->config->item('size');
        $qr_code_config['black'] = $this->config->item('black');
        $qr_code_config['white'] = $this->config->item('white');
        $this->ci_qr_code->initialize($qr_code_config);

		$codeContents = "Name :";
        $codeContents .= $name;
        $codeContents .= "\n";
        $codeContents .= "EMP ID :";
        $codeContents .= $Emp_id;
        $codeContents .= "\n";
        $codeContents .= "Mobile :";
        $codeContents .= $mobile_no;
        $codeContents .= "\n";
        $codeContents .= "Email :";
        $codeContents .= $email;
        $codeContents .= "\n";
        $codeContents .= "D.O.B :";
        $codeContents .= $Dob;
        $codeContents .= "\n";
        $codeContents .= "Blood Group :";
        $codeContents .= $bld_grp;
        $codeContents .= "\n";
        $codeContents .= "Address :";
        $codeContents .= $address1.','.$address2.'-'.$pincode;
        $codeContents .= "\n";
        $codeContents .= "Company :";
        $codeContents .= $Company;

        $params['data'] = $codeContents;
        $params['level'] = 'L';
        $params['size'] = 2;

        // $Membership_code='sarath';
        $image_name = $name."_".$Emp_id.".png";
        // if (!is_dir('attachments/QR_codes/'.$Emp_id))
        //           {
        //               mkdir('attachments/QR_codes/'.$Emp_id, 0777, true);
        //           }
        //           $dir_exist = true; // flag for checking the directory exist or not
        //           if (!is_dir('attachments/QR_codes/'.$Emp_id))
        //           {
        //               mkdir('attachments/QR_codes/'.$Emp_id, 0777, true);
        //               $dir_exist = false; // dir not exist
        //           }
// echo $params['savename']=UPLOAD_DIR . $Emp_id.'_'.$image_name;die();
        $params['savename'] = FCPATH . 'attachments/QR_codes/QR/'.$image_name;
        if($this->ci_qr_code->generate($params)){
           return "http://".$_SERVER['HTTP_HOST'].base_url().'attachments/QR_codes/'.$Emp_id.'/'.$image_name;
        }else{
            return '';
        }
 }
 
  function check222(){
 	echo $incre123=(substr($this->db->select('membership_code')->where(array('city'=>2,'status' =>1))->order_by('membership_id','desc')->limit(1)->get('dsp_membership')->row('membership_code'),8))+1;
 }
 

}
