<?php
require('app/models/TransactionModel.php');
require('app/models/CustomerModel.php');

class Dashboard extends BaseController
{
    private $customer, $transaction;
    public function __construct()
    {
        if (!Helper::is_login()) {
            $this->redirect('auth');
        }
        $this->customer = new CustomerModel();
    }

    public function index()
    {
        $total_customer     = $this->customer->query('SELECT count(*) AS customer FROM customers')[0];
        $total_transaction  = $this->customer->query('SELECT count(*) AS transaction FROM transactions')[0];
        $total_piutang      = $this->customer->query('SELECT count(*) AS piutang FROM transactions WHERE is_moons = 0')[0];

        // var_dump($total_customer);
        // die;
        $this->view('dashboard/index', [
            'total_customer' => $total_customer['customer'],
            'total_transaction' => $total_transaction['transaction'],
            'total_piutang' => $total_piutang['piutang']
        ]);
    }
}