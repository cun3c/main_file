@extends('storefront.layout.theme5')
@section('page-title')
    {{__('Cart')}}
@endsection
@section('content')
@section('head-title')
    {{__('Welcome').', '.\Illuminate\Support\Facades\Auth::guard('customers')->user()->name}}
@endsection
@section('content')
   
    {{--HEADER IMG--}}
    @if($storethemesetting['enable_header_img'] == 'on')
        <section class="contain-product container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="banner-contain">
                        <h1>{{__('Products you purchased')}}</h1>
                        <p>
                        </p>
                        <a href="{{route('store.slug',$store->slug)}}" class="btn btn-sm btn-primary btn-icon shadow hover-shadow-lg hover-translate-y-n3" id="pro_scroll">
                            <span class="btn-inner--text">{{__('Back to home')}}</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-shopping-basket"></i>
                        </span>
                        </a>
                    </div>
                </div>
                
            </div>
        </section>
    @endif

    
    <section class="slice slice-lg delimiter-bottom">
        <div class="container">
            <div class="col-lg-12">
            <div class="row">
                @if(!empty($purchased_products) && count($purchased_products) > 0)
                    @foreach($purchased_products as $product)
                        @if(in_array($product->id,Auth::guard('customers')->user()->purchasedProducts()))
                           <div class="col-xl-3 col-lg-4 col-sm-6">
                                                    <div class="product-box">
                                                        <div class="card card-product card-fluid">
                                                            <div class="box-rate">
                                                                <div class="static-rating static-rating-sm">
                                                                    @if($store->enable_rating == 'on')
                                                                        @for($i =1;$i<=5;$i++)
                                                                            @php
                                                                                $icon = 'fa-star';
                                                                                $color = '';
                                                                                $newVal1 = ($i-0.5);
                                                                                if($product->product_rating() < $i && $product->product_rating() >= $newVal1)
                                                                                {
                                                                                    $icon = 'fa-star-half-alt';
                                                                                }
                                                                                if($product->product_rating() >= $newVal1)
                                                                                {
                                                                                    $color = 'text-primary';
                                                                                }
                                                                            @endphp
                                                                            <i class="star fas {{$icon .' '. $color}}"></i>
                                                                        @endfor
                                                                    @endif
                                                                </div>
                                                                <div class="card-product-actions">
                                                                    @if(!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                        @if($wishlist[$product->id]['product_id'] != $product->id)
                                                                            <button type="button" class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                                                <i class="far fa-heart"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button" class="action-item wishlist-icon bg-light-gray" data-id="{{$product->id}}" disabled>
                                                                                <i class="fas fa-heart"></i>
                                                                            </button>
                                                                        @endif
                                                                    @else
                                                                        <button type="button" class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                                            <i class="far fa-heart"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="card-image py-3">
                                                                <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
                                                                    @if(!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/'.$product->is_cover))
                                                                        <img class="img-center img-fluid" style="width:135px; height:167px" src="{{asset(Storage::url('uploads/is_cover_image/'.$product->is_cover))}}" alt="New collection" title="New collection">
                                                                    @else
                                                                        <img class="img-center img-fluid" style="width:135px; height:167px" src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" alt="New collection" title="New collection">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <h6><a href="{{route('store.product.product_view',[$store->slug,$product->id])}}" class="t-black13">{{$product->name}}</a></h6>
                                                                @if($product['enable_product_variant'] != 'on')
                                                                    <div class="product-price mt-3">
                                                                        <span class="card-price t-black15 mb-2">{{\App\Models\Utility::priceFormat($product->price)}}</span>
                                                                    </div>
                                                                    <div class="p-button">
                                                                        <button type="button" class="action-item pcart-icon bg-primary">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </button>
                                                                        <a href="#" class="btn btn-sm btn-white btn-icon add_to_cart" data-id="{{$product['id']}}">
                                                                        <span class="btn-inner--text text-primary">
                                                                            {{__('Add to cart')}}
                                                                        </span>
                                                                            <span class="btn-inner--icon">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </span>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="product-price mt-3">
                                                                        <span class="card-price t-black15 mb-2">{{__('In Variant')}}</span>
                                                                    </div>
                                                                    <div class="p-button">
                                                                        <button type="button" class="action-item pcart-icon bg-primary">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </button>
                                                                        <a href="{{route('store.product.product_view',[$store->slug,$product['id']])}}" class="btn btn-sm btn-white btn-icon">
                                                                        <span class="btn-inner--text text-primary">
                                                                            {{__('Add to cart')}}
                                                                        </span>
                                                                            <span class="btn-inner--icon">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </span>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>         
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <div class="text-center">
                                <i class="fas fa-folder-open text-gray" style="font-size: 48px;"></i>
                                <h2>{{ __('Opps...') }}</h2>
                                <h6> {!! __('No data Found.') !!} </h6>
                            </div>
                        </td>
                    </tr>
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script-page')
@endpush
