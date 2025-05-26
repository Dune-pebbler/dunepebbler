var $grid, projectGrid, newsGrid, projectNewsGrid;
jQuery(document).ready(function () {
  // preparations
  onReplaceInputButtons();
  onSvgLoad();
  getBrowserDetails();
  wrapIframe();
  fillVacForm();
  setOnInnerAnimations();
  setOnPrepareAnimations();
  setOnEqualHeights();
  setOnReplaceTitelValue();


  startGlobalGrid();
  startSmartSelect();
  setGridListeners();
  setOnScrollDownClickedListener();
  setOnAutoloadButtonClickedListener();
  setMoreLessFixGrid();
  setOnMenuBlur();
  setDataToggleListener();
  setOnImageLoadedGrid();
  setOnSearch();
  setOnQuickFilters();
  // gridFetch();
  startInstaFeed();
  startOwlSlider();
  setFormListeners();
  setNewsLetterToggle();
  if (!isMobile())
    setOnMovingLetters();
  setOnRecordView();
  setOnTabClick();
  setOnAutoplaySafari();
  setOnInputFocus();

  jQuery('[data-src]').each(function () {
    jQuery(this).attr('src', jQuery(this).data('src'));
  })
});

jQuery(window).scroll(function () {
  setOnWindowScrolled();
  setOnOverviewAutoLoader();
});

jQuery(window).on('load', function () {
  onPrepareFixTranslates();
})

jQuery(window).resize(function () {
  onPrepareFixWidths();
  onPrepareFixTranslates();
  setOnEqualHeights();
})
jQuery(document).ajaxStop(function () {
  setOnRecordView();
});


let settings = {
  isLoading: false,
  isDisabled: true,
  page: 1,
  increment: function () { return settings.page = settings.page + 1; }
};

function setOnAutoloadButtonClickedListener() {
  jQuery('.set-autoload').on('click', function (event) {
    event.preventDefault();
    jQuery(this).hide();
    jQuery(this).parent().find('.loader').show();
    settings.isDisabled = false;
    setOnOverviewAutoLoader();
  })
}

function setOnOverviewAutoLoader() {
  let targetQuery = jQuery('.autoload-items');
  let filters = {};

  if (targetQuery.length === 0) return;
  if (settings.isDisabled) return;

  // we will check the current scrolltop
  let currentScrollTop = jQuery(window).scrollTop() + jQuery(window).outerHeight();
  let targetScrollTop = targetQuery.offset().top + (targetQuery.outerHeight() * .50);
  let action = targetQuery.attr('data-action');

  if (currentScrollTop < targetScrollTop) { return }
  if (settings.isLoading) return;

  settings.isLoading = true;

  // fetch filters
  filters.search = jQuery('.filters [name=search]').val();
  filters.categories = [];

  jQuery('.filters [data-name].is-active').each(function () {
    filters.categories.push(jQuery(this).data("name"));
  })

  jQuery('.load-more').stop().hide();
  jQuery('.loader').stop().show();

  // we fetch new ones.
  return jQuery.ajax({
    url: ajaxurl,
    method: "POST",
    data: {
      action: action,
      index: settings.increment(),
      filters: filters,
    },
    dataType: 'json',
  }).done(function (result) {
    let query = jQuery(result.html);

    query.addClass('added-by-ajax')

    targetQuery.find(".row").append(query);

    jQuery('.loader').stop().hide();

    if (result.html == '') {
      settings.isDisabled = true;
    } else {
      jQuery('.load-more').stop().show();
    }

    settings.isLoading = false;
  })
}

