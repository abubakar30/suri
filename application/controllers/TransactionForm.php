<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionForm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('TransactionModel');
        $this->load->library('session');
    }    

    public function index()
    {
        $this->load->view('transaction_form');
    }

    public function submit()
    {
        // Load the input library
        $this->load->library('form_validation');

        // Validate the form inputs
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('reference', 'Reference', 'required');
        $this->form_validation->set_rules('type_of_transaction', 'Transaction Type', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('transaction_form');
        } else {
            // Retrieve form data
            $data = array(
                'name'             => $this->input->post('name'),
                'date'             => date('Y-m-d', strtotime($this->input->post('date'))),
                'reference'        => $this->input->post('reference'),
                'type_of_transaction' => $this->input->post('type_of_transaction'),
                'amount'           => $this->input->post('amount'),
                'created_at'           => date('Y-m-d'),
                'updated_at'           => date('Y-m-d')
            );

            // Process the data (e.g., save to the database)
            // Load your model and save the data
            $this->load->model('TransactionModel');
            if ($this->TransactionModel->saveTransaction($data)) {
                // Success
                $this->session->set_flashdata('success', 'Transaction submitted successfully!');
                redirect('dashboard');
            } else {
                // Error
                $this->session->set_flashdata('error', 'Failed to submit the transaction. Please try again.');
                redirect('TransactionForm');
            }
        }
    }
}