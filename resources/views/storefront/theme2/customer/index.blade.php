@extends('storefront.layout.theme2')
@section('page-title')
    {{__('Customer Home')}}
@endsection
@section('content')
@section('head-title')
    {{__('Welcome').', '.\Illuminate\Support\Facades\Auth::guard('customers')->user()->name}}
@endsection
@section('content')
    @if($storethemesetting['enable_header_img'] == 'on')
        <div class="bd-example home-banner-slider">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-inner" role="listbox">
                    <div class="bg-cover bg-size--cover home-banner carousel-item active" data-offset-top="#header-main" style="background-image: url({{asset(Storage::url('uploads/store_logo/'.(!empty($storethemesetting['header_img'])?$storethemesetting['header_img']:'home-banner1.png')))}}); background-position: center center; padding-top: 77px;">
                        <div class="carousel-caption  d-md-block">
                            <div class="container py-6 box-height">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="h1 text-white store-title w-25">{{__('Products you purchased')}}</h2>
                                        <p class="lead text-white mt-4 w-50"></p>
                                        <a href="{{route('store.slug',$store->slug)}}" class="btn btn-sm btn-primary btn-icon shadow hover-shadow-lg hover-translate-y-n3" id="pro_scroll">
                                            <span class="btn-inner--text t-secondary">{{__('Back to home')}}</span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row banner-social">
                                    <ul>
                                        @if(!empty($storethemesetting['whatsapp']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://wa.me/{{$storethemesetting['whatsapp']}}" target="_blank">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($storethemesetting['facebook']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$storethemesetting['facebook']}}" target="_blank">
                                                    <i class="fab fa-facebook-square"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($storethemesetting['twitter']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$storethemesetting['twitter']}}" target="_blank">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($storethemesetting['email']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="mailto:{{$storethemesetting['email']}}">
                                                    <i class="far fa-envelope"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($storethemesetting['instagram']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$storethemesetting['instagram']}}" target="_blank">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($storethemesetting['youtube']))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$storethemesetting['youtube']}}" target="_blank">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="bestsellers-section" id="pro_items">
            <div class="container">
                <div class="row">
                        @foreach($purchased_products as $product)
                            @if(in_array($product->id,Auth::guard('customers')->user()->purchasedProducts()))                       

                                        @if($product->count() > 0)

                                                <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                                                    <div class="card card-product">
                                                        <div class="card-image">
                                                            <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
                                                                @if(!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/'.$product->is_cover))
                                                                    <img alt="Image placeholder" src="{{asset(Storage::url('uploads/is_cover_image/'.$product->is_cover))}}" class="img-center img-fluid" style="height:275px; width:255px;">
                                                                @else
                                                                    <img alt="Image placeholder" src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" class="img-center img-fluid" style="height:275px; width:255px;">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="card-body mt-3">
                                                            <h6><a href="{{route('store.product.product_view',[$store->slug,$product->id])}}" class="t-black13">{{$product->name}}</a></h6>
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
                                                            <div class="product-price mt-3 mb-3">
                                                                <span class="card-price t-black15">
                                                                    @if($product->enable_product_variant == 'on')
                                                                        {{__('In variant')}}
                                                                    @else
                                                                        {{\App\Models\Utility::priceFormat($product->price)}}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="product-buttons">
                                                                @if($product->enable_product_variant == 'on')
                                                                    <a href="{{route('store.product.product_view',[$store->slug,$product->id])}}" class="btn btn-sm btn-primary rounded-pill btn-icon shadow hover-shadow-lg hover-translate-y-n3">
                                                                        <span class="btn-inner--text">{{__('Add to cart')}}</span>
                                                                        <span class="btn-inner--icon">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </span>
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill btn-icon shadow hover-shadow-lg hover-translate-y-n3 add_to_cart" data-id="{{$product->id}}">
                                                                        <span class="btn-inner--text">{{__('Add to cart')}}</span>
                                                                        <span class="btn-inner--icon">
                                                                        <i class="fas fa-shopping-basket"></i>
                                                                    </span>
                                                                    </a>
                                                                @endif

                                                                @if(!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                    @if($wishlist[$product->id]['product_id'] != $product->id)
                                                                        <button href="#" class="btn btn-sm bg-gray shadow  btn-icon hover-shadow-lg hover-translate-y-n3 add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                                            <span class="btn-inner--icon">
                                                                                <i class="far fa-heart"></i>
                                                                            </span>
                                                                        </button>
                                                                    @else
                                                                        <button href="#" class="btn btn-sm bg-gray shadow  btn-icon hover-shadow-lg hover-translate-y-n3" data-id="{{$product->id}}" disabled>
                                                                            <span class="btn-inner--icon">
                                                                                <i class="fas fa-heart"></i>
                                                                            </span>
                                                                        </button>
                                                                    @endif
                                                                @else
                                                                    <button href="#" class="btn btn-sm bg-gray shadow  btn-icon hover-shadow-lg hover-translate-y-n3 add_to_wishlist wishlist_{{$product->id}}" data-id="{{$product->id}}">
                                                                        <span class="btn-inner--icon">
                                                                            <i class="far fa-heart"></i>
                                                                        </span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                        @endif
                                    </div>
                           @endif 
                        @endforeach
                </div>
            </div>
        </section>

    
@endsection
@push('script-page')
    <script>
        $(".add_to_cart").click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var variants = [];
            $(".variant-selection").each(function (index, element) {
                variants.push(element.value);
            });

            if (jQuery.inArray('', variants) != -1) {
                show_toastr('Error', "{{ __('Please select all option.') }}", 'error');
                return false;
            }
            var variation_ids = $('#variant_id').val();

            $.ajax({
                url: '{{route('user.addToCart', ['__product_id',$store->slug,'variation_id'])}}'.replace('__product_id', id).replace('variation_id', variation_ids ?? 0),
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    variants: variants.join(' : '),
                },
                success: function (response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        $("#shoping_counts").html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (result) {
                    console.log('error');
                }
            });
        });

        $(document).on('click', '.add_to_wishlist', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: '{{route('store.addtowishlist', [$store->slug,'__product_id'])}}'.replace('__product_id', id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).removeClass('add_to_wishlist');
                        $('.wishlist_' + response.id).html('<i class="fas fa-heart"></i>');
                        $('.wishlist_count').html(response.count);
                    } else {
                        show_toastr('Error', response.message, 'error');
                    }
                },
                error: function (result) {
                }
            });
        });

        $(".productTab").click(function (e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });

    $("#pro_scroll").click(function () {
        $('html, body').animate({
            scrollTop: $("#pro_items").offset().top
        }, 1000);
    });

   
    </script>
@endpush
