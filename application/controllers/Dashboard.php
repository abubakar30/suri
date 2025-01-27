<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); // Load the URL helper
        $this->load->model('TransactionModel');
    }    

    public function index()
    {
        $this->load->view('dashboard');
    }

    public function deposit()
    {
        $data = $this->TransactionModel->get_deposit_data();
        $this->load->view('deposit/index');
    }

    public function withdrawal()
    {
        $this->load->view('withdrawal/index');
    }
}