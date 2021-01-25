<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Json_print extends CI_Controller {

	public function list_purpose(){

		$this->load->model('M_crud');

		header('content-type:application/json');

        $where = array(
            'email_user' => $this->session->userdata('email')
        );
    
        $purpose_count = $this->M_crud->get_where('SP_PURPOSE', $where);
        $total_purpose = count($purpose_count->result());

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        $purpose_paging = $this->M_crud->get_where('SP_PURPOSE', $where, $offset, '10');

        $data = array(
            'session' => $this->session->userdata(),
            'response_real'=>$purpose_paging->result(),
            'recordsTotal' => $total_purpose,
            'recordsFiltered' => $total_purpose,
            'data' => array()
        );

        $i=1;
        foreach($purpose_paging->result() as $dt_pp){

            $arr = array(
                'id_purpose' => $dt_pp->id
            );

        	$get_helper = $this->M_crud->get_where('SP_HELPER', $arr);

            $data['data'][] = array(
                'id' => $dt_pp->id,
                'purpose' => $dt_pp->purpose,
                'helper' => '<a href="" class="btn btn-sm btn-primary">'.$get_helper->num_rows().' Helper</a>',
                'action' => '<a href="'.base_url().'ask_help/add_helper/'.base64_encode($dt_pp->id).'" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Helper</a>
                	<a href="'.base_url().'ask_help/delete_purpose/'.$dt_pp->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Purpose</a>'
            );

            $i++;

        }

        echo json_encode($data, JSON_PRETTY_PRINT);

	}

}

?>