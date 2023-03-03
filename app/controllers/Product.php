<?php 
require('app/models/ProductModel.php');

class Product extends BaseController
{
    private $product;

    public function __construct()
    {
        if(!Helper::is_login()) {
            $this->redirect('auth');
        }

        $this->product = new ProductModel();
    }
    
    public function index()
    {
        $frames = $this->product->getProducts();
        
        $this->view('product/index', ['frames' => $frames]);
    }

    public function tambah()
    {
        $this->view('product/tambah');
    }

    public function simpan()
    {
        if($this->product->createProduct($_POST)) {
            Helper::flash_message('flash', 'data berhasil disimpan', 'alert-success');
            $this->redirect('product');
        } else {
            Helper::flash_message('flash', 'data gagal disimpan', 'alert-danger');
            $this->redirect('product/tambah');
        }
    }

    public function edit($id) 
    {
        $product = $this->product->getProductById($id);
        $this->view('product/edit', ['product' => $product]);
    }

    public function update($id)
    {
        if($this->product->updateProduct($_POST, $id)) {
            Helper::flash_message('flash', 'data berhasil diubah', 'alert-success');
            $this->redirect('product');
        } else {
            Helper::flash_message('flash', 'tidak ada data yg terupdate', 'alert-danger');
            $this->redirect('product/edit/' . $id);
        }
    }
}