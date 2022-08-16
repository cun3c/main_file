@extends('storefront.layout.theme3')
@section('page-title')
    {{__('Cart')}}
@endsection
@section('content')
@section('head-title')
    {{__('Welcome').', '.\Illuminate\Support\Facades\Auth::guard('customers')->user()->name}}
@endsection
@section('content')
  @if($storethemesetting['enable_header_img'] == 'on')  
  <div class="home-banner-slider">
    @if(isset($storethemesetting['enable_banner_img']) && $storethemesetting['enable_banner_img'] == 'on')
            <div class="banner-img" width="660" height="766" style="background: url({{asset(Storage::url('uploads/store_logo/'.(!empty($storethemesetting['banner_img'])?$storethemesetting['banner_img']:'header_img_3.png')))}});"></div>
        @endif
    <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                        <h1 class=" mt-4 store-title t-secondary w-75">{{__('Products you purchased')}}</h1>
                        <div class="row mt-5">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="black-border"></div>
                                <ul class="banner-list">
                                    <a href="{{route('store.slug',$store->slug)}}" class="btn btn-sm btn-black btn-icon" >
                                        <span class="btn-inner--text text-white">{{__('Back to home')}}</span>
                                        <span class="btn-inner--icon">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                    </a>
                                </ul>
                            </div>
                        </div>
                       

                    </div>
                </div>
            </div>
        </div> 
          
            
    @endif
    <section class="slice slice-lg delimiter-bottom">
        <div class="container">
            <div class="col-lg-12">
            <div class="row">
                @if(!empty($purchased_products) && count($purchased_products) > 0)
                    @foreach($purchased_products as $product)

                        @if(in_array($product->id,Auth::guard('customers')->user()->purchasedProducts()))
                            <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                            <div class="card card-product">
                                <div class="card-image">
                                    <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
                                        @if(!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/'.$product->is_cover))
                                            <img alt="Image placeholder" height="163" width="123" src="{{asset(Storage::url('uploads/is_cover_image/'.(!empty($product->is_cover)?$product->is_cover:'')))}}" class="img-center">
                                        @else
                                            <img alt="Image placeholder" height="163" width="123" src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" class="img-center">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body pt-0">
                                    <h6><a class="t-black13" href="{{route('store.product.product_view',[$store->slug,$product->id])}}">{{$product['name']}}</a></h6>
                                    <p class="text-sm">
                                        {{__('Category')}}:<span class="t-black">
                                            {{$product->product_category()}}
                                        </span>
                                    </p>
                                    @if($product['enable_product_variant'] == 'on')
                                        <div class="product-price m-0">
                                            <span class="card-price t-black15">{{__('In variant')}}</span>
                                            <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
                                                <button type="button" class="m-4 btn btn-sm btn-primary rounded-pill btn-icon hover-translate-y-n3">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @else
                                        <p><span class="card-price t-black15">{{\App\Models\Utility::priceFormat($product->price)}}</span></p>
                                        <div class="product-price m-0">
                                            <a class="btn btn-sm btn-black btn-icon add_to_cart" data-id="{{$product->id}}">
                                                <span class="btn-inner--text text-white">{{__('Add to cart')}}</span>
                                                <span class="btn-inner--icon text-white">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </span>
                                            </a>
                                            @if(!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                @if($wishlist[$product->id]['product_id'] != $product->id)
                                                    <button type="button" class="btn btn-sm btn-primary rounded-pill btn-icon hover-translate-y-n3 add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-primary rounded-pill btn-icon hover-translate-y-n3 bg-light-gray" data-id="{{$product->id}}" disabled>
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-primary rounded-pill btn-icon hover-translate-y-n3 add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                                   <!-- <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                                                    <div class="card card-fluid card-product">
                                                        <div class="card-image">
                                                            
                                                            <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}">   
                                                                @if(!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/'.$product->is_cover))
                                                                    <img alt="Image placeholder" src="{{asset(Storage::url('uploads/is_cover_image/'.$product->is_cover))}}" class="img-center img-fluid">
                                                                @else
                                                                    <img alt="Image placeholder" src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" class="img-center img-fluid">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <span class="static-rating static-rating-sm">
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
                                                                                $color = 'text-warning';
                                                                            }
                                                                        @endphp
                                                                        <i class="star fas {{$icon .' '. $color}}"></i>
                                                                    @endfor
                                                                @endif
                                                            </span>
                                                            <h6>
                                                                <a class="t-black13" href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
                                                                    {{$product->name}}
                                                                </a>
                                                            </h6>
                                                            <p class="text-sm">
                                                                <span class="td-gray">{{__('Category')}}:</span> {{$product->product_category()}}
                                                            </p>
                                                            <div class="product-price mt-3">
                                                            <span class="card-price t-black15">
                                                                @if($product->enable_product_variant == 'on')
                                                                    {{__('In variant')}}
                                                                @else
                                                                    {{\App\Models\Utility::priceFormat($product->price)}}
                                                                @endif
                                                            </span>
                                                                @if($product->enable_product_variant == 'on')
                                                                    <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}" class="action-item pcart-icon bg-primary">
                                                                        <i class="fas fa-shopping-basket"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="action-item pcart-icon bg-primary add_to_cart" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-basket"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="actions card-product-actions">
                                                            @if(!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                @if($wishlist[$product->id]['product_id'] != $product->id)
                                                                    <button type="button" class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{$product->id}}" data-id="{{$purchased_products->id}}">
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
                                                </div>      -->
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