function setOnQuickFilters() {
  let currentSearchParameters = new URLSearchParams(window.location.search);
  let searchingParameters = currentSearchParameters.get("expertise") || [];
  searchingParameters = typeof searchingParameters == 'string' ? searchingParameters.split(",") : searchingParameters;

  jQuery('.filters [name=search]').on('keyup', function (event) {
    event.preventDefault();
    event.stopPropagation();

    let searchQueryParameter = jQuery(this).val();
    let queryString = [];

    if (searchQueryParameter.trim() != '') {
      queryString.push(`search=${searchQueryParameter}`);
    }

    if (searchingParameters.length > 0) {
      queryString.push(`expertise=${searchingParameters.join(",")}`);
    }

    if (event.keyCode === 13)
      window.location.search = queryString.join("&");

    return false;
  })

  jQuery('[data-reset]').on('click', function (event) {
    event.preventDefault();

    window.location.href = `${window.location.origin}${window.location.pathname}`;
  });

  jQuery('[data-name]').not('.wpcf7-form-control-wrap').on('click', function (event) {
    event.preventDefault();
    let searchQueryParameter = jQuery('.filters [name=search]').val();
    let queryString = [];

    if (searchingParameters.indexOf(jQuery(this).data('name')) > -1) {
      let index = searchingParameters.indexOf(jQuery(this).data('name'));

      searchingParameters.splice(index, 1);
    } else {
      searchingParameters.push(jQuery(this).data('name'));
    }

    if (searchQueryParameter.trim() != '') {
      queryString.push(`search=${searchQueryParameter}`);
    }

    if (searchingParameters.length > 0) {
      queryString.push(`expertise=${searchingParameters.join(",")}`);
    }

    window.location.search = queryString.join("&");
  });
}

function onReplaceInputButtons() {
  jQuery('input[type=submit]').each(function () {
    let input = jQuery(this);
    let attributes = {};

    for (let i = 0; i < input[0].attributes.length; i++) {
      attributes[input[0].attributes[i].nodeName] = input[0].attributes[i].nodeValue;
    }

    let query = jQuery("<button />", attributes).append(jQuery(this).contents())

    // we have to set the button text
    query.html(attributes.value);
    // we add the btn class. we need it :)
    query.addClass('btn');
    // we change the type to button
    query.attr('type', 'button');

    // append the new button before the old one.
    input.before(query);
    // hide the old one.
    input.hide();

    // we simulate the click, cause you know... some listeners might not be set anymore :(
    query.on('click', () => input.click());
  });


  jQuery('button.btn, a.btn, .btn').each(function () {
    jQuery(this).html(`<span> ${jQuery(this).html()}</span>`)
  });
}

function setOnReplaceTitelValue() {
  jQuery('.contactperson .content h3 .word').each(function () {
    let word = jQuery(this).text().replace("?", "");

    if (postTitle.indexOf(word) === -1) {
      return;
    }

    jQuery(this).addClass('theme-color-single');
  })
}

function setOnAutoplaySafari() {
  if (navigator.userAgent.toLowerCase().indexOf("safari") < 0 && navigator.userAgent.toLowerCase().indexOf("chrome") > -1) return;
  setTimeout(function () {
    const video = jQuery('.new-video-container video');

    video.each(function () {
      const promise = this.play();
    })


  }, 100)
}

function setOnTabClick() {
  jQuery('.floating-box ul li').on('click', function () {
    let index = jQuery(this).index();
    let container = jQuery(this).parents('.detailed-slider');

    container.find('.floating-box ul li').removeClass('is-active');
    container.find('.text-containers .text-container').removeClass('is-active');


    jQuery(this).addClass('is-active');
    container.find('.text-containers .text-container').eq(index).addClass('is-active');
  })
}

function setOnEqualHeights() {
  let heighestHeight = 0;
  let currentOffset = typeof jQuery('.more-about-us h3').first().offset() != "undefined" ? jQuery('.more-about-us h3').first().offset().top : false;
  let heights = {};
  let element = false;


  // check if the current offset is set
  if (!currentOffset) { return; }

  // reset the height of the items
  jQuery('.more-about-us h3').css({ height: 'auto' });

  // we loop through it and get the heights
  jQuery('.more-about-us h3').each(function () {
    element = jQuery(this);

    // check if we have to reset the height.
    if (currentOffset != element.offset().top) {
      // we save the reference
      heights[currentOffset] = heighestHeight;
      // we reset the heighestheight and the offset which checks the reset
      heighestHeight = element.outerHeight();
      currentOffset = element.offset().top;
    }

    heighestHeight = element.outerHeight() > heighestHeight ? element.outerHeight() : heighestHeight;
  })

  heights[currentOffset] = heighestHeight;

  // set the height 
  jQuery('.more-about-us h3').each(function () {
    let element = jQuery(this);

    element.css({ height: heights[element.offset().top] })
  });
}

