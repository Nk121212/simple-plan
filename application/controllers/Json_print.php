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
                'action' => '<a href="'.base_url().'purpose/add_helper/'.base64_encode($dt_pp->id).'" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Helper</a>'
            );

            $i++;

        }

        echo json_encode($data, JSON_PRETTY_PRINT);

	}

    public function list_task(){

        $this->load->model('M_crud');

        header('content-type:application/json');

        $param = array(
			'table' => array(
			  'SP_TASK_PURPOSE',
			  'SP_PURPOSE', 
			  'SP_TASK_PROGRESS'
			),
			'field' => array(
			  'id_purpose',
			  'id', 
			  'id_task',
			),
			'table_join_key' => array(
			  '1_0', 
			  '2_0'
			),
			'field_join_key' => array(
				'1_0',
				'2_1'
			)
        );

        $where = array(
            'email_helper' => $this->session->userdata('email')
        );

        $select = 'SP_TASK_PURPOSE.*, SP_TASK_PURPOSE.comment as task_comment, SP_PURPOSE.*, SP_TASK_PROGRESS.*, SP_TASK_PURPOSE.attachment as attachment_task, SP_TASK_PURPOSE.start_date as task_start, SP_TASK_PURPOSE.end_date as task_finish';

        $task_count = $this->M_crud->join_multiple_table($param, $where, 'sp_task_purpose.id', '', '', $select);

        $total_task = count($task_count->result());

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        $task_paging = $this->M_crud->join_multiple_table($param, $where, 'sp_task_purpose.id', $offset, '10', $select);
        //$task_paging = $this->M_crud->join_2_table('SP_TASK_PURPOSE', 'SP_PURPOSE', 'id_purpose', 'id', '', 'SP_TASK_PURPOSE.id', $offset, '10', $select);

        $data = array(
            //'test' => pathinfo($task_paging->row()->attachment, PATHINFO_EXTENSION),
            'response_real'=>$task_paging->result(),
            'recordsTotal' => $total_task,
            'recordsFiltered' => $total_task,
            'data' => array()
        );

        $i=1;
        foreach($task_paging->result() as $dt_task){

            $diff = abs(strtotime($dt_task->end_date) - strtotime($dt_task->start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            //$interval = printf("%d tahun, %d bulan, %d hari\n", $years, $months, $days);

            $data['data'][] = array(
                'id' => $dt_task->id,
                'purpose' => $dt_task->purpose,
                'task' => $dt_task->task,
                'comment' => $dt_task->task_comment,
                'progress' => $dt_task->progress.' %',
                'attachment' => '<a href="'.base_url().''.$dt_task->attachment_task.'" target="_blank"><i class="fa fa-eye"></i></a>',
                'interval' => $years.' Tahun '. $months.' Bulan '. $days.' Hari'
                //'action' => '<a href="'.base_url().'purpose/delete_purpose/'.$dt_task->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Task</a>'
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

    public function list_req_help(){
        $this->load->model('M_crud');

        header('content-type:application/json');

        $param = array(
			'table' => array(
			  'SP_PURPOSE_HELPER',
			  'SP_PURPOSE', 
			  'SP_USER'
			),
			'field' => array(
			  'id_purpose',
			  'id', 
			  'email',
			  'email_user'
			),
			'table_join_key' => array(
			  '1_0', 
			  '2_1'
			),
			'field_join_key' => array(
				'1_0',
				'2_3'
			)
		);

        $where = array(
			'SP_PURPOSE_HELPER.email_helper' => $this->session->userdata('email')
		);

        $request_count = $this->M_crud->join_multiple_table($param, $where, 'SP_PURPOSE_HELPER.id_purpose');
        
        $total_request = count($request_count->result());

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        $request_paging = $this->M_crud->join_multiple_table($param, $where, 'SP_PURPOSE_HELPER.id_purpose', $offset, '5');

        $data = array(
            'response_real'=>$request_paging->result(),
            'recordsTotal' => $total_request,
            'recordsFiltered' => $total_request,
            'data' => array()
        );

        foreach($request_paging->result() as $dt_req){

            $data['data'][] = array(
                'image' => '
                    <img src="'.base_url().''.$dt_req->image.'" class="rounded-circle" height="50">
                    <p class="font-weight-bold" style="padding-top: 10px;">'.$dt_req->first_name.' '.$dt_req->last_name.'</p>
                ',
                'detail_request' => '
                    <p class="font-weight-bold">Request Help '.date("d M Y h:i:s", strtotime($dt_req->add_at)).'</p>
                    <p><b>'.$dt_req->purpose.'</b></p>
                    <p>'.$dt_req->comment.'</p>
                ',
                'detail_others' => '
                    <input type="text" name="rating" class="star-rating rating-loading" value="'.$dt_req->rating.'" data-size="sm" title="" readonly>
                    <p class="font-weight-bold" style="padding-top:10px;">'.date("d M Y", strtotime($dt_req->start_date)).' - '.date("d M Y", strtotime($dt_req->end_date)).'</p>
                '
            );

        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }


}

?>