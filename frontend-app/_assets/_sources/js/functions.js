(function (window, undefined) {
  History.Adapter.bind(window, 'statechange', function () {
    var State = History.getState();
    if (typeof State.data.content !== 'undefined') {
      for (var selector in State.data.content) {
        jQuery(selector).replaceWith(State.data.content[selector]);
        initScroll();
      }
    }
  });
})(window);

function EnableHistoryState(box, replaceUrlHandler) {
  var selectors = [
    box + ' .filter a',
    box + ' a[data-sort]',
    box + ' .pagination a'
  ];

  var state = {};
  state[box] = getHtmlFromJQueryObject(jQuery(box));
  History.replaceState({content: state});

  jQuery('body').on('click', selectors.join(', '), function (e) {
    var $link = jQuery(this),
      url = $link.prop('href');

    jQuery.get($link.prop('href'), function (response) {
      jQuery(box).replaceWith(response);

      inputStyler();

      if (typeof replaceUrlHandler === 'function') {
        url = replaceUrlHandler(url);
      }

      var state = {};
      state[box] = response;
      History.pushState({content: state}, document.title, url);
    });

    e.preventDefault();
  });
}

function initScroll() {
  jQuery('[data-scroll="true"]').each(function () {
    var $this = jQuery(this);
    if (typeof $this.data('scroll-init') === 'undefined') {
      $this.jScrollPane({
        mouseWheelSpeed: 40,
        verticalGutter: -8
      });

      if ($this.is('[data-begin-from-bottom="true"]')) {
        $this.data('jsp').scrollToBottom();
      }

      $this.data('scroll-init', true);
    }
  });
}

function setMinHeightToBodyContainer() {
  var $body = jQuery('.body'),
    $footer = jQuery('#footer');
  $body.css('min-height', jQuery(window).height() - $footer.height() - parseInt($body.css('padding-top')) - parseInt($footer.css('margin-top')) - 18);
}

function getHtmlFromJQueryObject($object) {
  return $('<div>').append($object.clone()).html();
}