<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component {
    public function removeFromWishlist( $product_id ) {
        foreach ( Cart::instance( 'wishlist' )->content() as $witem ) {
            if ( $witem->id == $product_id ) {
                Cart::instance( 'wishlist' )->remove( $witem->rowId );
                $this->emitTo( 'wishlist-icon-component', 'refreshComponent' );
                return;
            }
        }
    }

    public function render() {
        return view( 'livewire.wishlist-component' );
    }
}
