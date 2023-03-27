<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component {
    use WithPagination;

    public $page_size = 12;
    public $orderBy = "Default Shorting";

    public $min_value = 0;
    public $max_value = 1000;

    public function store( $product_id, $product_name, $product_price ) {
        Cart::instance( 'cart' )->add( $product_id, $product_name, 1, $product_price )->associate( "App\Models\Product" );
        session()->flash( "success_msg", "Item added in cart" );
        return redirect()->route( "shop.cart" );
    }

    public function change_page_size( $size ) {
        $this->page_size = $size;
    }

    public function orderBy( $order ) {
        $this->orderBy = $order;
    }

    public function addToWishlist( $product_id, $product_name, $product_price ) {
        Cart::instance( 'cart' )->instance( 'wishlist' )->add( $product_id, $product_name, 1, $product_price )->associate( "App\Models\Product" );
        $this->emitTo( 'wishlist-icon-component', 'refreshComponent' );
    }

    public function render() {

        $products = Product::whereBetween( 'regular_price', [$this->min_value, $this->max_value] )->paginate( 10 );
        return view( 'livewire.shop-component', ['products' => $products] );

    }

    /*  public function render() {
if ( $this->orderBy == 'Price: Low to High' ) {
$products = Product::whereBetween( 'regular_price', [$this->min_value, $this->max_value] )->orderBy( 'regular_price', 'ASC' )->paginate( $this->pageSize );
} else if ( $this->orderBy == 'Price: High to Low' ) {
$products = Product::whereBetween( 'regular_price', [$this->min_value, $this->max_value] )->orderBy( 'regular_price', 'DESC' )->paginate( $this->pageSize );
} else if ( $this->orderBy == 'Sort By Newness' ) {
$products = Product::whereBetween( 'regular_price', [$this->min_value, $this->max_value] )->orderBy( 'created_at', 'DESC' )->paginate( $this->pageSize );
} else {
// $products = Product::whereBetween( 'regular_price', [$this->min_value, $this->max_value] );
}
$products = Product::paginate( 10 );
$categories = Category::orderBy( 'name', 'ASC' )->get();

return view( 'livewire.shop-component', ['products ' => $products, 'categories' => $categories] );
} */
}
