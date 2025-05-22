<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    ]) }}
    style="background-color: #52cfe4; color: black;"
    onmouseover="this.style.backgroundColor='#1e70a1'; this.style.color='white';"
    onmouseout="this.style.backgroundColor='#52cfe4'; this.style.color='black';"
>
    {{ $slot }}
</button>

