<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magazine extends CI_Controller {

	public function index()
	{
		$this->load->view('matricschool/magazine');
	}
}
