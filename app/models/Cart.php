<?php


class Cart {
private $db;

public function __construct(){
    $this->db = new Database();
}
function getAllBySessionId($id) {
    $query = 'SELECT `cart_test`.*, `products_test`.*
    FROM `cart_test`
    JOIN `products_test` ON `cart_test`.`product_id` = `products_test`.`id`
    WHERE `cart_test`.`user_id` = :user_id';

    $this->db->query($query);   
    $this->db->bind(':user_id', $id);
    $result = $this->db->resultSet(); 
    return $result;
}







/*
function countQuantity($data) {
    $sql = 'SELECT COUNT(quantity) as quantity_count
            FROM cart_test
            WHERE user_id = :user_id AND product_id = :product_id';

$this->db->query($sql);
$this->db->bind(':user_id', $data['user_id']);
$this->db->bind(':product_id', $data['product_id']);

$result = $this->db->execute();
}
*/




//if quantity of products in carts_test table >0 return true and style this card
//where id = & userid=  

function countQuantity($data) {
    $sql = 'SELECT SUM(quantity) as quantity_count
            FROM cart_test
            WHERE user_id = :user_id AND product_id = :product_id';

    $this->db->query($sql);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':product_id', $data['product_id']);

    $this->db->execute();
    
    $result = $this->db->single(); 

    return $result->quantity_count; 
}


function insertData($data) {

$query = 'INSERT INTO cart_test (product_id,user_id,quantity) 
VALUES (:product_id,:user_id,:quantity)';
    
    $this->db->query($query);
        
    $this->db->bind(':product_id', $data['product_id']);

    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':quantity', $data['quantity']);

       
    return $this->db->execute();
}
function updatetData($data) {

    $query = 'INSERT INTO cart_test (product_id,user_id,quantity) 
    VALUES (:product_id,:user_id,:quantity)';
        
        $this->db->query($query);
            
        $this->db->bind(':product_id', $data['product_id']);
    
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':quantity', $data['quantity']);
    
           
        return $this->db->execute();
    }

    function updateQuantity($data) {
        $query = 'UPDATE cart_test 
                  SET quantity = quantity + 1 
                  WHERE user_id = :user_id AND product_id = :product_id';
    
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
    
        return $this->db->execute();
    }




}