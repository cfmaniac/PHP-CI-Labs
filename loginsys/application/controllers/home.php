<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function index() {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['name'] = $session_data['fullname'];
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['idlogin'];
            $this->load->view('home', $data);
        } else {
            redirect('welcome', 'refresh');
        }
    }
 
    function logout() {
         $this->session->unset_userdata('logged_in');
         $this->session->sess_destroy();
         redirect(base_url('index.php/welcome'), 'refresh');
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
