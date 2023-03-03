<?php
require('app/models/ReportModel.php');

class Report extends BaseController
{
    public function __construct()
    {
        if (!Helper::is_login()) {
            $this->redirect('auth');
        }
    }

    public function penjualan($month, $year)
    {
        $report                 = new ReportModel();
        $data['month']          = $month;
        $data['year']           = $year;
        $data['transactions']   = $report->transaction($month, $year);
        $this->view("report/transaction", $data);
    }
}