<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
 
    function index() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 
        if($this->form_validation->run() == FALSE) {
            $this->load->view('vlogin');
            } else {
                redirect(base_url('index.php/home'), 'refresh');
            }      
     }
 
     function check_database($password) {
         $username = $this->input->post('username');
         $result = $this->mlogin->login($username, $password);
         if($result) {
             $sess_array = array();
             foreach($result as $row) {
                 
                 $sess_array = array('idlogin' => $row->idlogin,'fullname' => $row->fullname,'username' => $row->username);
                 
                 $this->session->set_userdata('logged_in', $sess_array);
                 }
          return TRUE;
          } else {
              
              $this->form_validation->set_message('check_database', 'Invalid username or password');
              return FALSE;
          }
      }
}
/* End of file verifylogin.php */
/* Location: ./application/controllers/verifylogin.php */
