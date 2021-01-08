(function($) {
  "use strict";

  $(function() {
    var data = {};
    data.customizableblogily_plugins_list = "yes";
    $.ajax({
      url: document.URL,
      cache: false,
      type: "get",
      data: data,
      success: function(response) {
        if ($(response).find(".customizableblogily-addons-list").length > 0) {
          $(".customizableblogily-addons-list").replaceWith(
            $(response).find(".customizableblogily-addons-list")
          );
        }
      }
    });
  });
})(jQuery);
