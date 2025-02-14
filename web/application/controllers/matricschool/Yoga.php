<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yoga extends CI_Controller {

	public function index()
	{
		$this->load->view('matricschool/yoga');
	}
}
