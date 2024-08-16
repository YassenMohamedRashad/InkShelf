<ul id="{{$containerId??"search-result"}}" class="menu rounded-xl divide-y-2 space-y-2 absolute top-full left-0 w-full bg-white border border-gray-300 z-10 hidden">
</ul>
<x-splade-script>
    // Debounce function
    function debounce(func, wait) {
    let timeout;
    return function(...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, args), wait);
    };
    }

    // Event handler function
    function handleInput() {
    let query = this.value;
    let results = document.getElementById('{{$containerId ?? "search-result"}}');

    if (query.length > 0) {
    fetch(`{{ route('books.live_search') }}?query=${query}`)
    .then(response => response.json())
    .then(data => {
    results.innerHTML = '';
    if (data.length > 0) {
    results.classList.remove('hidden');
    } else {
    results.classList.add('hidden');
    }

    data.forEach(book => {
    let li = document.createElement('li');
    let link = document.createElement('a');
    link.className = 'flex p-2';

    let img = document.createElement('img');
    img.src = book.cover;
    img.alt = '';
    img.className = 'aspect-auto w-[30px]';

    let div = document.createElement('div');
    div.className = 'ms-3';

    let title = document.createElement('div');
    title.className = 'font-bold text-base';
    title.textContent = book.title;

    let rate = document.createElement('div');
    rate.className = 'font-bold text-sm text-gray-500';
    rate.textContent = book.rate;

    div.appendChild(title);
    div.appendChild(rate);
    link.appendChild(img);
    link.appendChild(div);
    li.appendChild(link);
    results.appendChild(li);
    });
    });
    } else {
    results.innerHTML = '';
    results.classList.add('hidden');
    }
    }

    // Get the search input element
    const searchInput = document.getElementById("{{$input ?? 'search-input'}}");

    // Apply debounce to input event handler
    searchInput.addEventListener('input', debounce(handleInput, {{$debounce ?? 500}}));

    // Clear results on blur
    searchInput.addEventListener('blur', function() {
    let results = document.getElementById("{{$containerId ?? 'search-result'}}");
    results.innerHTML = '';
    results.classList.add('hidden');
    });

</x-splade-script>
