/*
 * Theme Name: customizable Lite
 */

/*----------------------------------------------------
/* Responsive Navigation
/*--------------------------------------------------*/
jQuery(document)
  .ready(function($) {
    $(".primary-navigation").append('<div id="mobile-menu-overlay" />');

    $(".toggle-mobile-menu").on("click focus", function(e) {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();
      clearTimeout(awaitMenu);
      awaitMenu = setTimeout(function() {
        toggleMobileMenu();
      }, 200);
    });

    $("#accessibility-close-mobile-menu").focusin(e => {
      jQuery("body").removeClass("mobile-menu-active");
      jQuery("html").removeClass("noscroll");
      jQuery("#mobile-menu-overlay").fadeOut();
    });

    var awaitMenu;
    function toggleMobileMenu() {
      $("body").toggleClass("mobile-menu-active");

      if ($("body").hasClass("mobile-menu-active")) {
        if ($(document).height() > $(window).height()) {
          var scrollTop = $("html").scrollTop()
            ? $("html").scrollTop()
            : $("body").scrollTop();
          $("html")
            .addClass("noscroll")
            .css("top", -scrollTop);
        }
        $("#mobile-menu-overlay").fadeIn();
      } else {
        var scrollTop = parseInt($("html").css("top"));
        $("html").removeClass("noscroll");
        $("html,body").scrollTop(-scrollTop);
        $("#mobile-menu-overlay").fadeOut();
      }
    }
  })
  .on("click", function(event) {
    var $target = jQuery(event.target);
    if (
      ($target.hasClass("customizable-icon") &&
        $target.parent().hasClass("toggle-caret")) ||
      $target.hasClass("toggle-caret")
    ) {
      // allow clicking on menu toggles
      return;
    }
    jQuery("body").removeClass("mobile-menu-active");
    jQuery("html").removeClass("noscroll");
    jQuery("#mobile-menu-overlay").fadeOut();
  });

/*----------------------------------------------------
/*  Dropdown menu
/* ------------------------------------------------- */
jQuery(document).ready(function($) {
  function customizableblogilyDropdownMenu() {
    var wWidth = $(window).width();
    if (wWidth > 865) {
      $("#navigation ul.sub-menu, #navigation ul.children").hide();
      var timer;
      var delay = 100;
      $("#navigation li").hover(
        function() {
          var $this = $(this);
          timer = setTimeout(function() {
            $this.children("ul.sub-menu, ul.children").slideDown("fast");
          }, delay);
        },
        function() {
          $(this)
            .children("ul.sub-menu, ul.children")
            .hide();
          clearTimeout(timer);
        }
      );
    } else {
      $("#navigation li").unbind("hover");
      $(
        "#navigation li.active > ul.sub-menu, #navigation li.active > ul.children"
      ).show();
    }
  }

  customizableblogilyDropdownMenu();

  $(window).resize(function() {
    customizableblogilyDropdownMenu();
  });
});

/*---------------------------------------------------
/*  Vertical menus toggles
/* -------------------------------------------------*/
jQuery(document).ready(function($) {
  $(".widget_nav_menu, #navigation .menu").addClass("toggle-menu");
  $(".toggle-menu ul.sub-menu, .toggle-menu ul.children").addClass(
    "toggle-submenu"
  );
  $(".toggle-menu ul.sub-menu")
    .parent()
    .addClass("toggle-menu-item-parent");

  $(".toggle-menu .toggle-menu-item-parent").append(
    '<span class="toggle-caret"><i class="customizable-icon icon-plus"></i></span>'
  );

  $(".toggle-caret").click(function(e) {
    e.preventDefault();
    $(this)
      .parent()
      .toggleClass("active")
      .children(".toggle-submenu")
      .slideToggle("fast");
  });
});

/*----------------------------------------------------
/* Back to top smooth scrolling
/*--------------------------------------------------*/
jQuery(document).ready(function($) {
  jQuery("a[href=#top]").click(function() {
    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});
