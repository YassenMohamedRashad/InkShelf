<div>
    @foreach ($categories as $category )
    <livewire:components.books-slider :category="$category"/>
    @endforeach
</div>
