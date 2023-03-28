<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponet extends Component {

    use WithPagination;

    public function render() {
        $categories = Category::orderBy( 'name', "ASC" )->paginate( 5 );
        return view( 'livewire.admin.admin-categories-componet', ['categories' => $categories] );
    }
}
