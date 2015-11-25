<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Mlogin extends CI_Model {
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    function login($username, $password) {
        
        $this->db->select('idlogin,fullname, username, password');
        $this->db->from('amdep_login');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
         
        
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
        }
    }
}
  
/* End of file modelog.php */
/* Location: ./application/models/modelog.php */
