<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

    public function saveTransaction($data)
    {
        return $this->db->insert('transaction_records', $data); // Assuming the table is named 'transactions'
    }

    public function get_deposit_data()
    {
        $query = $this->db->get('transaction_records');
        return $query->result();
    }

    public function get_sum_deposit()
    {
        $this->db->select('SUM(amount) as total_amount');
        $this->db->where('type_of_transaction', 1);
        $query = $this->db->get('transaction_records');
        
        return $query->row();
    }

    public function get_sum_withdrawal()
    {
        $this->db->select('SUM(amount) as total_amount');
        $this->db->where('type_of_transaction', 2);
        $query = $this->db->get('transaction_records');
        
        return $query->row();
    }
}