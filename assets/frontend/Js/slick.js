$(".main_TinTuc").slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 5000,
  speed: 800,
});



$(".single-item").slick({
  prevArrow: '<i class="fas fa-chevron-left left_arrow"></i>',
  nextArrow: '<i class="fas fa-chevron-right right_arrow"></i>',
  dots: true,
  autoplay: true,
  autoplaySpeed: 5000,
  speed: 800,
  infinite: true,
});
