<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syllabus extends CI_Controller {

	public function index()
	{
		$this->load->view('syllabus');
	}
}