function setNewsLetterToggle() {
  //  jQuery('.newsletter-popup').on('click', function (e) {
  //    if (!jQuery(this).hasClass('closed')) return;
  //    if (jQuery(e.target).hasClass('open')) return;
  //    e.preventDefault();
  //
  //    // remove the class closed
  //    jQuery(this).removeClass('closed');
  //  })
  $('.close-popup').on('click', function () {
    $(this).toggleClass('open');
    $('.newsletter-popup').toggleClass('open');
    $('.open-pop').toggleClass('upside');
    e.preventDefault();
  });

  $('.newsletter-popup h2').on('click', function () {
    $('.newsletter-popup').toggleClass('open');
    $('.open-pop').toggleClass('upside');
    e.preventDefault();
  });

}

function fillVacForm() {
  jQuery('[name=vac]').val(postTitle);
}

function setFormListeners() {
  jQuery('#send-contact-form').on('click', function () {
    // do something
    jQuery('.wpcf7-form').submit();

    setTimeout(function () {
      if (jQuery('form [aria-invalid="true"]').length > 0)
        return;
      window.location.href = "/bedankt-voor-je-interesse-in-dune-pebbler/";
    }, 1000)
  });

  jQuery('[name^=acceptance-contact]').on('change', function () {
    // show send button
    jQuery('#send-contact-form').toggleClass('show');
    $('#send-contact-form').prop('disabled', false);
  });

  jQuery('#send-apply-form').on('click', function () {
    // do something
    jQuery('.wpcf7-form').submit();
    setTimeout(function () {
      if (jQuery('form [aria-invalid="true"]').length > 0)
        return;
      window.location.href = "/zo-we-zullen-je-sollicitatie-beoordelen-en-heel-snel-contact-met-je-opnemen/";
    }, 1000)
    // window.location.href = "/bedankt-voor-je-interesse-in-dune-pebbler/";
  });

  jQuery('[name^=acceptance-apply]').on('change', function () {
    // show send button
    jQuery('#send-apply-form').toggleClass('show');
    $('#send-apply-form').prop('disabled', false);
  });
}

function getBrowserDetails() {
  // Get Browser version
  var browser = '';
  var browserVersion = 0;

  if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Opera';
  } else if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
    browser = 'MSIE';
  } else if (/Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Netscape';
  } else if (/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Chrome';
  } else if (/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Safari';
    /Version[\/\s](\d+\.\d+)/.test(navigator.userAgent);
    browserVersion = new Number(RegExp.$1);
  } else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Firefox';
  }
  if (browserVersion === 0) {
    browserVersion = parseFloat(new Number(RegExp.$1));
  }

  jQuery('.browserversion').html(browser + ", versie: " + browserVersion);
}

function startInstaFeed() {
  if (jQuery('#instafeed').length == 0)
    return;

  var feed = new Instafeed({
    get: 'user',
    userId: '3536216882',
    accessToken: 'IGQVJYanBYeTh4MXMxVUhpcEREdFozN2JlMURDTEZA1akpWY1VaTDFGeHdZAempJMFdJd3Y2bnlJclhWcVRuUmw4STU2VVduOHdDbWNDc2VDVkVYc09ZATXc3bUJJQmNLVW9lU2JGSWZA5UmhrWWZAnUVpWRgZDZD',
    template: '<div class="item instagram"><figure><a href="{{link}}" target="_blank"><img src="{{image}}" class="img-responsive"></a></figure><p>{{caption}}</p></div>',
    limit: 1,
    resolution: 'standard_resolution',
    after: function () {
      $('.instafeed').each(function (index, el) {
        var count = index + 1;

        $(el).addClass('item-' + count);

        $(el).find('img, a').css({ 'max-width': '100%' })
      });
    }
  });

  feed.run();
}

