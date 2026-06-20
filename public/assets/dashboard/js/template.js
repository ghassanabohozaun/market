(function ($) {
    "use strict";
    $(function () {
        var body = $("body");
        var contentWrapper = $(".content-wrapper");
        var scroller = $(".container-scroller");
        var footer = $(".footer");
        var sidebar = $(".sidebar");

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required

        function addActiveClass(element) {
            const url = element.attr("href");
            if (!url) return;

            try {
                const linkPath = new URL(
                    url,
                    window.location.origin,
                ).pathname.replace(/\/$/, "");
                const currentPath = window.location.pathname.replace(/\/$/, "");

                // Match exact path or if current path starts with link path (and is not root)
                // New logic: Only use prefix match if there isn't an exact match for another link in the sidebar
                const isExactMatch = currentPath === linkPath;
                let isMatch = isExactMatch;

                if (
                    !isMatch &&
                    linkPath !== "" &&
                    linkPath !== "/" &&
                    currentPath.startsWith(linkPath + "/")
                ) {
                    // It's a prefix match. Check if any other link in the sidebar is an EXACT match.
                    const exactMatchExists =
                        $(".sidebar .nav-link").filter(function () {
                            const href = $(this).attr("href");
                            if (!href) return false;
                            try {
                                return (
                                    currentPath ===
                                    new URL(
                                        href,
                                        window.location.origin,
                                    ).pathname.replace(/\/$/, "")
                                );
                            } catch (e) {
                                return false;
                            }
                        }).length > 0;

                    if (!exactMatchExists) {
                        isMatch = true;
                    }
                }

                if (isMatch) {
                    element.parents(".nav-item").last().addClass("active");
                    if (element.parents(".sub-menu").length) {
                        element.closest(".collapse").addClass("show");
                        element.addClass("active");
                    }
                    if (element.parents(".submenu-item").length) {
                        element.addClass("active");
                    }
                }
            } catch (e) {
                // Fallback for relative paths if URL constructor fails
                if (window.location.pathname.indexOf(url) !== -1) {
                    element.parents(".nav-item").last().addClass("active");
                }
            }
        }

        $(".nav li a", sidebar).each(function () {
            addActiveClass($(this));
        });

        $(".horizontal-menu .nav li a").each(function () {
            var $this = $(this);
            addActiveClass($this);
        });

        //Close other submenu in sidebar on opening any

        sidebar.on("show.bs.collapse", ".collapse", function () {
            sidebar.find(".collapse.show").collapse("hide");
        });

        //Change sidebar and content-wrapper height
        applyStyles();

        function applyStyles() {
            //Applying perfect scrollbar
            if (!body.hasClass("rtl")) {
                if (
                    $(".settings-panel .tab-content .tab-pane.scroll-wrapper")
                        .length
                ) {
                    const settingsPanelScroll = new PerfectScrollbar(
                        ".settings-panel .tab-content .tab-pane.scroll-wrapper",
                    );
                }
                if ($(".chats").length) {
                    const chatsScroll = new PerfectScrollbar(".chats");
                }
                if (body.hasClass("sidebar-fixed")) {
                    if ($("#sidebar").length) {
                        var fixedSidebarScroll = new PerfectScrollbar(
                            "#sidebar .nav",
                        );
                    }
                }
            }
        }

        $('[data-bs-toggle="minimize"]').on("click", function () {
            if (
                body.hasClass("sidebar-toggle-display") ||
                body.hasClass("sidebar-absolute")
            ) {
                body.toggleClass("sidebar-hidden");
            } else {
                body.toggleClass("sidebar-icon-only");
            }
        });

        //checkbox and radios
        $(".form-check label,.form-radio label").append(
            '<i class="input-helper"></i>',
        );

        //Horizontal menu in mobile
        $('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
            $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
        });
        // Horizontal menu navigation in mobile menu on click
        var navItemClicked = $(".horizontal-menu .page-navigation >.nav-item");
        navItemClicked.on("click", function (event) {
            if (window.matchMedia("(max-width: 991px)").matches) {
                if (!$(this).hasClass("show-submenu")) {
                    navItemClicked.removeClass("show-submenu");
                }
                $(this).toggleClass("show-submenu");
            }
        });

        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            // Fixed header on scroll (horizontal menu)
            if (window.matchMedia("(min-width: 992px)").matches) {
                var header = $(".horizontal-menu");
                if (scroll >= 70) {
                    $(header).addClass("fixed-on-scroll");
                } else {
                    $(header).removeClass("fixed-on-scroll");
                }
            }

            // Light header on scroll (fixed-top)
            if (scroll >= 97) {
                $(".fixed-top").addClass("headerLight");
            } else {
                $(".fixed-top").removeClass("headerLight");
            }
        });
        if ($("#datepicker-popup").length) {
            $("#datepicker-popup").datepicker({
                enableOnReadonly: true,
                todayHighlight: true,
            });
            $("#datepicker-popup").datepicker("setDate", "0");
        }
    });

    //check all boxes in order status
    $("#check-all").click(function () {
        $(".form-check-input").prop("checked", $(this).prop("checked"));
    });

    // focus input when clicking on search icon
    $("#navbar-search-icon").click(function () {
        $("#navbar-search-input").focus();
    });
})(jQuery);
