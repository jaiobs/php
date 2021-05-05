<?php

/* * ***
 *
 * Description of Auth Controller
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TablesList extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('List_model', 'list');
    }   

    // add data
    public function addData() {
        // Check form  validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ID', 'ID','trim|required|alpha');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('magento_id', 'Magento ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->displaydata();
        } else {
            $postData = array();
            $postData['ID'] = $this->input->post('ID');
            $postData['name'] = $this->input->post('name');
            $postData['magento_id'] = $this->input->post('magento_id');
            $this->list->addData($postData);
            $this->session->set_flashdata('true', "Added successfully");
            $this->displaydata();
        }
    }

    // Update data by id
    public function updateData() {
        $postData = array();
        $id = $this->input->post('id');
        $postData['name'] = $this->input->post('name');
        $postData['magento_id'] = $this->input->post('magento_id');
        $this->list->updateData($postData,$id);
        $this->session->set_flashdata('true', "Updated successfully");
        $this->displaydata();
    }

    // delete data by id
    public function deleteData() {
        $postData = array();
        $id = $this->input->post('id');
        $this->list->deleteData($id);
        $this->session->set_flashdata('true', "Deleted successfully");
        $this->displaydata();
    }

    //display list
    public function displaydata() {
        $result = array();
        $result['data']=$this->list->fetch_records();
        $result['metaDescription'] = 'List';
        $result['metaKeywords'] = 'List';
        $result['title'] = "List";
        $this->load->view('dashboard/list',$result);
    }

}
?>