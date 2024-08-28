<div>
    @foreach ($categories as $category )
    <livewire:components.books-slider :category="$category" :key="$category->id" />
    @endforeach
    <div class="text-center" x-intersect="$wire.loadMore()">
        <span class="loading loading-ring loading-lg text-orange-color"></span>
    </div>
</div>
