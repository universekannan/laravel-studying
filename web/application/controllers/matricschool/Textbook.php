<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Textbook extends CI_Controller {

	public function index()
	{
		$this->load->view('matricschool/textbook');
	}
}
