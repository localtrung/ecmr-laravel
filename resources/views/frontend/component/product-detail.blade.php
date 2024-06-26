@php
    $name = $product->name;
    $canonical = write_url($product->canonical, true, true);
    $image = image($product->image);
    $price = getPrice($product);
    // $catName = $productCatalogue ->name;
    $review = getReview($product) ;
    $description = $product->description;
    $attributeCatalogue = $product->attributeCatalogue;

@endphp

<div class="panel-body">
    <?php   
            $colorImage = [
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-2.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-1.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-3.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-4.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-5.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-6.jpg',
                'https://wp.alithemes.com/html/ecom/demo/assets/imgs/page/product/img-gallery-7.jpg',
            ]
        ?>
    <div class="uk-grid uk-grid-medium">
        <div class="uk-width-large-1-2">
            <div class="popup-gallery">
                <div class="swiper-container">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper big-pic">
                        <?php foreach($colorImage as $key => $val){  ?>
                        <div class="swiper-slide" data-swiper-autoplay="2000">
                            <a href="<?php echo $val ?>" class="image img-cover"><img src="<?php echo $val?>"
                                    alt="<?php echo $val ?>"></a>
                        </div>
                        <?php }  ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-container-thumbs">
                    <div class="swiper-wrapper pic-list">
                        <?php foreach($colorImage as $key => $val){  ?>
                        <div class="swiper-slide">
                            <span class="image img-cover"><img src="<?php echo $val?>" alt="<?php echo $val ?>"></span>
                        </div>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-large-1-2">
            <div class="popup-product">
                <h2 class="title"><span>{{ $name }}</span>
                </h2>
                <div class="rating">
                    <div class="uk-flex uk-flex-middle">
                        <div class="author">Đánh giá: </div>
                        <div class="star">
                            <?php for($i = 0; $i<=4; $i++){ ?>
                            <i class="fa fa-star"></i>
                            <?php }  ?>
                        </div>
                        <div class="rate-number">(65 reviews)</div>
                    </div>
                </div>
                {!! $price['html'] !!}
                <div class="description">
                    {!! $description !!}
                </div>
                @if(!is_null($attributeCatalogue))
                @foreach($attributeCatalogue as $key => $val)
                <div class="attribute">
                    <div class="attribute-item attribute-color">
                        <div class="label">{{ $val -> name }}</div>
                        @if(!is_null($val->attributes))
                        <div class="attribute-value">
                            @foreach($val->attributes as $attr)
                                <a data-attributeid ="{{ $attr->id }}" title="{{$attr -> name}}">{{$attr -> name}}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
                <!-- .attribute -->
                <div class="quantity">
                    <div class="text">Số lượng</div>
                    <div class="uk-flex uk-flex-middle">
                        <div class="quantitybox uk-flex uk-flex-middle">
                            <div class="minus quantity-button"><img src="resources/img/minus.svg" alt=""></div>
                            <input type="text" name="" value="1" class="quantity-text">
                            <div class="plus quantity-button"><img src="resources/img/plus.svg" alt=""></div>
                        </div>
                        <div class="btn-group uk-flex uk-flex-middle">
                            <div class="btn-item btn-1"><a href="" title="">Thêm vào giỏ hàng</a></div>
                            <div class="btn-item btn-2"><a href="" title="">Buy Now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>