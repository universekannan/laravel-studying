<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chairman_message extends CI_Controller {

	public function index()
	{
		$this->load->view('matricschool/chairman-message');
	}
}