function setOnWindowScrolled() {
  var a = 10;
  var pos = $(window).scrollTop();
  if (pos > a) {
    $("header").addClass('scrolled');
  } else {
    $("header").removeClass('scrolled');
  }
}

function startOwlSlider() {
  jQuery('.-owl-slider-').each(function () {
    var element = jQuery(this);
    var options = {
      loop: true,
      items: 5,
      margin: 5,
      nav: false,
      lazyload: true,
      autoplay: true,
      responsive: {
        // breakpoint from 0 up
        0: {
          nav: true,
          items: 2
        },
        480: {
          nav: true,
          items: 3
        },
        768: {
          nav: false,
          items: 4
        },
        992: {
          nav: false,
          items: 5
        }
      }
    };

    element.owlCarousel(options);
  });

  jQuery(".custom-slider-nav button").on('click', function () {
    if (jQuery(this).hasClass('prev')) {
      jQuery(this).parents('.simple-slider').find('.owl-prev').click();
    }

    if (jQuery(this).hasClass('next')) {
      jQuery(this).parents('.simple-slider').find('.owl-next').click();
    }
  })

  jQuery('.simple-slider .slider-target').on('initialized.owl.carousel', function () {
    let container = jQuery(this);

    setTimeout(function () {
      let items = container.find('.owl-dots').children().length;
      let placeholder = container.prev().find('.is-placeholder').clone();

      // remove the old one
      container.prev().find('.is-placeholder').remove();

      // prepare clickable item
      placeholder.removeClass('is-placeholder');

      for (let i = 0; i < items; i++) {
        _placeholder = placeholder.clone();

        container.prev().find('ul').append(_placeholder);

        _placeholder.on('click', function () {
          container.find('.owl-dots button').eq(jQuery(this).index()).click();
        });
      }


      setOnRecordView();
    }, 100)
  })

  jQuery('.simple-slider .slider-target').owlCarousel({
    loop: false,
    items: 4,
    margin: 25,
    nav: false,
    lazyload: true,
    // autoplay: true,
    responsive: {
      // breakpoint from 0 up
      0: {
        nav: false,
        items: 1,
        stagePadding: 25
      },
      480: {
        nav: false,
        items: 1,
        stagePadding: 25
      },
      768: {
        nav: false,
        items: 3
      },
      992: {
        nav: false,
        items: 3
      },
      1199: {
        nav: false,
        items: 4
      }

    }
  })
}

function startGlobalGrid() {
  $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer',
    stagger: 30
  });
}

function startSmartSelect() {
  jQuery('.filters select').each(function () {
    jQuery(this).smartSelect({
      defaultText: jQuery(this).find('option').first().text(),
      closeText: "Sluiten"
    });
  });
}

function setGridListeners() {
  // set listener for the grid
  jQuery('.filters select').on('change', function () {
    filterGrid();
  });

  jQuery('.filters input').on('keyup', function () {
    filterGrid();
  });
}

function setOnMenuBlur() {
  jQuery(document.body).on('keyup', function (e) {

    if (e.keyCode != 27)
      return;

    jQuery('.navigation, .navigation .main-nav').removeClass('active');
    jQuery('main, footer').removeClass('blurred');
    jQuery('.hamburger').removeClass('is-active');

  });

  jQuery('.navigation').on('click', function (e) {
    if (!jQuery(this).hasClass('active'))
      return;

    // check if we have clicked the navigation itself
    if (jQuery(e.target).parents('#menu-primary-menu').length > 0)
      return;

    jQuery('.navigation, .navigation .main-nav').removeClass('active');
    jQuery('main, footer').removeClass('blurred');
    jQuery('.hamburger').removeClass('is-active');
  });
}

