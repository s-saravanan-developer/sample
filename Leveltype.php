<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Leveltype extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('is_logged_in') == '') {
            
            redirect('login');
            session_destroy();

        }
        $this->load->model('master/Master_model');
    }

	public function index()
	{
    	$template['page']='master/leveltype/viewleveltype';
      $template['payout'] =  $this->Master_model->getall_leveltype();
      $template['weeks']  =  $this->Master_model->get_weeks();
      $this->load->view('template',$template);
	}

  public function invest_type()
  {
      $template['page']='master/leveltype/viewinvesttype';
      $template['leveltype'] =  $this->Master_model->getall_lts();
      $template['invest']  =  $this->Master_model->get_allinvest();
      $this->load->view('template',$template);
  }

    public function level()
    {
        $template['page']='master/leveltype/viewlevel';
        $template['leveltype'] =  $this->Master_model->getall_level();
        $template['invest'] =  $this->Master_model->get_allinvest();
        $template['payout'] =  $this->Master_model->getall_leveltype();
        $template['level'] =  $this->Master_model->getallpayout();
        $this->load->view('template',$template);
    }

    public function add_leveltype()
    {
        extract($_POST);

        $Week = implode(',',$Weeks);
        $data = array('Level_type' => $Level_type,
                      'Alias_name' => $Alias_name,
                      'Weeks' => $Week,
                      'Description' => $Description,  
                      'Status' => $Status
                     );
        $this->db->insert('gc_leveltype',$data);
        $this->session->set_flashdata('country_success', 'Added');
        redirect('master/Leveltype');
    }

    public function add_investtype()
    {
        extract($_POST);

        $this->db->insert('gc_invest_type',$invest);
        $this->session->set_flashdata('country_success', 'Added');
        redirect('master/Leveltype/invest_type');
    }

    public function edit_investtype()
    {
        $id = $this->input->post("ID");  
        $invest_data = $this->input->post("invest");  

        $this->db->where('ID',$id);
        $this->db->update('gc_invest_type',$invest_data);
        $this->session->set_flashdata('country_success', 'Updated');
        redirect('master/Leveltype/invest_type');
    }

    public function delete_investtype($id)
    {
        $invest_data = array('Status' => 3);

        $this->db->where('ID',$id);
        $this->db->update('gc_invest_type',$invest_data);
        $this->session->set_flashdata('duplicate', 'Deleted');
        redirect('master/Leveltype/invest_type');
    }

    public function get_leveltype_invest() {

    $id = $this->input->post('name');
    $data = $this->Master_model->get_all_investbyleveltype($id);
      
    if(isset($data)){
        echo '<option value="">Select Invest Type</option>';      
    foreach ($data as $value)  {
        echo '<option value="'.$value['ID'].'">'.$value['Invest_name'].'</option>'; 
        }}else{
            echo '<option value="">Select Invest Type</option>';            
      }
    }


    public function add_level()
    {
        extract($_POST);

        $data = array('Level_type_id' => $Level_type,
                      'Alias_name' => $Alias_name,
                      'Level' => $Level,
                      'Invest_type_id' => $Invest_type,
                      'Return' => $Return,
                      'Payout_type' => $Payout_type,
                      'Description' => $Description,  
                      'Status' => $Status
                     );
      
        $this->db->insert('gc_level',$data);
        $this->session->set_flashdata('country_success', 'Added');
        redirect('master/Leveltype/level');
    }

    public function edit_leveltype()
    {
        extract($_POST);
        $Week = implode(',',$Weeks);

        $data = array('Level_type' => $Level_type,
                      'Alias_name' => $Alias_name,
                      'Weeks' => $Week,
                      'Description' => $Description,  
                      'Status' => $Status);
        
        
        $this->db->where('ID',$ID);
        $this->db->update('gc_leveltype',$data);
        $this->session->set_flashdata('country_success', 'Updated');
        redirect('master/Leveltype');
    }

    public function edit_level()
    {
        extract($_POST);

        $data = array(
                      'Alias_name' => $Alias_name,
                      'Return' => $Return,
                      'Payout_type' => $Payout_type,
                      // 'Invest_type_id' => $Invest_type_id,
                      'Level' => $Level,
                      'Description' => $Description,  
                      'Status' => $Status
                     );
        $this->db->where('ID',$ID);
        $this->db->update('gc_level',$data);
        $this->session->set_flashdata('country_success', 'Updated');
        redirect('master/Leveltype/level');
    }

    public function delete_leveltype($id)
    {

        $data = array('Status' => 3);
        
        $this->db->where('ID',$id);
        $this->db->update('gc_leveltype',$data);

        $this->db->where('Member_level',$id);
        $this->db->delete('gc_tree_color_setting');

        $this->session->set_flashdata('duplicate', 'Deleted Succesfully');
        redirect('master/Leveltype');
    }

    public function delete_level($id)
    {

        $data = array('Status' => 3);
        
        $this->db->where('ID',$id);
        $this->db->update('gc_level',$data);
        $this->session->set_flashdata('duplicate', 'Deleted Succesfully');
        redirect('master/Leveltype/level');
    }

   public function get_payout_level() 
   {

      $id = $this->input->post('name');
      $data = $this->Master_model->get_all_payouttyp($id);
        var_dump($data);
      if(isset($data)){
          echo '<option value="">Select Payout</option>';      
      foreach ($data as $value)  {

          echo '<option value="'.$value['id'].'">'.$value['payout_type'].'</option>'; 

          }}else{

              echo '<option value="">Select Payout</option>';            
        } return $data[0]['Level_type_id'];
    }

 public function get_leveltype_level() 
   {

      $id = $this->input->post('name');
      $data = $this->Master_model->get_leveltype_level($id);
        
      if(isset($data)){
          echo '<option value="">Select Level</option>';      
      foreach ($data as $value)  {

          echo '<option value="'.$value['ID'].'">'.$value['Level'].'</option>'; 

          }}else{

              echo '<option value="">Select Level</option>';            
        }
    }
}
