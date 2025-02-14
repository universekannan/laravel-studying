<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sports extends CI_Controller {

	public function index()
	{
		$this->load->view('sports');
	}
}
