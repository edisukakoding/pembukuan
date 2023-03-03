<?php 
require('app/models/CustomerModel.php');

class Customer extends BaseController
{
    private $customer;

    public function __construct()
    {
        if(!Helper::is_login()) {
            $this->redirect('auth');
        }

        $this->customer = new CustomerModel();
    }
    
    public function index()
    {
        $customers = $this->customer->getCustomers();
        
        $this->view('customer/index', ['customers' => $customers]);
    }

    public function tambah()
    {
        $this->view('customer/tambah');
    }

    public function simpan()
    {
        if($this->customer->createCustomer($_POST)) {
            Helper::flash_message('flash', 'data berhasil disimpan', 'alert-success');
            $this->redirect('customer');
        } else {
            Helper::flash_message('flash', 'data gagal disimpan', 'alert-danger');
            $this->redirect('customer/tambah');
        }
    }

    public function edit($id) 
    {
        $customer = $this->customer->getCustomerById($id);
        $this->view('customer/edit', ['customer' => $customer]);
    }

    public function update($id)
    {
        if($this->customer->updateCustomer($_POST, $id)) {
            Helper::flash_message('flash', 'data berhasil diubah', 'alert-success');
            $this->redirect('customer');
        } else {
            Helper::flash_message('flash', 'tidak ada data yg terupdate', 'alert-danger');
            $this->redirect('customer/edit/' . $id);
        }
    }
}