function setOnScrollDownClickedListener() {
  jQuery('.scroll-downs').on('click', function () {
    jQuery('html, body').animate({ scrollTop: jQuery(this).parents('section').next().offset().top - 50 });
  })
}

function setMoreLessFixGrid() {
  // fix less and more 
  $('.team-member .less-more').on('click', function (e) {
    var targetGigante = $('.gigante');
    var element = $(this).parents('.team-member');
    var hadClass = element.find('.member-content').hasClass('open');

    // remove gigante class
    $('.gigante').removeClass('gigante');

    // remove class everywhere
    $('.team-member').find('.member-content').removeClass('open');

    // check if we had the class
    if (!hadClass)
      element.find('.member-content').addClass('open');

    //
    if (!hadClass)
      element.parents('.grid-item').addClass('gigante');

    // if we haven't got the class, just stop :3
    if (hadClass) {
      targetGigante.css({ 'margin-bottom': 0 });

      setTimeout(function () {
        $grid.masonry('layout');
      }, 400);
      return;
    }

    setTimeout(function () {
      element.parents('.gigante').css({ 'margin-bottom': 60 });
      $grid.masonry('layout');
    }, 400);
    $grid.masonry('layout');
  });
}

function gridFetch() {
  var type = $('.project-grid').not('.ignore').length > 0 ? 'projects' : 'nieuws';
  type = ($('.vacature-grid').length > 0) ? 'vacatures' : type

  projectNewsGrid = $('.project-grid').length > 0 ? $('.project-grid') : $('.news-grid');
  projectNewsGrid = ($('.vacature-grid').length > 0) ? $('.vacature-grid') : projectNewsGrid

  if (projectNewsGrid.hasClass('ignore')) {
    return;
  }

  jQuery.ajax({
    url: ajaxurl,
    dataType: 'json',
    data: {
      action: "get_" + type
    },
    success: function (result) {
      // make this dynamic.
      // i want 1 function to handle more grids.
      // add items
      projectNewsGrid.append(result.html);

      // hide loader
      projectNewsGrid.find('.loader').hide();

      // init project grid
      projectNewsGrid = projectNewsGrid.masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer',
        stagger: 30
      });

      projectNewsGrid.imagesLoaded().progress(function () {
        projectNewsGrid.masonry('layout');
      });
    }
  })
}

function setOnImageLoadedGrid() {
  // layout Masonry after each image loads
  $grid.imagesLoaded().progress(function () {
    $grid.masonry('layout');
  });

}

function setDataToggleListener() {
  jQuery('[data-toggle]').on('click', function (e) {
    e.preventDefault();
    var targetToToggle = jQuery(this).data('toggle');
    jQuery(targetToToggle).stop().slideToggle();
  });
}

function filterGrid() {
  var filters = [];
  var grid = projectNewsGrid;

  // map filters
  jQuery('.filters .filter-group').each(function () {
    var element = jQuery(this).find('input, select');
    var targetName = element.attr('name');
    var targets = jQuery('.' + targetName);

    filters.push({
      name: targetName,
      value: element.val().toLowerCase(),
    });

    // show the element again
    jQuery('.grid-item').removeClass('hide');
  });

  // apply filters
  // we loop filters first, because 'and' condition
  for (var i = 0; i < filters.length; i++) {
    var filter = filters[i]; // get current filter

    // loop through grid items that are shown
    jQuery('.grid-item').not('.hide').each(function () {
      var filterTarget = jQuery(this).find("." + filter.name);

      if (filter.value == '') {
        return; // we do not need to filter
      }

      // check if we have a filter target
      if (filterTarget.length == 0) {
        jQuery(this).addClass('hide');
        return;
      }

      // we can check on our condition
      if (filterTarget.text().trim().indexOf(filter.value) < 0) {
        jQuery(this).addClass('hide');
      }
    });
  }

  grid.masonry('layout');
}

