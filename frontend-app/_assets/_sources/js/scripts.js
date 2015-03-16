jQuery(function ($) {

  var $body = $('body'),
    $home = $('#home'),
    $document = $(document),
    $window = $(window);

  /*============================================
   Page Preloader
   ==============================================*/

  $window.load(function () {
    $('#page-loader').fadeOut(500);
  });

  $home.height($window.height() + 50);

  inputStyler();
  initScroll();

  $body.on('click', 'a.scrollto', function (e) {
    $('html,body').scrollTo(this.hash, this.hash, {gap: {y: -70}});
    e.preventDefault();

    if ($('.navbar-collapse').hasClass('in')) {
      $('.navbar-collapse').removeClass('in').addClass('collapse');
    }
  });

  $body.on('change', 'input[type=checkbox], input[type=radio]', function () {
    setCheckedState();
  });
  setCheckedState();

  function setCheckedState() {
    $('input[type=checkbox], input[type=radio]').each(function (index, input) {
      $(input).closest('label').toggleClass('checked', $(input).is(':checked'));
    });
  }

  $body.find('textarea:not(.static)').elastic();

  $body.on('click', '[data-href]', function (e) {
    window.open($(this).data('href'));
    e.preventDefault();
  });
  $body.on('mousedown', '[data-href]', function (e) {
    if (e.which === 2) {
      window.open($(this).data('href'));
      e.preventDefault();
    }
  });

  $body.on('mouseenter', '[data-tooltip]', function (e) {
    var $container = $(this);
    if (typeof $container.prop('tooltip-init') === 'undefined') {
      $container.tooltip({
        content: function () {
          return $(this).prop('title');
        },
        track: true,
        position: {my: "left+10 center+20"}
      }).prop('tooltip-init', true)
        .trigger('mouseenter');
    }
  });

  /*============================================
   Resize Functions
   ==============================================*/
  $window.on('resize', function () {
    $home.height($(window).height() + 50);

    setMinHeightToBodyContainer();
  }).trigger('resize');
});