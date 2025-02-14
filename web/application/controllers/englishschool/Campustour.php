<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campustour extends CI_Controller {

	public function index()
	{
		$this->load->view('campustour');
	}
}