function onSvgLoad() {
  jQuery('img.svg').each(function () {
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function (data) {
      // Get the SVG tag, ignore the rest
      var $svg = jQuery(data).find('svg');

      // Add replaced image's ID to the new SVG
      if (typeof imgID !== 'undefined') {
        $svg = $svg.attr('id', imgID);
      }
      // Add replaced image's classes to the new SVG
      if (typeof imgClass !== 'undefined') {
        $svg = $svg.attr('class', imgClass + ' replaced-svg');
      }

      // Remove any invalid XML tags as per http://validator.w3.org
      $svg = $svg.removeAttr('xmlns:a');

      // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
      if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
        $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
      }

      // Replace image with new SVG
      $img.replaceWith($svg);

    }, 'xml');

  });
}

function setOnSearch() {
  jQuery('.launch-search, .btn-search-close').on('click', function (e) {
    e.preventDefault();

    jQuery('.search-screen').toggleClass('active');
  });
}

function onPrepareAnimateables() {
  let i = 0;
  // loop through everything that can be animated.
  jQuery('.ml13, .should-animate').each(function () {
    i++

    // create an id for every item
    jQuery(this).attr('id', `animation-item-${i}`);

    // if we don't have the letter class, we can skip!
    if (!jQuery(this).hasClass('ml13')) {
      return;
    }

    // check if we can just replace everything.
    if (jQuery(this).find('p').length == 0) {
      let html = this.textContent.trim().split(" ");

      html = html.map(text => `<span span class='word' > ${text.replace(/\S/g, "<span class='letter'>$&</span>")}</span > `)

      this.innerHTML = html.join(" ");
      if (jQuery(this).find(".letter").length == 0) {
        jQuery(this).addClass('is-empty');
      }
      return;
    }

    // we loop the p tags, we cant just replace the content itself.
    jQuery(this).find('p').each(function () {
      let html = this.textContent.trim().split(" ");

      html = html.map(text => `<span span class='word' > ${text.replace(/\S/g, "<span class='letter'>$&</span>")}</span > `)

      this.innerHTML = html.join(" ")

      if (jQuery(this).find(".letter").length == 0) {
        jQuery(this).addClass('is-empty');
      }
    })

  })
}

function onPrepareFixWidths() {
  jQuery('.fix-width').removeAttr('style');

  jQuery('.fix-width').each(function () {
    let container = jQuery(this).parents(jQuery(this).data('container'));

    jQuery(this).css({ width: container.width() });
  })
}

function onPrepareFixTranslates() {
  jQuery('.fix-translate').each(function () {
    let container = jQuery(this).parents(jQuery(this).data('translate-container'));

    jQuery(this).css({ top: -jQuery(this).outerHeight() / 2 });

    container.css({ paddingTop: jQuery(this).outerHeight() / 2 });
  })
}

function setOnPrepareAnimations() {
  onPrepareAnimateables();
  onPrepareFixWidths();
  onPrepareFixTranslates();
}

function setOnMovingLetters() {
  inView('.ml13')
    .on('enter', function (element) {
      let delay = jQuery(element).data('delay') || 0;
      let duration = jQuery(element).data('duration') || 1750;
      let isAnimated = jQuery(element).hasClass('is-animating') || jQuery(element).hasClass('is-animated');

      if (isAnimated) { return };

      jQuery(element)
        .addClass('is-animating')
      // we check if we have to delay.
      setTimeout(function () {
        jQuery(element).removeClass('remove__animate');

        jQuery(element).css({ opacity: 1 });
	console.log(anime);
        anime.timeline({ loop: false }).add({
          targets: '#' + jQuery(element).attr('id') + ' .letter',
          translateX: [40, 0],
          translateZ: 0,
          opacity: [0, 1],
          easing: "easeOutExpo",
          duration: duration,
          delay: (el, i) => 500 + 30 * i
        })
        setTimeout(function () {
          jQuery(element)
            .removeClass('is-animating')
            .addClass('is-animated')
        }, duration)

      }, delay);

    });


}

