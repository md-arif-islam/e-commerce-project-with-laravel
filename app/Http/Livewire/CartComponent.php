<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class CartComponent extends Component {

    public function increaseQuantity( $rowId ) {
        $product = Cart::get( $rowId );
        $qty = $product->qty + 1;

        Cart::update( $rowId, $qty );
    }

    public function decreaseQuantity( $rowId ) {
        $product = Cart::get( $rowId );
        $qty = $product->qty - 1;

        Cart::update( $rowId, $qty );
    }

    public function destroy( $rowId ) {
        Cart::remove( $rowId );
        session()->flash( "success_msg", "Item has benn removed!" );

    }

    public function render() {
        return view( 'livewire.cart-component' );
    }
}
