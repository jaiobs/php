<?php

/* * ***
 *
 * Description of Auth model
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {
    // Declaration of a variables
    private $_email;
    private $_password;
 
    //Declaration of a methods
    public function setUserName($userName) {
        $this->_userName = $userName;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }
  
    public function setEmail($email) {
        $this->_email = $email;
    }
 
          
    // login method and password verify
    function login() {
        $this->db->select('id as user_id, email, password');
        $this->db->from('user_info');
        $this->db->where('email', $this->_email);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                if ($this->verifyHash($this->_password, $row->password) == TRUE) {
                    return $result;
                } else {
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }
    }
     
    // password verify
    public function verifyHash($password, $vpassword) {
        if (password_verify($password, $vpassword)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}

?>