function setOnInnerAnimations() {
  jQuery('[data-inner-animation]').each(function () {
    let targets = jQuery(this).data('inner-animation-on');
    let animations = jQuery(this).data('inner-animation').split("|");
    let selectors = targets != undefined ? targets.split("|") : [];
    let container = jQuery(this);
    let selectorQueries = selectors.map(function (item) {
      return container.find(item);
    })

    for (let index = 0; index < selectorQueries.length; index++) {
      let element = selectorQueries[index];

      element.addClass(animations[index]);
    }

    jQuery(this).find('h2,h3,h4,h5,h6').addClass('ml13');
  })
}

function setOnRecordView() {
  inView('.should-animate')
    .on('enter', function (element) {
      let delay = jQuery(element).data('delay') || 0;

      setTimeout(function () {
        jQuery(element)
          .addClass('animate__animated')
          .removeClass('remove__animate');
      }, delay);
    });
}

function setOnInputFocus() {
  jQuery('.form-control').on('click', function () {
    // check if we want to ignore
    if (jQuery(this).parents('.form-group.ignore').length == 1) return;
    // remove the old focus
    jQuery('.form-control').removeClass('input-focus');
    // add focus to this  
    jQuery(this).addClass('input-focus');
    // focus on the input itself
    jQuery(this).find("input, select").focus();

  })

  jQuery('.form-control input[type=text], .form-control textarea').on('blur', function () {
    if (jQuery(this).parents('.form-group.ignore').length == 1) return;

    // remove the old focus
    jQuery(this).parents('.form-control').removeClass('input-focus');
  });

  jQuery('.form-control input[type=text], .form-control textarea').on('keyup', function () {
    if (jQuery(this).parents('.form-group.ignore').length == 1) return;

    let isFilled = jQuery(this).val() != '';

    if (isFilled) {
      jQuery(this).parents('.form-control').addClass("input-filled");
      return;
    }


    jQuery(this).parents('.form-control').removeClass("input-filled");
  })
}

function initializeInteractiveMaps() {
  jQuery('.map').each(function () {
    let lng = jQuery(this).data('long');
    let lat = jQuery(this).data('lat');
    let mapType = jQuery(this).data('map-type') || 'roadmap';
    let zoom = jQuery(this).data('map-zoom') || 16;
    let id = jQuery(this).attr('id');
    let markers = jQuery(`.marker[data - target="#${id}"]`);

    // The location of Uluru
    let location = { lng: lng, lat: lat };
    // The map, centered at Uluru
    let map = new google.maps.Map(this, {
      zoom: zoom,
      center: location,
      // styles: mapSettingsDefault,
      // controlZoom: false,
      fullscreenControl: false,
      mapTypeControl: false,
      streetViewControl: false,
      mapTypeId: mapType,
    });

    markers.each(function () {
      let markerLocation = { lng: jQuery(this).data('long'), lat: jQuery(this).data('lat') };
      let icon = jQuery(this).data('icon');

      // The marker, positioned at Uluru
      let marker = new google.maps.Marker({
        position: markerLocation,
        map: map,
        icon: icon
      });
    })
  })
}


// Hamburger menu functionaliteit
// verander onderstaande classes van is-active naar active om weer op te pakken (werkt niet lekker nog), hamburger class naar is-active
jQuery(".hamburger").each(function (i, e) {
  var hamburger = jQuery(e);

  hamburger.on("click", function () {
    jQuery("header").toggleClass('is-active');
    jQuery('.main-nav').toggleClass("active");
    jQuery('nav').toggleClass("active");
    jQuery('main').toggleClass("blurred");
    jQuery('footer').toggleClass("blurred");
  });
});

function wrapIframe() {
  $(".content-block iframe, .intro-content iframe").wrap("<div class='embed-container'></div>");
}

function isMobile() {
  return 768 > jQuery(window).outerWidth();
}