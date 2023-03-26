<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class DetailsComponent extends Component {
    public $slug;

    public function mount( $slug ) {
        $this->slug = $slug;
    }

    public function store( $product_id, $product_name, $product_price ) {
        Cart::add( $product_id, $product_name, 1, $product_price )->associate( "App\Models\Product" );
        session()->flash( "success_msg", "Item added in cart" );
        return redirect()->route( "shop.cart" );
    }

    public function render() {

        $product = Product::where( 'slug', $this->slug )->first();
        $related_products = Product::where( 'category_id', $product->category_id )->inRandomOrder()->limit( 4 )->get();
        $new_products = Product::latest()->limit( 4 )->get();

        return view( 'livewire.details-component', ['product' => $product, 'related_products' => $related_products, 'new_products' => $new_products] );

    }
}
