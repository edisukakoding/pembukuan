<?php

require_once('core/BaseModel.php');

class ReportModel extends BaseModel
{
    public function transaction($bulan, $tahun)
    {
        return $this->query("SELECT a.*, b.name, b.price, c.firstname, c.lastname, d.dp
            FROM transactions a INNER JOIN products b 
            ON a.product_id = b.id INNER JOIN customers c 
            ON a.customer_id = c.id LEFT JOIN type_of_installments d
            ON a.installment_id = d.id
            WHERE MONTH(a.created_at) = $bulan
            AND YEAR(a.created_at) = $tahun
            ORDER BY a.created_at DESC
        ");
    }
}