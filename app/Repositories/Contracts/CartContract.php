<?php
namespace App\Repositories\Contracts;

use App\Models\Product;

interface CartContract{
    public function index();
    public function insert($productId,$quantity);
    public function update($id,$quantity);
    public function delete($id);
    public function deleteAll();
    public function total();
}