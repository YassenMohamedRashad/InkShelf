<?php

namespace App\Livewire\Components;

use App\Models\Book_category;
use Livewire\Component;

class BooksSlider extends Component
{
    public $category;
    public function render()
    {
        return view('livewire.components.books-slider');
    }
}
