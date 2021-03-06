@extends('frontend.layouts.master')
@section('mainContent')

<div class="container">
    <h1 class="text-center">Cart Page</h1>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="50%">Product</th>
                <th width="10%">Price</th>
                <th width="8%">Quantity</th>
                <th width="22%">Sub Total</th>
                <th width="10%"></th>
            </tr>
            </thead>
            <tbody>
            @php $total = 0; @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $product)
                    @php
                        $sub_total = $product['price'] * $product['quantity'];
                        $total += $sub_total;
                    @endphp
                    <tr>
                        <td>
                            <img
                                src="{{$product['image']}}"
                                alt="{{$product['name']}}"
                                class="img-fluid"
                                width="150"
                            >
                            <span>{{$product['name']}}</span>
                        </td>
                        <td>₹{{$product['price']}}</td>
                        <td>
                            <form action="{{route('change_qty', $id)}}" class="d-flex">
                                <button
                                    type="submit"
                                    value="down"
                                    name="change_to"
                                    class="btn btn-danger"
                                >
                                    @if($product['quantity'] === 1) x @else - @endif
                                </button>
                                <input
                                    type="number"
                                    value="{{$product['quantity']}}"
                                    disabled>
                                <button
                                    type="submit"
                                    value="up"
                                    name="change_to"
                                    class="btn btn-success"
                                >
                                    +
                                </button>
                            </form>
                        </td>
                        <td>₹{{$sub_total}}</td>
                        <td>
                            <a href="{{route('remove', [$id])}}" class="btn btn-danger btn-sm">X</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <a href="{{route('cart')}}"
                       class="btn btn-warning"
                    >Continue Shopping</a>
                    {{-- <form action="{{route('pay')}}" method="post">
                        @csrf
                        <input type="hidden" name="amount" value="{{$total}}">
                        <button type="submit"
                                class="btn btn-success"
                        >Proceed to Pay
                        </button>
                        <button type="submit"
                                class="btn btn-warning"
                                name="gateway"
                                value="paypal"
                        >Proceed with Paypal
                        </button>
                    </form> --}}

                </td>
                <td colspan="2"></td>
                <td><strong>Total ₹{{$total}}</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection

