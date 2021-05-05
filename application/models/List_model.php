<?php

/* * ***
 *
 * Description of Auth model
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_model extends CI_Model {

    // fetch records
    public function fetch_records() {
        $this->db->select('ID, NAME, magento_id, isDeleted');
        $this->db->from('fcstmr_type');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

    // add data
    public function addData($postData){
        $id = trim($postData['ID']);
        $name = trim($postData['name']);
        $mgID = trim($postData['magento_id']);
        if($name !='' && $mgID !='' && $id != '') {     
            $checkId = $this->getDataById($id);
            if ($checkId->num_rows() == 1) {
                $this->session->set_flashdata('invalid', "ID exists already");
                return FALSE;
            } else {
                $value=array('NAME'=>$name,'magento_id'=>$mgID, 'ID'=>$id);
                $result = $this->db->insert('fcstmr_type',$value);
                $this->session->set_flashdata('true', "Added successfully");
                return $result;
            }                   
        } else {
            $this->session->set_flashdata('invalid', "Please Enter valid data");
            return FALSE;
        }
    }

    // get data by id
    public function getDataById($id){
        $this->db->select('ID');
        $this->db->from('fcstmr_type');
        $this->db->where('ID', $id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query;
    }

    // Update data by id
    public function updateData($postData,$id){
        $name = trim($postData['name']);
        $mgID = trim($postData['magento_id']);
        if($name !='' && $mgID !=''  ){
            $value=array('NAME'=>$name,'magento_id'=>$mgID);
            $this->db->where('id',$id);
            $this->db->update('fcstmr_type',$value);
            return;
        }
    }

    // delete data by id
    public function deleteData($id){
        $value=array('isDeleted'=> 1);
        $this->db->where('id',$id);
        $this->db->update('fcstmr_type',$value);
        return;
    }

}

?>