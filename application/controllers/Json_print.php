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

        	$get_helper = $this->M_crud->get_where('SP_PURPOSE_HELPER', $arr);

            $data['data'][] = array(
                'id' => $dt_pp->id,
                'purpose' => $dt_pp->purpose,
                'helper' => '<a href="" class="btn btn-sm btn-primary">'.$get_helper->num_rows().' Helper</a>',
                'action' => '<a href="'.base_url().'purpose/add_helper/'.base64_encode($dt_pp->id).'" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Helper</a>
                	<a href="'.base_url().'purpose/delete_purpose/'.$dt_pp->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Purpose</a>'
            );

            $i++;

        }

        echo json_encode($data, JSON_PRETTY_PRINT);

	}

    public function list_task(){

        $this->load->model('M_crud');

        header('content-type:application/json');

        $where = array(
            'email_helper' => $this->session->userdata('email')
        );

        $task_count = $this->M_crud->join_2_table('SP_TASK_PURPOSE', 'SP_PURPOSE', 'id_purpose', 'id', '', 'SP_TASK_PURPOSE.id');

        $total_task = count($task_count->result());

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        $select = 'SP_TASK_PURPOSE.id, SP_TASK_PURPOSE.id_purpose, SP_TASK_PURPOSE.task, SP_TASK_PURPOSE.comment as task_comment, SP_PURPOSE.id, SP_PURPOSE.email_user, SP_PURPOSE.purpose';

        $task_paging = $this->M_crud->join_2_table('SP_TASK_PURPOSE', 'SP_PURPOSE', 'id_purpose', 'id', '', 'SP_TASK_PURPOSE.id', $offset, '10', $select);

        $data = array(
            'response_real'=>$task_paging->result(),
            'recordsTotal' => $total_task,
            'recordsFiltered' => $total_task,
            'data' => array()
        );

        $i=1;
        foreach($task_paging->result() as $dt_task){

            $data['data'][] = array(
                'id' => $dt_task->id,
                'purpose' => $dt_task->purpose,
                'task' => $dt_task->task,
                'comment' => $dt_task->task_comment,
                'action' => '<a href="'.base_url().'purpose/delete_purpose/'.$dt_task->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Task</a>'
            );

            $i++;

        }

        echo json_encode($data, JSON_PRETTY_PRINT);

    }

    public function list_helper($id_purpose){

        $this->load->model('M_crud');

        header('content-type:application/json');

        $where = array(
            'SP_PURPOSE_HELPER.id_purpose' => $id_purpose
        );
    
        $helper_count = $this->M_crud->join_2_table('SP_PURPOSE_HELPER', 'SP_USER', 'email_helper', 'email', $where);

        $total_helper = count($helper_count->result());

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        $helper_paging = $this->M_crud->join_2_table('SP_PURPOSE_HELPER', 'SP_USER', 'email_helper', 'email', $where, '', $offset, '10', '');

        $data = array(
            'response_real'=>$helper_paging->result(),
            'recordsTotal' => $total_helper,
            'recordsFiltered' => $total_helper,
            'data' => array()
        );

        foreach($helper_paging->result() as $dt_helper){

            $data['data'][] = array(
                'id_purpose' => $dt_helper->id_purpose,
                'email' => $dt_helper->email_helper,
                'first_name' => $dt_helper->first_name,
                'last_name' => $dt_helper->last_name,
                'action' => '<a href="#" class="btn btn-sm btn-danger text-white delete" id-purpose="'.$dt_helper->id_purpose.'" email-helper="'.$dt_helper->email_helper.'"><i class="fa fa-trash"></i> Helper</a>'
            );

        }

        echo json_encode($data, JSON_PRETTY_PRINT);

    }


}

?>