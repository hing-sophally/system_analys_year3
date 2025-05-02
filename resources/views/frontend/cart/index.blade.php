@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <h2>My Cart</h2>

    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <input type="number" 
                                   value="{{ $item['quantity'] }}" 
                                   min="1" 
                                   class="form-control quantity-input" 
                                   data-id="{{ $item['id'] }}">
                        </td>
                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-item" data-id="{{ $item['id'] }}">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ number_format($total, 2) }}</h4>

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Update quantity
    $('.quantity-input').change(function() {
        let productId = $(this).data('id');
        let quantity = $(this).val();

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                location.reload(); // Reload to update totals
            }
        });
    });

    // Remove item
    $('.remove-item').click(function() {
    let productId = $(this).data('id');

    $.ajax({
        url: "{{ route('cart.remove') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            product_id: productId
        },
        success: function(response) {
            if (response.success) {
                // Remove the row from the table
                $('button[data-id="' + productId + '"]').closest('tr').remove();

                // Update total if any items are left
                let total = 0;
                $('.table tbody tr').each(function() {
                    let subtotal = parseFloat($(this).find('td:nth-child(4)').text().replace('$', '').trim());
                    total += subtotal;
                });
                
                // Update total in the UI
                if (total > 0) {
                    $('.my-5 h4').text('Total: $' + total.toFixed(2));
                } else {
                    $('.my-5 h4').text('Your cart is empty.');
                }
            }
        }
    });
});
});



</script>
@endsection
