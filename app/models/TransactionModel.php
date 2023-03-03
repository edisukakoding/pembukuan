<?php

require_once('core/BaseModel.php');

class TransactionModel extends BaseModel
{
    public function getTransactions()
    {
        return $this->query("SELECT a.*, b.name, b.price, c.firstname, c.lastname, d.dp
            FROM transactions a INNER JOIN products b 
            ON a.product_id = b.id INNER JOIN customers c 
            ON a.customer_id = c.id LEFT JOIN type_of_installments d
            ON a.installment_id = d.id
            ORDER BY a.created_at DESC
        ");
    }

    public function getDetailsByTransactionId($id)
    {
        return $this->query("SELECT a.*, b.total_price, b.grand_total_price
            FROM transaction_details a INNER JOIN transactions b 
            ON a.transaction_id = b.id 
            WHERE b.id = $id
            ORDER BY a.created_at DESC
        ");
    }

    public function createTransaction($data, $return_last_id = false)
    {
        extract($data);
        if ($return_last_id) {
            $sql = "INSERT INTO transactions (customer_id, product_id, qty, is_moons, total_price, grand_total_price, installment_id) 
            VALUES ($customer_id, $product_id, $qty, $is_moons, $total_price, $grand_total_price, $installment_id)";
            $this->exec($sql);
            return $this->conn->lastInsertId();
        } else {
            $sql = "INSERT INTO transactions (customer_id, product_id, qty, is_moons, total_price, grand_total_price) 
                    VALUES ($customer_id, $product_id, $qty, $is_moons, $total_price, $grand_total_price)";
            return $this->exec($sql);
        }
    }

    public function getTransactionById($id)
    {
        return $this->query("SELECT a.*, b.name, b.price, c.firstname, c.lastname, d.dp
            FROM transactions a INNER JOIN products b 
            ON a.product_id = b.id INNER JOIN customers c 
            ON a.customer_id = c.id INNER JOIN type_of_installments d
            ON a.installment_id = d.id
            WHERE a.id = $id
            ORDER BY a.created_at DESC"
        )[0];
    }

    public function updateTransaction($data, $id)
    {
        extract($data);
        $member = isset($is_member) ? 1 :  0;
        $sql = "UPDATE transactions SET 
                    `firstname` = '$firstname', 
                    `lastname` = '$lastname', 
                    `gender` = '$gender', 
                    `phone` = '$phone', 
                    `email` = '$email',
                    `address` = '$address',
                    `is_member` = $member
                WHERE `id` = $id";
        return $this->update($sql);
    }

    public function createPiutang($transaction_id, $nominal, $installments)
    {
        $sql = "INSERT INTO transaction_details (transaction_id, nominal, installments) 
        VALUES ($transaction_id, $nominal, $installments)";
        $this->exec($sql);
    }

    public function bayarPiutang($transaction_id, $installment_id)
    {
        $sql = "UPDATE transaction_details SET is_paid = 1 WHERE transaction_id = $transaction_id AND id = $installment_id";
        $this->exec($sql);
    }

    public function is_lunas($transaction_id)
    {
        $piutang = $this->query("SELECT count(*) as piutang FROM transaction_details WHERE transaction_id = $transaction_id AND is_paid = 0")[0];
        return $piutang['piutang'];
    }

    public function update_lunas($transaction_id)
    {
        return $this->update("UPDATE transactions SET is_moons = 1 WHERE id = $transaction_id");
    }

    public function getInstallments()
    {
        return $this->query("SELECT * FROM type_of_installments");
    }

    public function createInstallments($data)
    {
        extract($data);
        $sql = "INSERT INTO type_of_installments (max_moon, dp, persen) 
                VALUES ($max_moon, $dp, $persen)";
        return $this->exec($sql);
    }

    public function getInstallmentById($id)
    {
        return $this->query("SELECT * FROM type_of_installments WHERE id = $id")[0];
    }
}