@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-4 mt-2">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->title }}</h5>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                Price: $
                                                @php
                                                    $price = $product->productPrices->where('user_id', Auth::id())->first();
                                                    if ($price) {
                                                        echo $price->price;
                                                    } else {
                                                        echo $product->price;
                                                    }
                                                @endphp
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="card-body d-flex justify-content-end">
                        @include('layouts.pagination', ['paginator' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
