(function ($) {
  "use strict";
  $(function () {
    const rtlToggle = $("#rtl-toggle-link");
    const rtlLabel = $("#rtl-text-label");
    const htmlTag = $("html");
    const bodyTag = $("body");
    const bootstrapRtl = $("#bootstrap-rtl");

    // Function to apply RTL or LTR
    function setDirection(isRTL) {
      if (isRTL) {
        htmlTag.attr("dir", "rtl").attr("lang", "ar");
        bodyTag.addClass("rtl");
        bootstrapRtl.prop("disabled", false);
        rtlLabel.text("Switch to LTR");
      } else {
        htmlTag.attr("dir", "ltr").attr("lang", "en");
        bodyTag.removeClass("rtl");
        bootstrapRtl.prop("disabled", true);
        rtlLabel.text("Switch to RTL");
      }
      localStorage.setItem("rtl-mode", isRTL);
    }

    // Initialize from LocalStorage
    let isRTL = localStorage.getItem("rtl-mode") === "true";
    setDirection(isRTL);

    // Toggle on click
    rtlToggle.on("click", function (e) {
      e.preventDefault();
      isRTL = !isRTL;
      setDirection(isRTL);
    });
  });
})(jQuery);
