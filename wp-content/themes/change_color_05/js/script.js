jQuery(document).ready(function() {
  $("#owl-product-carousel-first").owlCarousel({
      items : 1,
      itemsDesktop: [1400, 1],
      itemsDesktopSmall: [1100, 1],
      itemsTablet: [767, 1],
      itemsMobile: [500, 1],
      autoPlay: 6000,
      navigation : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : true,
      paginationNumbers: false,
          //singleItem : true,
      navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      rewindNav : true,
      stopOnHover : true
  });
  
  
  $("#owl-product-carousel-first-1").owlCarousel({
      items : 1,
      itemsDesktop: [1400, 1],
      itemsDesktopSmall: [1100, 1],
      itemsTablet: [767, 1],
      itemsMobile: [500, 1],
      autoPlay: 4000,
      navigation : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : true,
      paginationNumbers: false,
          //singleItem : true,
      navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      rewindNav : true,
      stopOnHover : true
  });
  
  $("#owl-magazine").owlCarousel({
      items : 6,
      itemsDesktop: [1400, 6],
      itemsDesktopSmall: [960, 4],
      itemsTablet: [767, 4],
      itemsMobile: [500, 2],
      autoPlay: 4000,
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : false,
      paginationNumbers: false,
          //singleItem : true,
      navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      rewindNav : true,
      stopOnHover : true
  });
  
  $("#owl-voucher").owlCarousel({
      items : 1,
      itemsDesktop: [1400, 1],
      itemsDesktopSmall: [1100, 1],
      itemsTablet: [767, 1],
      itemsMobile: [500, 1],
      autoPlay: 4000,
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : false,
      paginationNumbers: false,
          //singleItem : true,
      navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      rewindNav : true,
      stopOnHover : true
  });
  

  $("a[href='#top']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
  
  $(".header-navigation").hover(
      function () {
        $(".menu-display").css('display','block');
        $(".category-menu-left").css('display', 'block');
      }, 
      function () {
        $(".category-menu-left").removeAttr('style');
        $(".menu-display").removeAttr('style');
      });
      
    var nav = $('.menu-scroll');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            nav.addClass("fix");
            return false;
        } else {
            nav.removeClass("fix");
        }
    }); 

});
        