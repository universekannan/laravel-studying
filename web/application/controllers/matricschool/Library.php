<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

	public function index()
	{
		$this->load->view('matricschool/library');
	}
}
