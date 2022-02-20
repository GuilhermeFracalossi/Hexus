<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'information', 'category', 'price', 'status'];

    public static function getAll($ids = null, string $status = null, string $category = null, string $search = null) {

     
        $products = DB::table('products')
        ->leftJoin('images', 'products.id', '=', 'images.products_id');
        
        $products->join('categories', 'products.category', '=', 'categories.id');
        if (!empty($category)) {
            $products->where('categories.name', 'like', '%'.$category.'%');
        }
        if (!empty($search)) {
            $products->where('products.name', 'like', '%'.$search.'%');

        }
       

        $products->select('products.*', 'categories.name as categoryName', 'images.path as images');
        

        if ($status && strlen($status) == 1) {
            $products->where('products.status', $status);

        }
      
        if ($ids) {
            $products->whereIn('products.id', array_values($ids));
        }

        return $products->get();
       
    
       
    }
}
