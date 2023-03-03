<?php 

require_once('core/BaseModel.php');

class CustomerModel extends BaseModel
{
    public function getCustomers()
    {
        return $this->query("SELECT * FROM customers");
    }

    public function createCustomer($data) 
    {
        extract($data);
        $member = isset($is_member) ? 1 :  0;
        $sql = "INSERT INTO customers (firstname, lastname, gender, phone, email, address, is_member) 
                VALUES ('$firstname', '$lastname', '$gender', '$phone', '$email', '$address', $member)";
        return $this->exec($sql);
    }

    public function getCustomerById($id)
    {
        return $this->query("SELECT * FROM customers WHERE id = $id")[0];
    }

    public function updateCustomer($data, $id) 
    {
        extract($data);
        $member = isset($is_member) ? 1 :  0;
        $sql = "UPDATE customers SET 
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
}