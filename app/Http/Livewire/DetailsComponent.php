<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class DetailsComponent extends Component {
    public $slug;

    public function mount( $slug ) {
        $this->slug = $slug;
    }

    public function render() {

        $product = Product::where( 'slug', $this->slug )->first();
        $related_products = Product::where( 'category_id', $product->category_id )->inRandomOrder()->limit( 4 )->get();
        $new_products = Product::latest()->limit( 4 )->get();

        return view( 'livewire.details-component', ['product' => $product, 'related_products' => $related_products, 'new_products' => $new_products] );

    }
}
