<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

    

    public function __construct() {
        parent::__construct();
        $this->load->model('login/Login_model');
        $this->load->model('master/Users_model');
    }
    public function index()
    {
        $this->load->view('login');
          // $template['page']='admin/index';
    //       $this->load->view('template',$template);       
    //       
    }

    public function validate() {

        

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = md5($this->input->post('password'));
        $validate = $this->Login_model->validate($username, $password);
        $data6['username']=$username;
        $data6['password']=$this->input->post('password');
        if (empty($validate)) {

            $temp['value']="1";
            $temp['data'][]=$data6;
            echo json_encode($temp);
            //$this->session->set_flashdata('msg1', 'Username or Password Incorrect!'); 
            
            // $value= getHostByName(getHostName());

            $login_error = array();
            $login_error['Username'] = $username;
            $login_error['Password'] = md5($this->input->post('password'));
            $login_error['Og_password'] = $this->input->post('password');
            $login_error['Result'] = 'Invalid Credentials';
            $login_error['User_ip'] =  $_SERVER['REMOTE_ADDR'];
             $user_agent = $_SERVER['HTTP_USER_AGENT']; 
                if (preg_match('/MSIE/i', $user_agent)) { 
                   $Browser= "Internet Explorer";
                }
                if (preg_match('/Firefox/i', $user_agent)) { 
                   $Browser= "FireFox";
                }
                if (strpos( $user_agent, 'Chrome') !== false)
                {
                    $Browser= "Google Chrome";
                }
                
                if (preg_match('/Opera/i', $user_agent)) { 
                   $Browser= "Opera";
                }
                //$login_error['User_browser']=$Browser;
                 
            //$temp['login_details'][]=$login_error;
            // $temp=$login_arr;
            
            $this->db->insert('gc_login_attempt', $login_error);

           

            
            //redirect('login');
        } else {
            $get_user_details = $this->Login_model->get_user_details($username, $password);
            // $Financial_year=$this->Users_model->get_financial_year();
            // $session_time=$this->Users_model->get_session_time();
            // $financial_yr=$Financial_year->Financial_yr;
            // $Financial_yr_id=$Financial_year->Financial_yr_id;
            // $Financial_month=$Financial_year->Financial_month;

            $UserId = $get_user_details->id;
            $UserCode = $get_user_details->user_id;
            $UserTypeID = $get_user_details->user_type_id;
            $Name = $get_user_details->firstname;
            $Address = $get_user_details->address_line_1;
            $Email = $get_user_details->email_address;
            $Mobile = $get_user_details->mobile_number;
            $CompanyId = $get_user_details->company_id;
            $BranchID = $get_user_details->branch_id;
            // $HubID = $get_user_details->HubID;
            $Username = $get_user_details->username;
            $Password = $get_user_details->password;
            $JoiningDate = $get_user_details->created_date;
            //$UserTypeName = $get_user_details->UserTypeName;
            $Profile = $get_user_details->profile_image;
            $data = array('UserId' => $UserId,'UserCode' => $UserCode, 'UserTypeID' => $UserTypeID, 'UserTypeName' => $Name, 'Name' => $Name, 'Address' => $Address, 'Email' => $Email, 'Mobile' => $Mobile,'BranchID' => $BranchID, 'CompanyId' => $CompanyId,   'UserTypeName' => $Name,  'Profile' => $Profile, 'is_logged_in' => true);
            
            $data['menu_permission']=$this->Users_model->get_user_permissions_by_type_1($UserTypeID);
            $data['section_permission']=$this->Users_model->get_user_permissions_by_type($UserTypeID);

            $date_time = date('Y-m-d h:i:s');
            $login_history = array();
            $login_history['UserId'] = $UserId;
            $login_history['UserCode'] = $UserCode;
            $login_history['UserTypeName'] = $Name;
            $login_history['UserTypeID'] = $UserTypeID;
            $login_history['Company_id'] = $CompanyId;
            $login_history['Branch_id'] = $BranchID;
            $login_history['DateTime'] = $date_time;
            $login_history['DateTime'] = $date_time;
            $login_history['Login'] = 'Login';
            $login_history['LoginHisStatus'] = 1;
            $login_history['User_ip'] =  $_SERVER['REMOTE_ADDR'];
             $user_agent = $_SERVER['HTTP_USER_AGENT']; 
                if (preg_match('/MSIE/i', $user_agent)) { 
                   $Browser= "Internet Explorer";
                }
                if (preg_match('/Firefox/i', $user_agent)) { 
                   $Browser= "FireFox";
                }
                if (strpos( $user_agent, 'Chrome') !== false)
                {
                    $Browser= "Google Chrome";
                }
                
                if (preg_match('/Opera/i', $user_agent)) { 
                   $Browser= "Opera";
                }
                //$login_history['User_browser']=$Browser;
            $this->db->insert('login_history_table', $login_history);

            $login_error = array();
            $login_error['UserId'] = $UserId;
            $login_error['UserTypeId'] = $UserTypeID;
            $login_error['Username'] = $username;
            $login_error['Password'] = md5($this->input->post('password'));
            $login_error['Og_password'] = $this->input->post('password');
            $login_error['Company_id'] = $CompanyId;
            $login_error['Branch_id'] = $BranchID;
            $login_error['Result'] = 'Login Success';
            $login_error['User_ip'] =  $_SERVER['REMOTE_ADDR'];
             $user_agent = $_SERVER['HTTP_USER_AGENT']; 
                if (preg_match('/MSIE/i', $user_agent)) { 
                   $Browser= "Internet Explorer";
                }
                if (preg_match('/Firefox/i', $user_agent)) { 
                   $Browser= "FireFox";
                }
                if (strpos( $user_agent, 'Chrome') !== false)
                {
                    $Browser= "Google Chrome";
                }
                
                if (preg_match('/Opera/i', $user_agent)) { 
                   $Browser= "Opera";
                }
                //$login_error['User_browser']=$Browser;

            $this->db->insert('gc_login_attempt', $login_error);

            $this->session->set_userdata($data);
            $this->session->set_flashdata('login_success', 'Success message.');

            // $temp['value']="dashboard";
            $temp['value']="dashboard";
            $temp['data'][]=$data6;
            // $login_arr['login_details'][]=$login_error;
            //$temp['login_details'][]=$login_error;
            // $temp=$login_arr;
            echo json_encode($temp);
            //redirect('dashboard/dashboard');
        }
    }
    public function logout() {
        $UserCode = $this->session->userdata('UserCode');
        $UserId = $this->session->userdata('UserId');
        $UserTypeID = $this->session->userdata('UserTypeID');
        $UserTypeName = $this->session->userdata('UserTypeName');
        $CompanyId = $this->session->userdata('CompanyId');
        $BranchID = $this->session->userdata('BranchID');
        $date_time = date('Y-m-d h:i:s');
        $login_history = array();
        $login_history['UserId'] = $UserId;
        $login_history['UserCode'] = $UserCode;
        $login_history['UserTypeName'] = $UserTypeName;
        $login_history['UserTypeID'] = $UserTypeID;
        $login_history['Company_id'] = $CompanyId;
        $login_history['Branch_id'] = $BranchID;
        $login_history['DateTime'] = $date_time;
        $login_history['Logout'] = 'Logout';
        $login_history['LoginHisStatus'] = 2;
         $login_history['User_ip'] =  $_SERVER['REMOTE_ADDR'];
             $user_agent = $_SERVER['HTTP_USER_AGENT']; 
                if (preg_match('/MSIE/i', $user_agent)) { 
                   $Browser= "Internet Explorer";
                }
                if (preg_match('/Firefox/i', $user_agent)) { 
                   $Browser= "FireFox";
                }
                if (strpos( $user_agent, 'Chrome') !== false)
                {
                    $Browser= "Google Chrome";
                }
                
                if (preg_match('/Opera/i', $user_agent)) { 
                   $Browser= "Opera";
                }
                $login_history['User_browser']=$Browser;
        // var_dump($login_history);
        // die();
        $this->db->insert('login_history_table', $login_history);
        $logout = array('UserCode', 'UserTypeID', 'Name', 'Address', 'Email', 'Mobile', 'UserTypeName', 'is_logged_in');
        $this->session->unset_userdata($logout);
        $this->session->set_flashdata('login_success', 'You Signed Out Now!');
        redirect('login');
        session_destroy();
    }
    public function change_password() {
        $value="1";
            // echo json_encode($value);
            // exit();
$UserID = $this->session->userdata('UserId');

        $this->db->select("password");
        $this->db->from("gc_users");
        $this->db->where("id=$UserID");
        $result = $this->db->get()->row();
        $oldpassword = $result->password;
        $pwsd = $this->input->post('n_password');
        $get_password = md5($this->input->post('password'));
        if ($oldpassword !== $get_password) {
            // $this->session->set_flashdata('message', array('message' => 'Invalid Old Password', 'title' => 'Warning !', 'class' => 'warning'));
            $value="1";
            echo json_encode($value);

           
        } else {
             
                $UserID = $this->session->userdata('UserId');
                $new_password = md5($this->input->post('n_password'));
                $atrr = array('password' => $new_password,);
                $this->db->where('id', $UserID);
                $this->db->update('gc_users', $atrr);
                //$this->session->set_flashdata('message', array('message' => 'Password updated successfully', 'title' => 'Success !', 'class' => 'success'));
                
                session_destroy();
                $value=base_url()."login";
                echo json_encode($value);
            }
        
    }

    public function check(){

// echo $user_agent = $_SERVER['REMOTE_ADDR'];
 $browserAgent = $_SERVER['HTTP_USER_AGENT'];       

if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    echo $ip;

 // $user_agent = $_SERVER['HTTP_USER_AGENT']; 
 //    if (preg_match('/MSIE/i', $user_agent)) { 
 //       echo "Internet Explorer";
 //    }
 //    if (preg_match('/Firefox/i', $user_agent)) { 
 //       echo "FireFox";
 //    }
 //    if (strpos( $user_agent, 'Chrome') !== false)
 //    {
 //        echo "Google Chrome";
 //    }
 //    if (strpos( $user_agent, 'Safari') !== false)
 //    {
 //       echo "Safari";
 //    }
 //    if (preg_match('/Opera/i', $user_agent)) { 
 //       echo "Opera";
 //    }


    }
}
