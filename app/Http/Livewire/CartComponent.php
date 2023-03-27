<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class CartComponent extends Component {

    public function increaseQuantity( $rowId ) {
        $product = Cart::instance( 'cart' )->get( $rowId );
        $qty = $product->qty + 1;

        Cart::instance( 'cart' )->update( $rowId, $qty );
    }

    public function decreaseQuantity( $rowId ) {
        $product = Cart::instance( 'cart' )->get( $rowId );
        $qty = $product->qty - 1;

        Cart::instance( 'cart' )->update( $rowId, $qty );
    }

    public function destroy( $rowId ) {
        Cart::instance( 'cart' )->remove( $rowId );
        session()->flash( "success_msg", "Item has benn removed!" );
    }

    public function clearAll() {
        Cart::instance( 'cart' )->destroy();
    }

    public function render() {
        return view( 'livewire.cart-component' );
    }
}
