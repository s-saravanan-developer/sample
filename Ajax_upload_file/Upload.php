<?php
// Excel Upload File
    public function Upload_excel($directory)
    {
                 $config['upload_path']          = './attachments/'.$directory.'/';
                 $config['allowed_types']        = 'xlsx|xls|pdf|docx';
                 $config['max_size']             = 10000; 
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('upload_files'))
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