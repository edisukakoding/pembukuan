<?php
require('app/models/TransactionModel.php');
require('app/models/CustomerModel.php');
require('app/models/ProductModel.php');

class Transaction extends BaseController
{
    private $transaction;
    private $customer;

    public function __construct()
    {
        if (!Helper::is_login()) {
            $this->redirect('auth');
        }

        $this->transaction  = new TransactionModel();
        $this->customer     = new CustomerModel();
        $this->product      = new ProductModel();
    }

    public function index()
    {
        $transactions   = $this->transaction->getTransactions();

        $this->view('transaction/index', ['transactions' => $transactions]);
    }

    public function tambah()
    {
        $customers       = $this->customer->getCustomers();
        $products        = $this->product->getProducts();
        $installments    = $this->transaction->getInstallments();
        $this->view('transaction/tambah', [
            'customers' => $customers,
            'products' => $products,
            'installments' => $installments
        ]);
    }

    public function simpan()
    {
        $data                           = $_POST;
        if (isset($data['is_moons'])) {
            $product                    = $this->product->getProductById($data['product_id']);
            $data['is_moons']           = 1;
            $data['total_price']        = $data['qty'] * $product['price'];
            $data['grand_total_price']  = $data['qty'] * $product['price'];
            // var_dump($data);die;
            if ($this->transaction->createTransaction($data) > 0) {
                Helper::flash_message('flash', 'Transaksi berhasil di buat', 'alert-success');
                $this->redirect('transaction');
            } else {
                Helper::flash_message('flash', 'Transaksi gagal di buat', 'alert-danger');
                $this->redirect('transaction');
            }
        } else {
            $product        = $this->product->getProductById($data['product_id']);
            $installment    = $this->transaction->getInstallmentById($data['installment_id']);
            $fix_price      = ($product['price'] * $data['qty']) - $installment['dp'];
            $moon           = $fix_price / $installment['max_moon'];
            $expense        = ($installment['persen'] * $fix_price / 100) / $installment['max_moon'];
            $per_moon       = $expense + $moon;

            $data['is_moons']           = 0;
            $data['total_price']        = $data['qty'] * $product['price'];
            $data['grand_total_price']  = ($per_moon * $installment['max_moon']) + $installment['dp'];
            
            $transaction_id = $this->transaction->createTransaction($data, true);
            if ($transaction_id > 0) {
                for ($i = 1; $i <= $installment['max_moon']; $i++) {
                    $this->transaction->createPiutang($transaction_id, $per_moon, $i);
                }

                Helper::flash_message('flash', 'Transaksi berhasil di buat', 'alert-success');
                $this->redirect('transaction/piutang/' . $transaction_id);
            } else {
                Helper::flash_message('flash', 'Transaksi gagal di buat', 'alert-danger');
                $this->redirect('transaction');
            }
        }
    }

    public function piutang($transaction_id)
    {
        $transaction    = $this->transaction->getTransactionById($transaction_id);
        $details        = $this->transaction->getDetailsByTransactionId($transaction_id);
        $this->view('transaction/piutang', [
            'transaction' => $transaction,
            'details' => $details
        ]);
    }

    public function dibayar($transaction_id, $installment_id)
    {
        $this->transaction->bayarPiutang($transaction_id, $installment_id);
        if ($this->transaction->is_lunas($transaction_id) == 0) {
            $this->transaction->update_lunas($transaction_id);
            Helper::flash_message('flash', 'Piutang telah lunas', 'alert-success');
        } else {
            Helper::flash_message('flash', 'Pembayaran berhasil', 'alert-success');
        }
        $this->redirect('transaction/piutang/' . $transaction_id);
    }

    public function edit($id)
    {
        $transaction = $this->transaction->gettransactionById($id);
        $this->view('transaction/edit', ['transaction' => $transaction]);
    }

    public function update($id)
    {
        if ($this->transaction->updatetransaction($_POST, $id)) {
            Helper::flash_message('flash', 'data berhasil diubah', 'alert-success');
            $this->redirect('transaction');
        } else {
            Helper::flash_message('flash', 'tidak ada data yg terupdate', 'alert-danger');
            $this->redirect('transaction/edit/' . $id);
        }
    }

    // angsuran
    public function setting_angsuran()
    {
        $installments = $this->transaction->getInstallments();
        $this->view('transaction/setting_angsuran', ['installments' => $installments]);
    }

    public function tambah_angsuran()
    {
        $this->view('transaction/tambah_angsuran');
    }

    public function simpan_angsuran()
    {
        if ($this->transaction->createInstallments($_POST)) {
            Helper::flash_message('flash', 'data berhasil disimpan', 'alert-success');
            $this->redirect('transaction/setting_angsuran');
        } else {
            Helper::flash_message('flash', 'data gagal disimpan', 'alert-danger');
            $this->redirect('transaction/tambah_angsuran');
        }
    }

    public function hitung_angsuran($product_id, $installment_id, $qty)
    {
        $product        = $this->product->getProductById($product_id);
        $installment    = $this->transaction->getInstallmentById($installment_id);
        $fix_price      = ($product['price'] * $qty) - $installment['dp'];
        $moon           = $fix_price / $installment['max_moon'];
        $expense        = ($installment['persen'] * $fix_price / 100) / $installment['max_moon'];
        $per_moon       = $expense + $moon;

        echo json_encode(['dp' => $installment['dp'], 'per_moon' => $per_moon], JSON_PRETTY_PRINT);
    }
}