! function(b) {
  function c() {
    b(".potter-menu-item-search").hasClass("active") && (b(".potter-menu-search").stop().animate({
      opacity: "0",
      width: "0px"
    }, 250, function() {
      b(this).css({
        display: "none"
      })
    }), setTimeout(function() {
      b(".potter-menu-item-search").removeClass("active").attr("aria-expanded", "false")
    }, 400))
  }

  function d() {
    b("body").hasClass("using-mouse") || b("#navigation > ul").hasClass("potter-sub-menu") && (b(".menu-item-has-children").removeClass("potter-sub-menu-focus"), b(this).parents(".menu-item-has-children").addClass("potter-sub-menu-focus"))
  }
  if (b(".menu-item-has-children").each(function() {
      b(this).attr("aria-haspopup", "true")
    }), b(".scrolltop").length) {
    var h = b(".scrolltop").attr("data-scrolltop-value");
    b(window).scroll(function() {
      b(this).scrollTop() > h ? b(".scrolltop").fadeIn() : b(".scrolltop").fadeOut()
    });
    b(".scrolltop").click(function() {
      b("body").attr("tabindex", "-1").focus();
      b(this).blur();
      b("body, html").animate({
        scrollTop: 0
      }, 500)
    })
  }
  b(".potter-menu-item-search").click(function(d) {
    d.stopPropagation();
    b(".potter-navigation .potter-menu > li").slice(-3).addClass("calculate-width");
    var c = 0;
    if (b(".calculate-width").each(function() {
        c += b(this).outerWidth()
      }), 200 > c) c = 250;
    b(this).hasClass("active") || (b(this).addClass("active").attr("aria-expanded", "true"), b(".potter-menu-search", this).stop().css({
      display: "block"
    }).animate({
      width: c,
      opacity: "1"
    }, 200), b("input[type=search]", this).val("").focus())
  });
  b(window).click(function() {
    c()
  });
  b(document).keyup(function(b) {
    27 === b.keyCode && c()
  });
  b(".wpcf7-form-control-wrap").hover(function() {
    b(".wpcf7-not-valid-tip", this).fadeOut()
  });
  var e = b(".potter-navigation").data("sub-menu-animation-duration");
  b(".potter-sub-menu-animation-fade > .menu-item-has-children").hover(function() {
    b(".sub-menu", this).first().stop().fadeIn(e)
  }, function() {
    b(".sub-menu", this).first().stop().fadeOut(e)
  });
  b(".potter-sub-menu > .menu-item-has-children:not(.potter-mega-menu) .menu-item-has-children").hover(function() {
    b(".sub-menu", this).first().stop().css({
      display: "block"
    }).animate({
      opacity: "1"
    }, e)
  }, function() {
    b(".sub-menu", this).first().stop().animate({
      opacity: "0"
    }, e, function() {
      b(this).css({
        display: "none"
      })
    })
  });
  b(window).load(function() {
    b(".opacity").delay(200).animate({
        opacity: "1"
      },
      200);
    b(".display-none").show();
    b(window).trigger("resize");
    b(window).trigger("scroll")
  });
  var g = b(".potter-page").css("margin-top");
  if (b(window).resize(function() {
      b(".potter-page").width() >= b(window).width() ? b(".potter-page").css({
        "margin-top": "0",
        "margin-bottom": "0"
      }) : b(".potter-page").css({
        "margin-top": g,
        "margin-bottom": g
      })
    }), b(".potter-menu-centered").length) {
    var f = b(".potter-navigation .potter-menu > li > a").length / 2,
      f = (f = Math.floor(f)) - 1;
    b(".potter-menu-centered .logo-container").insertAfter(".potter-navigation .potter-menu >li:eq(" +
      f + ")").css({
      display: "block"
    })
  }
  b("body").mousedown(function() {
    b(this).addClass("using-mouse");
    b(".menu-item-has-children").removeClass("potter-sub-menu-focus")
  });
  b("body").keydown(function() {
    b(this).removeClass("using-mouse")
  });
  b(".potter-menu-container #navigation a").on("focus", d);
  b(".potter-menu-container #navigation a").on("blur", d)
}(jQuery);
jQuery(document).ready(function() {
  var b = jQuery("#main-navbar");
  if (b.length) var c = b.offset().top;
  var d = function() {
    jQuery(window).scrollTop() > c ? (jQuery(".regular-header-style #main-navbar").addClass("stickynav"), jQuery(".site-logo").addClass("hide-on-sticky")) : (jQuery(".regular-header-style #main-navbar").removeClass("stickynav"), jQuery(".site-logo").removeClass("hide-on-sticky"))
  };
  d();
  b = jQuery("#header").height();
  jQuery(window).scroll(function() {
    d();
    jQuery("#header").css("min-height", b + "px")
  })
});
jQuery(document).ready(function() {
  a = jQuery("#menu-left .menu-item").height();
  jQuery(".potter-split-menu").css("min-height", a + "px")
});

jQuery('body').on('click', '#offminicartbtn', function () {
  jQuery("#offcanvas-mincart").toggleClass("offminicart-visible");
  });

jQuery("#offcanvas-mincart .potter-close").click(function() {
  jQuery("#offcanvas-mincart").toggleClass("offminicart-visible");
});

jQuery("#potter-menu-toggle").click(function() {
  jQuery(".potter-menu-off-canvas").toggleClass("canvas-visible");
  jQuery(this).toggleClass("canvas-close-nav");
  jQuery(".potter-menu-overlay").toggleClass("menu-overlay-visible")
});
jQuery(".potter-menu-off-canvas .potter-close").click(function() {
  jQuery(".potter-menu-off-canvas").toggleClass("canvas-visible");
  jQuery("#potter-menu-toggle").toggleClass("canvas-close-nav");
  jQuery(".potter-menu-overlay").toggleClass("menu-overlay-visible")
});
