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
        $data['sum_of_deposit'] = $this->TransactionModel->get_sum_deposit()->total_amount;
        $data['sum_of_withdrawal'] = $this->TransactionModel->get_sum_withdrawal()->total_amount;
        $this->load->view('dashboard', $data);
    }

    public function deposit()
    {
        $data['deposits'] = $this->TransactionModel->get_deposit_data();
        $this->load->view('deposit/index', $data);
    }

    public function withdrawal()
    {
        $this->load->view('withdrawal/index');
    }
}