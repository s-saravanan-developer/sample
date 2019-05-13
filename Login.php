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
    }

    public function validate() {

    // $username = $this->security->xss_clean($this->input->post('username'));
    $password = md5($this->input->post('password'));
    $from = $this->input->post('from');

    $validate = $this->Login_model->validate($password,$from);
    $data_failed['password']=$this->input->post('password');

        if (empty($validate)) {
        	$temp['status']       =  "failure";
            // $temp['users']['value'][]        =  "1";
            // $temp['users']['text'][]         =  "failed";
            // $temp['users']['user_id'][]      =  "";
            // $temp['users']['name'][]      =  "";
            // $temp['users']['mobile'][]      =  "";
            $temp['users'][]=array('value'         => "1",
            					'text'         =>  "failed",
								'user_id'      =>  "",
								'name'    	  =>  "",
								'mobile'       => "");
            header('Content-Type: application/json');
            echo json_encode($temp);
        
        } else {

            $session_data   =                                            
            $this->Login_model->session($password,$from);

            $id         =   $session_data['user_id'];
            $name       =   $session_data['firstname'];
            $address    =   $session_data['address'];
            $email      =   $session_data['email'];
            $mobile     =   $session_data['mobile'];
            $profile    =   $session_data['profile'];

            $data_session = array(
                          'dsp_id'      => $id,
                          'dsp_name'    => $name,
                          'dsp_address' => $address,
                          'dsp_email'   => $email,
                          'dsp_mobile'  => $mobile,
                          'dsp_profile' => $profile,
                          'dsp_is_logged_in' => true);
            
            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('login_success');

            $temp['status']       =  "success";
            $temp['users'][]=array(
            					'value'         =>  "dashboard",
            					'text'         =>  "success",
								'user_id'      =>  $id,
								'name'    	  =>  $name,
								'mobile'       =>  $mobile);
            // ['value']        =  "dashboard";
            // $temp['users']['text']         =  "success";
            // $temp['users']['user_id']      =  $id;
            // $temp['users']['name']    	  =  $name;
            // $temp['users']['mobile']       =  $mobile;
            header('Content-Type: application/json');
            echo json_encode($temp);
        }
    }

    public function logout() {
    
        session_destroy();
        redirect('login');
    }

    public function check(){

    $browser = $_SERVER['HTTP_USER_AGENT'];       

        if (!empty($_SERVER['HTTP_CLIENT_IP']))  

            {   $ip=$_SERVER['HTTP_CLIENT_IP']; }

        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   

            {   $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; }

        else
            {   $ip=$_SERVER['REMOTE_ADDR']; }

    echo $ip;
    }


    public function change_password() {

        $id = $this->session->userdata('dsp_id');

        $this->db->select("password");
        $this->db->from("dsp_users");
        $this->db->where("user_id=$id");
        $result = $this->db->get()->row();
        $oldpassword = $result->password;
        $pwsd = $this->input->post('n_password');
        $get_password = md5($this->input->post('password'));

        if ($oldpassword !== $get_password) {

            $value="1";
            echo json_encode($value);

        } else {
            
            $id = $this->session->userdata('dsp_id');
            $pwd = md5($this->input->post('n_password'));
            $og_pwd = $this->input->post('n_password');

            $user_update = array('password' => $pwd,
                                 'og_password' => $og_pwd,
                                );

            $this->db->where('user_id', $id);
            $this->db->update('dsp_users', $user_update);

            $value=base_url()."dashboard";
            echo json_encode($value);
        }
        
    }

}
