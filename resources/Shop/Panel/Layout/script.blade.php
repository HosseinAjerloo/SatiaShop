<script src="{{asset("shop/assets/js/popper.min.js")}}"  ></script>
<script src="{{asset("shop/assets/js/bootstrap/bootstrap.min.js")}}" ></script>
<script src="{{asset("shop/assets/js/bootstrap/bootstrap.bundle.min.js")}}" ></script>
<script src="{{asset('shop/assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('shop/assets/js/sweetalert2@11.js')}}"></script>


<script>

    //start search
    $(document).ready(function() {


        $('#search').on('keypress',function(e) {
            if(e.which == 13) {

                if ($(this).val()!=='')
                {

                    $.ajax({
                        url:"{{route('panel.product.find')}}" ,
                        type: "POST",
                        data: {'name' : $(this).val(),'_token':"{{csrf_token()}}"},
                        success:function (responce){

                            if(!responce.status)
                            {
                                toast('محصولی جهت نمایش پیدا نشد',responce.status)
                            }
                            window.location.href = responce.route;


                        }
                    });
                }
            }
        });
        $(".search-result-type").click(function (){
            window.location.href = $(this).data("value");
        })
        $("#search").focusin(function() {
            $(".search-result").removeClass("visually-hidden");
            $(".search-box").addClass("search-box-active");
        }).add(".search-result").focusout(function() {

            if ( !$(".search-result").is(':focus') ) {
                $(".search-box").removeClass("search-box-active");
                setTimeout(function (){
                    $(".search-result").addClass("visually-hidden");
                },100)
            }



        });


    });
    //end search



    //start super navbar
    $(document).ready(function(){

        $(".super-navbar-item").hover(function () {
            $(".sublist-item").removeClass("sublist-item-active");
            $(".sublist-item").first().addClass("sublist-item-active");
        }, function () {
            $(".sublist-item").removeClass("sublist-item-active");
        });

        $(".sublist-item-toggle").click(function(){
            $(".sublist-item").removeClass("sublist-item-active");
            $(this).parent().addClass("sublist-item-active");
        });

        $(".sublist-item-toggle").hover(function(){
            $(".sublist-item").removeClass("sublist-item-active");
            $(this).parent().addClass("sublist-item-active");
        });

    });
    //end super navbar



    //start owlcarousel
    $(document).ready(function(){
        $("#slideshow").owlCarousel({
            rtl:true,
            loop:true,
            margin:0,
            nav:false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 1
        });

        $(".lazyload").owlCarousel({
            rtl:true,
            loop:false,
            margin:10,
            nav:true,
            dots:false,
            autoplay:false,
            autoHeight: false,
            items: 5,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 1,
                },
                // breakpoint from 480 up
                480 : {
                    items: 2,
                },
                // breakpoint from 768 up
                768 : {
                    items: 5,
                }
            }
        });


        $(".brands").owlCarousel({
            rtl:true,
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 5,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    items: 1,
                },
                // breakpoint from 480 up
                480 : {
                    items: 2,
                },
                // breakpoint from 768 up
                768 : {
                    items: 5,
                }
            }
        });



        // $(".owl-carousel").owlCarousel({
        //     rtl:true,
        //     loop:true,
        //     margin:0,
        //     nav:false,
        //     autoplay:true,
        //     autoplayTimeout:5000,
        //     autoplayHoverPause:true,
        //     animateOut: 'fadeOut',
        //     animateIn: 'fadeIn',
        //     items: 1
        // });
    });
    //end owlcarousel




    //start tooltip
    $(document).ready(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
    //end tooltip


    //start cart
    $(document).ready(function() {

        $(".cart-number-up").click(function(){
            var value = parseInt($(this).parent().find('input[type=number]').val());
            if(value < 5) {
                $(this).parent().find('input[type=number]').val(value + 1);
            }
        });

        $(".cart-number-down").click(function(){
            var value = parseInt($(this).parent().find('input[type=number]').val());
            if(value > 1) {
                $(this).parent().find('input[type=number]').val(value - 1);
            }
        });

    });
    //end cart




    //start address
    $(document).ready(function() {

        $('input[name="address"]').change(function(){

            var address = $('input[name="address"]').is(":checked");
            var delivery_type = $('input[name="delivery_type"]').is(":checked");

            if(address == true && delivery_type == true) {
                $("#address-button").removeClass("d-block");
                $("#address-button").addClass("d-none");
                $("#next-level").removeClass("d-none");
                $("#next-level").addClass("d-block");
            }
        });

        $('input[name="delivery_type"]').change(function(){

            var address = $('input[name="address"]').is(":checked");
            var delivery_type = $('input[name="delivery_type"]').is(":checked");

            if(address == true && delivery_type == true) {
                $("#address-button").removeClass("d-block");
                $("#address-button").addClass("d-none");
                $("#next-level").removeClass("d-none");
                $("#next-level").addClass("d-block");
            }
        });


    });
    //end address


    //start payment
    $(document).ready(function() {

        $('input[name="payment_type"]').change(function(){

            var payment_type = $('input[name="payment_type"]').is(":checked");

            if(payment_type == true) {
                $("#payment-button").removeClass("d-block");
                $("#payment-button").addClass("d-none");
                $("#final-level").removeClass("d-none");
                $("#final-level").addClass("d-block");
            }
        });


    });
    //end payment



    //start filter
    $(document).ready(function() {

        $(".sidebar-nav-item-title").click(function(){
            $header = $(this);
            $content = $header.next();

            $(".sidebar-nav-sub-sub-wrapper").slideUp();
            $(".sidebar-nav-sub-item-title i").removeClass("rotate-angle-left-90-degrees");
            if($content.is(":visible")) {
                $header.find("i").removeClass("rotate-angle-left-90-degrees");
                $content.slideUp();
            } else {
                $(".sidebar-nav-item-title i").removeClass("rotate-angle-left-90-degrees");
                $(".sidebar-nav-sub-wrapper").slideUp();
                $header.find("i").addClass("rotate-angle-left-90-degrees");
                $content.slideToggle(400);
            }
        });

        $(".sidebar-nav-sub-item-title").click(function(){
            $subHeader = $(this);
            $subContent = $subHeader.next();

            if($subContent.is(":visible")) {
                $subHeader.find("i").removeClass("rotate-angle-left-90-degrees");
                $subContent.slideUp();
            } else {
                $(".sidebar-nav-sub-item-title i").removeClass("rotate-angle-left-90-degrees");
                $(".sidebar-nav-sub-sub-wrapper").slideUp();
                $subHeader.find("i").addClass("rotate-angle-left-90-degrees");
                $subContent.slideToggle(400);
            }
        });

    });
    //end filter


    //start filter
    $(document).ready(function() {

        $(".product-gallery-selected-image img").css("height", $(".product-gallery-selected-image img").css("width"));
        $(".product-gallery-thumb").click(function(){
            var selectedImageSrc = $(this).attr("data-input");
            $(".product-gallery-selected-image img").attr("src", selectedImageSrc);
            $(".product-gallery-selected-image img").css("height", $(".product-gallery-selected-image img").css("width"));
        });

    });
    //end filter





</script>
<script>
    function toast(message, status) {
        showToast(message);
        if (!status) {
            $(".progress-bar div").css({'background-color': 'red'})
        }

    }
</script>
<script>
    function updateCartView(response) {
        $('.count-cart').html(response.cartItems.length)
        $('.cart-show-items').remove();
        let totalPrice = 0;
        let html = `
                                <section class="header-cart-dropdown cart-show-items">
                                        <section class="border-bottom d-flex justify-content-between p-2">
                                            <span class="text-muted">${response.cartItems.length} کالا</span>
                                            <a class="text-decoration-none text-info" href="{{route('panel.cart.index')}}">مشاهده سبد خرید </a>
                                        </section>`;
        for (const value of response.cartItems) {
            html = html +
                `<section class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">
                                                <img class="flex-shrink-1"
                                                     src="${value.image_path}"
                                                    alt="">
                                                <section class="w-100 text-truncate">
                                                    <a class="text-decoration-none text-dark" href="">
                                                        ${value.title}
                                                    </a>
                                                </section>
                                            <section class="flex-shrink-1">
                                                <a class="text-muted text-decoration-none p-1" href="${value.deleteRoute}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </section>
                                </section>`;

            totalPrice += Number(value.price)

        }
        totalPrice = (totalPrice / 10).toLocaleString()
        html = html + ` <section
                                    class="header-cart-dropdown-footer border-top d-flex justify-content-between align-items-center p-2">
                                    <section class="">
                                        <section>مبلغ قابل پرداخت</section>
                                        <section> ${totalPrice} تومان</section>
                                    </section>
                                    <section class="">
                                        <a class="btn btn-danger btn-sm d-block" href="{{route('panel.payment.advance')}}">
                                            ثبت سفارش
                                        </a>
                                    </section>
                                </section>
                                </section>`;
        $(".parent-cart-item").append(html);
    }
</script>

<script>
    function convertToPersian(nu) {
        nu = nu.toString();
        let numbers = {
            0: "۰",
            1: "۱",
            2: "۲",
            3: "۳",
            4: "۴",
            5: "۵",
            6: "۶",
            7: "۷",
            8: "۸",
            9: "۹"
        };
        return nu.replace(/\d/g, match => numbers[match]);
    }

    function changeTextNode(node) {
        if (node.nodeType === Node.TEXT_NODE) {
            node.textContent = convertToPersian(node.textContent);
        }
    }

    function convertToElement(el) {
        changeTextNode(el);
        el.childNodes.forEach(node => convertToElement(node));
    }

    function observerMutation() {
        const observer = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    observer.disconnect();
                    convertToElement(node);
                    observer.observe(document.body, {
                        childList: true,
                        subtree: true,
                        characterData: true
                    });
                });
                if (mutation.type === 'characterData') {
                    observer.disconnect();
                    convertToElement(mutation.target);
                    observer.observe(document.body, {
                        childList: true,
                        subtree: true,
                        characterData: true
                    });
                }
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
            characterData: true
        });
    }

    window.addEventListener('DOMContentLoaded', () => {
        convertToElement(document.body);
        observerMutation();
    });


</script>

