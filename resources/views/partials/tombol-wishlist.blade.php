<a href="{{ route('wishlist.index') }}" aria-label="Wishlist Saya" class="relative z-10 ml-auto w-9 h-9 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-500 hover:text-primary hover:border-primary transition-colors">
    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
        <path d="M10 17.5s-6.5-4-8.5-8A4.5 4.5 0 0 1 10 5a4.5 4.5 0 0 1 8.5 4.5c-2 4-8.5 8-8.5 8Z"/>
    </svg>
    @if($jumlahWishlist>0)
        <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded full bg-secondary text-white text-[10px] font-bold flex items-center justify-center">{{ $jumlahWishlist }}</span>
    @endif
</a>