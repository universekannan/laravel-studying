<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	public function index()
	{
		$this->load->view('newsletter');
	}
}
