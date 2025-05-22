<div>
    @if ($finalPrice== $price)
        <p class="sale-price">₹{{ number_format($finalPrice, 0, '.', '') }}</p>

   @else
    <p class="sale-price">₹{{ number_format($finalPrice, 0, '.', '') }}<span class="real-price">₹{{ number_format($price, 0, '.', '') }}</span></p>
    @endif
</div>

