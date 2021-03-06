<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('M_crud');

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
			'SP_PURPOSE_HELPER.email_helper' => $this->session->userdata('data_user')[0]['email'],
			'SP_PURPOSE.status' => 0
		);

		$request_help = $this->M_crud->join_multiple_table($param, $where, 'SP_PURPOSE_HELPER.id_purpose', '', '5', '', 'SP_PURPOSE.add_at', 'DESC');

		$where_email = array(
			'email_user' => $this->session->userdata('data_user')[0]['email'],
			'SP_PURPOSE.status' => 0
		);

		$get_id_purpose = $this->M_crud->get_where('SP_PURPOSE', $where_email);

		$array_progress = array();
		foreach ($get_id_purpose->result() as $key => $value) {

			$get_task_by_id_purpose = $this->M_crud->get_where('SP_TASK_PURPOSE', array('id_purpose' => $value->id));

			$total = $get_task_by_id_purpose->num_rows() == 0 ? 100 : $get_task_by_id_purpose->num_rows();

			$percent_every_task = (100/$total);

			$getTaskByIdPurpose = $this->M_crud->get_where('SP_TASK_PROGRESS', array('id_purpose' => $value->id));

			$total_progress = 0;
			foreach ($getTaskByIdPurpose->result() as $key => $dtprog) {
				$total_progress += ($dtprog->progress/100)*$percent_every_task;
			}

			$diff = abs(strtotime($value->end_date) - strtotime($value->start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

			$array_progress[] = array(
				'id_purpose' => $value->id,
				'purpose' => $value->purpose,
				'progress' => round($total_progress, 2),
				'total_task' => $get_task_by_id_purpose->num_rows(),
				'start' => date('d M Y', strtotime($value->start_date)),
                'end' => date('d M Y', strtotime($value->end_date)),
                'interval' => $years.' Tahun '. $months.' Bulan '. $days.' Hari'
			);

		}

		$data = array('main' => 'home/dashboard', 'request_help' =>$request_help, 'progress' => $array_progress);
		$this->load->view('home/home', $data);

	}

}
