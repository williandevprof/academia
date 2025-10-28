<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Log_pdf extends CI_Controller{

	public function index()
	{
		$this->load->model('Log_mod');
		
		$postdata = file_get_contents("php://input");
		$log      = json_decode($postdata);

		$log->data1  = implode("-",array_reverse(explode("/",$log->data1)));

		$log->data2  = implode("-",array_reverse(explode("/",$log->data2)));

		
		$_SESSION['logs']['log'] = $this->Log_mod->pesquisarLog($log);
				
	}

	public function imprimirLog()
	{
		$this->load->view('log/log_pdf', $_SESSION['logs']);
	}
	
}



