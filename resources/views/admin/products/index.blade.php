@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Price') }}</div>

                    <div class="card-body">
                        @include('layouts.alerts')
                        <form action="{{ route('admin.products.store.price') }}" method="post">
                            @csrf
                            <input type="hidden" name="client_id" value="{{ $client_id }}">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Products</label>
                                <select class="form-select" aria-label="Default select example" name="product_id[]"
                                    id="product_id" multiple="multiple">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ old('price') }}" placeholder="Price">
                            </div>
                            <div class="mb-3">
                                {{-- submit --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->products as $product)
                                    <tr>
                                        <th scope="row">{{ $product->id }}</th>
                                        <td>{{ $product->title }}</td>
                                        <td>
                                            $@php
                                                $price = $user->productPrices
                                                    ->where('product_id', $product->id)
                                                    ->where('user_id', $user->id)
                                                    ->first();
                                                if ($price) {
                                                    echo $price->price . ' (' . $product->price . ')';
                                                } else {
                                                    echo $product->price;
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // load products with ajax
            $('#product_id').select2({
                placeholder: 'Select Products',
                ajax: {
                    url: '/admin/products/ajax',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
