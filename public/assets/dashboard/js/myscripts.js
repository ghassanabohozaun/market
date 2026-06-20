/*
 * Custom Dashboard Scripts
 * All new custom scripts for the dashboard should be added to this file
 * instead of being added inline to the layout file.
 */

(function ($) {
    "use strict";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // --- Generic Delete Handler ---
    $(document).on("click", ".delete-confirm, .js-delete-btn", function (e) {
        e.preventDefault();
        const button = $(this);
        const id = button.data("id");
        const route = button.data("url") || button.data("route");

        const title =
            button.data("title") ||
            (window.Translations
                ? window.Translations.ask_delete_record
                : "Are you sure?");
        const text =
            button.data("text") ||
            (window.Translations
                ? window.Translations.delete_warning_text
                : "");

        Swal.fire({
            title: title,
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: window.Translations
                ? window.Translations.yes_delete_it
                : "Yes",
            cancelButtonText: window.Translations
                ? window.Translations.no_cancel
                : "No",
            reverseButtons: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: route,
                    data: { id: id },
                    success: function (data) {
                        if (data.status) {
                            Swal.fire({
                                title: window.Translations
                                    ? window.Translations.deleted
                                    : "Deleted!",
                                text: window.Translations
                                    ? window.Translations.delete_success_message
                                    : "",
                                icon: "success",
                                confirmButtonText: window.Translations
                                    ? window.Translations.ok
                                    : "OK",
                            }).then(() => {
                                const table = button.closest("table");
                                if (
                                    table.length &&
                                    table.hasClass("js-sliders-table")
                                ) {
                                    $(table).load(
                                        location.href +
                                            " ." +
                                            table
                                                .attr("class")
                                                .split(" ")
                                                .join("."),
                                    );
                                } else {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: window.Translations
                                    ? window.Translations.error
                                    : "Error!",
                                text:
                                    data.message ||
                                    (window.Translations
                                        ? window.Translations
                                              .delete_error_message
                                        : ""),
                                icon: "error",
                                confirmButtonText: window.Translations
                                    ? window.Translations.ok
                                    : "OK",
                            });
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = window.Translations
                            ? window.Translations.delete_error_message
                            : "Something went wrong!";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: window.Translations
                                ? window.Translations.error
                                : "Error!",
                            text: errorMessage,
                            icon: "error",
                            confirmButtonText: window.Translations
                                ? window.Translations.ok
                                : "OK",
                        });
                    },
                });
            }
        });
    });
    // --- Generic Helpers ---

    /**
     * Clear validation errors from a form
     */
    window.clearFormErrors = function (formSelector) {
        const form = $(formSelector);
        form.find("input, select, textarea").removeClass("is-invalid");
        form.find(".input-group-premium").removeClass("is-invalid");
        form.find("strong.text-danger").text("");

        // Remove error state from HUD if exists
        form.find(".hud-pulse-orb").removeClass("has-errors");
    };

    /**
     * Display validation errors in a form
     */
    window.showValidationErrors = function (formSelector, errors, suffix = "") {
        const form = $(formSelector);
        $.each(errors, function (key, value) {
            const fieldId = key.replace(/\./g, "_") + suffix;
            const errorId = key.replace(/\./g, "_") + "_error" + suffix;
            const $field = $(`#${fieldId}`);
            $field.addClass("is-invalid");
            $field.closest(".input-group-premium").addClass("is-invalid");
            $(`#${errorId}`).text(value[0]);
        });

        // Trigger red glow on HUD orb
        form.find(".hud-pulse-orb").addClass("has-errors");

        // Ensure HUD is visible if it exists
        const hud = form.find(".command-hud-wrapper");
        if (hud.length) {
            hud.addClass("visible");
        }
    };

    /**
     * Standard Flag + Text formatter for Select2
     */
    window.formatSelect2Country = function (country) {
        if (!country.id) {
            return country.text;
        }

        var flagCode = "";
        if (country.flag_code) {
            flagCode = country.flag_code.toLowerCase();
        } else if (country.element && $(country.element).data("flag-code")) {
            flagCode = $(country.element).data("flag-code").toLowerCase();
        }

        if (flagCode) {
            var $country = $(
                '<span class="d-flex align-items-center"><span class="flag-icon flag-icon-' +
                    flagCode +
                    ' me-2 shadow-sm rounded-1" style="width: 22px; height: 16px;"></span>' +
                    '<span class="select2-text">' +
                    country.text +
                    "</span></span>",
            );
            return $country;
        }

        return country.text;
    };

    /**
     * Global Status Change Handler
     * Used on checkbox/switch elements with .js-status-change class
     */
    $(document).on("change", ".js-status-change", function () {
        const checkbox = $(this);
        const id = checkbox.data("id");
        const url = checkbox.data("url");
        const badgePrefix = checkbox.data("badge-prefix"); // e.g., 'admin_status_'
        const statusSwitch = this.checked ? 1 : 0;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                statusSwitch: statusSwitch,
            },
            success: function (data) {
                if (data.status === true) {
                    if (badgePrefix) {
                        const statusBadge = $("." + badgePrefix + id);
                        const hasOpacity =
                            statusBadge.hasClass("badge-opacity-success") ||
                            statusBadge.hasClass("badge-opacity-danger");
                        const iconHtml =
                            statusBadge.find("i").prop("outerHTML") || "";

                        statusBadge.empty();
                        // Make sure to remove any existing classes first
                        statusBadge.removeClass(
                            "badge-pill-danger badge-pill-success badge-opacity-success badge-opacity-danger bg-success bg-danger",
                        );

                        if (data.data.status == 1) {
                            statusBadge.addClass(
                                hasOpacity
                                    ? "badge-opacity-success"
                                    : "badge-pill-success",
                            );
                            
                            // Swap icons if present
                            let currentIconHtml = iconHtml;
                            if (currentIconHtml.includes('mdi-close-circle-outline')) {
                                currentIconHtml = currentIconHtml.replace('mdi-close-circle-outline', 'mdi-check-circle-outline');
                            }

                            const label =
                                (window.Translations.labels &&
                                    window.Translations.labels.active) ||
                                window.Translations.labels.enabled ||
                                "Active";
                            statusBadge.html(
                                currentIconHtml + (currentIconHtml ? " " : "") + label,
                            );
                        } else {
                            statusBadge.addClass(
                                hasOpacity
                                    ? "badge-opacity-danger"
                                    : "badge-pill-danger",
                            );

                            // Swap icons if present
                            let currentIconHtml = iconHtml;
                            if (currentIconHtml.includes('mdi-check-circle-outline')) {
                                currentIconHtml = currentIconHtml.replace('mdi-check-circle-outline', 'mdi-close-circle-outline');
                            }

                            const label =
                                (window.Translations.labels &&
                                    window.Translations.labels.inactive) ||
                                window.Translations.labels.disabled ||
                                "Inactive";
                            statusBadge.html(
                                currentIconHtml + (currentIconHtml ? " " : "") + label,
                            );
                        }
                    }

                    if (typeof flasher !== "undefined") {
                        flasher.success(
                            window.Translations.messages.status_updated,
                            window.Translations.messages.success || "Success"
                        );
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: window.Translations.messages.status_updated,
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }
                } else {
                    checkbox.prop("checked", !checkbox.is(":checked"));
                    Swal.fire({
                        icon: "error",
                        title: window.Translations.messages.status_failed,
                        customClass: { title: "fs-6" },
                    });
                }
            },
            error: function () {
                checkbox.prop("checked", !checkbox.is(":checked"));
                Swal.fire({
                    icon: "error",
                    title: window.Translations.messages.status_failed,
                    customClass: { title: "fs-6" },
                });
            },
        });
    });

    /**
     * Specialized Status Change Handler for Mailing Module
     * Handles string-based statuses like 'new' and 'contacted'
     */
    $(document).on("change", ".js-mailing-status-change", function () {
        const checkbox = $(this);
        const id = checkbox.data("id");
        const url = checkbox.data("url");
        const badgePrefix = checkbox.data("badge-prefix");

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                if (data.status === true) {
                    if (badgePrefix) {
                        const statusBadge = $("." + badgePrefix + id);
                        statusBadge.removeClass(
                            "new contacted badge-pill-danger badge-pill-success bg-success bg-danger",
                        );

                        // Use server-provided labels and classes
                        const label =
                            data.data.status_label || data.data.status;
                        const statusValue = data.data.status; // 'new' or 'contacted'

                        statusBadge.addClass(statusValue).text(label);
                    }

                    if (typeof flasher !== "undefined") {
                        flasher.success(
                            window.Translations.messages.status_updated,
                            window.Translations.messages.success || "Success"
                        );
                    }
                } else {
                    checkbox.prop("checked", !checkbox.is(":checked"));
                    Swal.fire({
                        icon: "error",
                        title: window.Translations.messages.status_failed,
                        customClass: { title: "fs-6" },
                    });
                }
            },
            error: function () {
                checkbox.prop("checked", !checkbox.is(":checked"));
                Swal.fire({
                    icon: "error",
                    title: window.Translations.messages.status_failed,
                    customClass: { title: "fs-6" },
                });
            },
        });
    });
    /**
     * Generic Modal Population Handler
     * Populates form fields from data-* attributes of a clicked button
     */
    window.populateModal = function (buttonSelector, options = {}) {
        $(document).on("click", buttonSelector, function () {
            const btn = $(this);
            const settings = $.extend(
                {
                    modal: null, // Selector for the modal to show
                    form: null, // Selector for the form to populate
                    actionUrl: null, // URL for form action, can contain :id
                    idKey: "id", // The data key for the ID (default 'id')
                    suffix: "", // Suffix for field IDs (e.g., '_edit')
                    onBeforePopulate: null,
                    onAfterPopulate: null,
                    previews: {}, // Mapping of data keys to preview selectors/HTML
                },
                options,
            );

            const data = btn.data();
            const form = $(settings.form);

            if (typeof settings.onBeforePopulate === "function") {
                settings.onBeforePopulate(btn, data);
            }

            // 1. Handle Form Action dynamic replacement
            if (settings.actionUrl && data[settings.idKey]) {
                const url = settings.actionUrl.replace(
                    ":id",
                    data[settings.idKey],
                );
                form.attr("action", url);
            }

            // 2. Map data attributes to fields
            $.each(data, function (key, value) {
                // jQuery .data() converts data-title-ar to titleAr
                // We convert titleAr back to title_ar for matching
                const underscoredKey = key
                    .replace(/([A-Z])/g, "_$1")
                    .toLowerCase();

                // Strategy 1: Find by ID (common pattern: #field_name_edit)
                let field = form.find(`#${underscoredKey}${settings.suffix}`);

                // Strategy 2: Find by Name (standard form pattern)
                if (!field.length) {
                    field = form.find(`[name="${underscoredKey}"]`);
                }

                if (field.length) {
                    if (field.is(":checkbox")) {
                        // Handles single status switches
                        field.prop("checked", value == 1 || value == true);
                    } else if (field.attr("type") === "radio") {
                        // Handles radio groups (e.g., Active/Inactive pairs)
                        const name = field.attr("name");
                        form.find(
                            `input[name="${name}"][value="${value}"]`,
                        ).prop("checked", true);
                    } else if (field.is("select")) {
                        field.val(value).trigger("change");
                    } else if (field.attr("type") !== "file") {
                        // Security: Do NOT try to set value on file inputs
                        field.val(value);
                    }
                }

                // 3. Handle specific previews defined in options
                if (settings.previews[key]) {
                    const previewContainer = $(settings.previews[key]);
                    const previewValue =
                        typeof settings.previews[key] === "function"
                            ? settings.previews[key](value, data)
                            : value;

                    if (
                        previewValue &&
                        previewValue !== "" &&
                        previewValue !== "null"
                    ) {
                        if (typeof settings.previews[key] === "function") {
                            previewContainer.html(previewValue);
                        } else {
                            // Preserve buttons when populating preview
                            previewContainer.find("img, .text-center").remove();
                            previewContainer.prepend(
                                `<img src="${previewValue}" style="width: 100%; height: 100%; object-fit: cover;">`,
                            );
                        }
                    } else {
                        // Fallback/Reset preview if value is empty/null
                        const originalHtml =
                            previewContainer.data("original-html");
                        if (originalHtml) {
                            previewContainer.html(originalHtml);
                        }
                    }
                }
            });

            if (typeof settings.onAfterPopulate === "function") {
                settings.onAfterPopulate(btn, data, form);
            }

            if (settings.modal) {
                $(settings.modal).modal("show");
            }
        });
    };
    /**
     * Generic Index Table Handler
     * Handles AJAX Pagination, Loading States, and Responsive Details Modals
     */
    window.initIndexTable = function (options = {}) {
        const settings = $.extend(
            {
                container: "#table_data",
                loader: ".table-loader-overlay",
                pagination: ".pagination a",
                detailsControl: ".details-control",
                detailsModal: "#detailsModal",
                detailsModalLabel: "#detailsModalLabel",
                detailsModalBody: "#modalBody",
                url: window.location.pathname,
                onSuccess: null,
            },
            options,
        );

        const $loader = $(settings.loader);

        // 1. AJAX Pagination Handler
        $(document).on("click", settings.pagination, function (e) {
            e.preventDefault();
            const href = $(this).attr("href");
            if (!href || href === "#") return;

            const urlObj = new URL(href, window.location.origin);
            const page = urlObj.searchParams.get("page");

            $.ajax({
                url: href,
                beforeSend: function () {
                    $loader.addClass("active");
                    $(settings.container).css("opacity", "0.6");
                },
                success: function (data) {
                    $(settings.container).html(data);
                    $(settings.container).css("opacity", "1");
                    $loader.removeClass("active");

                    // Update URL without refresh
                    const newUrl = window.location.pathname + "?page=" + page;
                    window.history.pushState({ page: page }, "", newUrl);

                    if (typeof settings.onSuccess === "function") {
                        settings.onSuccess(data);
                    }
                },
                error: function () {
                    $(settings.container).css("opacity", "1");
                    $loader.removeClass("active");
                    if (typeof flasher !== "undefined") {
                        flasher.error("Something went wrong!", window.Translations && window.Translations.messages && window.Translations.messages.error ? window.Translations.messages.error : "Error");
                    }
                },
            });
        });

        // 2. Responsive Details Modal (Local extraction from row)
        $(document).on("click", settings.detailsControl, function (e) {
            const btn = $(this);
            const row = btn.closest("tr");
            const table = row.closest("table");
            const modalElement = document.querySelector(settings.detailsModal);

            if (!modalElement) return;

            const detailsModal =
                bootstrap.Modal.getInstance(modalElement) ||
                new bootstrap.Modal(modalElement);

            const headers = Array.from(table.find("thead th")).map((th) =>
                $(th).text().trim(),
            );
            const cells = Array.from(row.find("td"));

            const rowDetailsHTML = row.find(".row-details").html();
            let html = "";

            if (rowDetailsHTML && rowDetailsHTML.trim() !== "") {
                html = rowDetailsHTML;
            } else {
                html = '<ul class="list-group list-group-flush">';
                for (let i = 1; i < headers.length - 1; i++) {
                    if (headers[i] && headers[i] !== "") {
                        const cellContent = $(cells[i]).html();
                        const isComplex =
                            cellContent.includes("premium-tag") ||
                            cellContent.includes("permission-tags-wrapper") ||
                            cellContent.includes("<img") ||
                            cellContent.includes("badge");

                        if (isComplex) {
                            html += `
                            <li class="list-group-item border-0 px-0 pb-3">
                                <div class="mb-2 text-muted fw-bold small text-uppercase" style="letter-spacing: 0.5px;">${headers[i]}</div>
                                <div class="ps-1">${cellContent}</div>
                            </li>`;
                        } else {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3 border-bottom-dashed">
                                <strong class="text-muted small text-uppercase" style="letter-spacing: 0.5px;">${headers[i]}</strong>
                                <span class="text-end fw-bold text-dark">${cellContent}</span>
                            </li>`;
                        }
                    }
                }
                html += "</ul>";
            }

            let customTitle = btn.data("title");
            if (!customTitle) {
                customTitle = $(cells[2]).text().trim(); // Fallback for older tables
            }

            const titleText =
                (window.Translations
                    ? window.Translations.details
                    : "Details") + (customTitle ? " - " + customTitle : "");

            $(settings.detailsModalLabel).text(titleText);
            $(settings.detailsModalBody).html(html);

            detailsModal.show();
        });

        // Handle browser back/forward buttons
        window.onpopstate = function (event) {
            const page =
                event.state && event.state.page
                    ? event.state.page
                    : new URLSearchParams(window.location.search).get("page") ||
                      1;

            $.ajax({
                url: settings.url + "?page=" + page,
                success: function (data) {
                    $(settings.container).html(data);
                },
            });
        };
    };
    $(document).on("change", ".js-image-preview", function () {
        const input = this;
        const previewSelector = $(this).data("preview");
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const $preview = $(previewSelector);
                // Remove existing image or placeholder, but preserve our premium buttons
                $preview.find("img, .text-center").remove();
                $preview.prepend(
                    '<img src="' +
                        e.target.result +
                        '" style="width: 100%; height: 100%; object-fit: contain; background-color: #f8f9fa;">',
                );
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    /**
     * Generic AJAX form submission handler
     */
    window.handleFormSubmit = function (formSelector, options = {}) {
        const form = $(formSelector);

        form.on("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            const settings = $.extend(
                {
                    url: form.attr("action"),
                    method: form.attr("method") || "POST",
                    spinner: ".spinner_loading",
                    tableToLoad: "#responsiveTable",
                    modalToHide: null,
                    successMessage: window.Translations
                        ? window.Translations.success
                        : "Success",
                    suffix: "",
                    onSuccess: null,
                    onError: null,
                    onComplete: null,
                    resetForm: true,
                },
                options,
            );

            const requestUrl =
                typeof settings.url === "function"
                    ? settings.url(form)
                    : settings.url;

            $.ajax({
                url: requestUrl,
                type: settings.method,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    window.clearFormErrors(formSelector);
                    $(settings.spinner).removeClass("d-none");
                },
                success: function (data) {
                    if (data.status) {
                        if (settings.tableToLoad) {
                            $(settings.tableToLoad).load(
                                location.href + " " + settings.tableToLoad,
                            );
                        }
                        if (settings.modalToHide) {
                            $(settings.modalToHide).modal("hide");
                        }
                        if (typeof flasher !== "undefined") {
                            flasher.success(settings.successMessage, window.Translations && window.Translations.messages && window.Translations.messages.success ? window.Translations.messages.success : "Success");
                        }
                        if (typeof settings.onSuccess === "function") {
                            settings.onSuccess(data);
                        }

                        if (settings.resetForm) {
                            form[0].reset();
                            // Clear Select2 visually
                            if ($.fn.select2) {
                                form.find("select").val(null).trigger("change");
                            }
                            // Clear Summernote visually
                            if ($.fn.summernote) {
                                form.find(".summernote").summernote("reset");
                            }
                        }

                        // Added: Global HUD Reset after success (Moved after resetForm)
                        if (
                            window.activeHud &&
                            typeof window.activeHud.reset === "function"
                        ) {
                            window.activeHud.reset();
                        }
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        window.showValidationErrors(
                            formSelector,
                            errors,
                            settings.suffix,
                        );
                    }
                    if (typeof settings.onError === "function") {
                        settings.onError(xhr);
                    }
                },
                complete: function () {
                    $(settings.spinner).addClass("d-none");
                    if (typeof settings.onComplete === "function") {
                        settings.onComplete();
                    }
                },
            });
        });
    };

    /*
     * Custom File Input - Translate browser-native "No file chosen" / "Choose file"
     * Wraps every <input type="file"> that has NOT been explicitly excluded,
     * replacing the native UI with a styled version showing translated labels.
     */
    function initCustomFileInputs() {
        var chooseLabel =
            (window.Translations && window.Translations.choose_file) ||
            "Choose File";
        var noFileLabel =
            (window.Translations && window.Translations.no_file_chosen) ||
            "No file chosen";

        $('input[type="file"]')
            .not(".custom-file-initialized")
            .each(function () {
                var $input = $(this);
                $input.addClass("custom-file-initialized");

                // Hide the native input, keep it in DOM for form submission
                $input.css({
                    position: "absolute",
                    opacity: 0,
                    width: "0.1px",
                    height: "0.1px",
                    overflow: "hidden",
                });

                // Build the custom wrapper using label[for] for native click & perfect alignment
                var inputId =
                    $input.attr("id") ||
                    "cfi-" + Math.random().toString(36).substr(2, 8);
                $input.attr("id", inputId);

                var $lbl = $(
                    '<label for="' +
                        inputId +
                        '" class="btn btn-sm btn-outline-secondary flex-shrink-0 mb-0" style="font-size:0.78rem; cursor:pointer;"><i class="mdi mdi-folder-open-outline me-1"></i>' +
                        chooseLabel +
                        "</label>",
                );
                var $name = $(
                    '<span class="custom-file-name text-muted text-truncate" style="flex:1; min-width:0; font-size:0.82rem; display:flex; align-items:center; margin-top:-2px;"></span>',
                ).text(noFileLabel);
                var $wrapper = $(
                    '<div style="display:flex; gap:8px; width:100%;"></div>',
                );
                $wrapper.append($lbl).append($name);
                $input.after($wrapper);

                // Update displayed name on file selection
                $input.on("change", function () {
                    var n =
                        this.files && this.files.length > 0
                            ? this.files[0].name
                            : noFileLabel;
                    $name.text(n);
                });
            });
    }

    /**
     * Generic AJAX Filtering Handler
     * Handles search/reset buttons for any form and refreshes the table container
     */
    window.initFilterHandler = function (options = {}) {
        const settings = $.extend(
            {
                form: ".js-filter-form",
                searchBtn: ".js-filter-btn",
                resetBtn: ".js-reset-btn",
                container: "#table_data",
                loader: ".table-loader-overlay",
                onReset: null, // Callback after clearing fields
            },
            options,
        );

        const $form = $(settings.form);
        const $loader = $(settings.loader);

        // Ensure the search button exists within the form (for manual triggering)
        if ($form.length && !$form.find(settings.searchBtn).length) {
            $(
                '<button type="button" class="' +
                    settings.searchBtn.replace(".", "") +
                    ' d-none"></button>',
            ).appendTo($form);
        }

        /**
         * Core AJAX load function
         */
        const loadFilteredData = (url) => {
            $.ajax({
                url: url,
                beforeSend: function () {
                    $loader.addClass("active");
                    $(settings.container).css("opacity", "0.6");
                },
                success: function (data) {
                    $(settings.container).html(data);
                    $(settings.container).css("opacity", "1");
                    $loader.removeClass("active");
                    window.history.pushState(null, "", url);
                },
                error: function (xhr) {
                    $(settings.container).css("opacity", "1");
                    $loader.removeClass("active");
                    if (
                        typeof flasher !== "undefined" &&
                        typeof flasher.error === "function"
                    ) {
                        flasher.error("Action failed!", window.Translations && window.Translations.messages && window.Translations.messages.error ? window.Translations.messages.error : "Error");
                    } else {
                        console.error("Action failed", xhr);
                    }
                },
            });
        };

        // 1. Search Logic
        $form.on("click", settings.searchBtn, function (e) {
            e.preventDefault();
            const formData = $form.serialize();
            const baseUrl = window.location.pathname;
            const fullUrl = baseUrl + "?" + formData;
            loadFilteredData(fullUrl);
        });

        // 2. Reset Logic
        $form.on("click", settings.resetBtn, function (e) {
            e.preventDefault();

            // Clear standard inputs
            $form.find("input").val("");

            // Clear standard selects and safely clear Select2
            $form.find("select").each(function () {
                var $select = $(this);
                if ($select.hasClass("select2-hidden-accessible")) {
                    // Physically remove previously selected options from the DOM to prevent phantom state
                    $select.find('option[value!=""]').remove();
                    $select.val("").trigger("change.select2");
                } else {
                    $select.val("").trigger("change");
                }
            });

            // Reset UI state for Chips and Popovers (Standardization)
            $form.find(".js-filter-chip").removeClass("active");
            $form.find(".filter-popover").fadeOut(100);

            // Execute custom reset callback if exists
            if (typeof settings.onReset === "function") {
                settings.onReset($form);
            }

            // Fresh load of the table (without params)
            loadFilteredData(window.location.pathname);
        });
    };

    /**
     * Standardized Select2 Autocomplete Wrapper
     */
    window.initSelect2Autocomplete = function (selector, options = {}) {
        const settings = $.extend(
            {
                url: "",
                placeholder:
                    (window.Translations &&
                        window.Translations.select_from_list) ||
                    "Select from list",
                showFlag: false,
                dependencySelector: null, // Selector for parent dropdown (e.g., '#country_id')
                language: {
                    inputTooShort: function () {
                        return (
                            (window.Translations &&
                                window.Translations.inputTooShort) ||
                            "Too short"
                        );
                    },
                    searching: function () {
                        return (
                            (window.Translations &&
                                window.Translations.searching) ||
                            "Searching..."
                        );
                    },
                    noResults: function () {
                        return (
                            (window.Translations &&
                                window.Translations.no_results) ||
                            "No results"
                        );
                    },
                },
                mapItem: function (item) {
                    // Detect language from HTML attribute or default to English
                    const lang = document.documentElement.lang || "en";

                    // Priority 1: Use specific fields if they exist (standard for this project)
                    if (item.country_en) {
                        return {
                            id: item.id,
                            text:
                                lang === "ar"
                                    ? item.country_ar
                                    : item.country_en,
                            flag_code: item.flag_code || null,
                        };
                    }
                    if (item.city_en) {
                        return {
                            id: item.id,
                            text: lang === "ar" ? item.city_ar : item.city_en,
                        };
                    }
                    if (item.governorate_en) {
                        return {
                            id: item.id,
                            text: lang === "ar" ? item.governorate_ar : item.governorate_en,
                        };
                    }

                    // Priority 2: Generic fallback
                    return {
                        id: item.id,
                        text: item.text || item.name || "N/A",
                    };
                },
            },
            options,
        );

        const select2Options = {
            minimumInputLength: 0,
            placeholder: settings.placeholder,
            allowClear: true,
            language: settings.language,
            escapeMarkup: function (markup) {
                return markup;
            },
            ajax: {
                url: settings.url,
                dataType: "json",
                delay: 250,
                data: function (params) {
                    const data = {
                        q: params.term,
                    };
                    if (settings.dependencySelector) {
                        const depVal = $(settings.dependencySelector).val();
                        if (depVal) {
                            data.country_id = depVal;
                        }
                    }
                    return data;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return typeof settings.mapItem === "function"
                                ? settings.mapItem(item)
                                : item;
                        }),
                    };
                },
                cache: true,
            },
        };

        if (settings.dropdownParent) {
            select2Options.dropdownParent = settings.dropdownParent;
        }

        if (settings.showFlag) {
            select2Options.templateResult = window.formatSelect2Country;
            select2Options.templateSelection = window.formatSelect2Country;
        }

        $(selector).select2(select2Options);

        // Add auto-clear behavior if this input has a dependency
        if (settings.dependencySelector) {
            $(settings.dependencySelector).on("change", function () {
                const $target = $(selector);
                $target.find('option[value!=""]').remove();
                $target.val("").trigger("change.select2");
            });
        }
    };

    // Run on DOMReady and after modals are shown (for dynamic inputs)
    initCustomFileInputs();
    $(document).on("shown.bs.modal", function () {
        initCustomFileInputs();
    });

    /*
     * Global Image Expansion Handler
     * Opens a SweetAlert2 modal to show a larger version of an image
     */
    $(document).on("click", ".expandable-image-wrapper", function () {
        const imgUrl = $(this).data("img-url");
        const title = $(this).data("title") || "";

        Swal.fire({
            title: title,
            html: `<img src="${imgUrl}" class="swal2-image-simple-anim" style="width: 100%; height: auto; border-radius: 8px; max-height: 80vh; object-fit: contain;">`,
            showCloseButton: true,
            showConfirmButton: false,
            position: "top",
            width: "850px",
            padding: "1.2em",
            background: "transparent",
            backdrop: "swal2-backdrop-premium",
            customClass: {
                popup: "premium-swal-popup mt-3",
                title: "text-dark fw-bold mb-2",
            },
            showClass: {
                popup: "animate__animated animate__fadeIn animate__faster",
            },
            hideClass: {
                popup: "animate__animated animate__fadeOut animate__faster",
            },
        });
    });

    /**
     * Generic Password Toggle Handler
     * Used on buttons with .js-password-toggle class
     * Toggles sibling input between 'password' and 'text'
     */
    $(document).on("click", ".js-password-toggle", function (e) {
        e.preventDefault();
        const btn = $(this);
        const input = btn.closest(".input-group-premium").find("input");
        const icon = btn.find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.removeClass("mdi-eye-outline").addClass("mdi-eye-off-outline");
        } else {
            input.attr("type", "password");
            icon.removeClass("mdi-eye-off-outline").addClass("mdi-eye-outline");
        }
    });

    // --- Flatpickr Global Initialization ---
    if (typeof flatpickr !== "undefined") {
        const lang = $("html").attr("lang") || "en";
        const config = {
            dateFormat: "Y-m-d",
            locale: lang === "ar" ? "ar" : "en",
            disableMobile: "true",
            allowInput: true,
        };

        // Initialize standard date inputs
        $('input[type="date"]').each(function () {
            const input = $(this);
            if (!input.attr("placeholder")) {
                input.attr(
                    "placeholder",
                    lang === "ar" ? "اختر التاريخ" : "Select Date",
                );
            }
            flatpickr(this, config);
        });

        // Helper to initialize new elements (e.g., in modals)
        window.initFlatpickr = function (selector) {
            $(selector || 'input[type="date"]').each(function () {
                const input = $(this);
                if (!input.attr("placeholder")) {
                    input.attr(
                        "placeholder",
                        lang === "ar" ? "اختر التاريخ" : "Select Date",
                    );
                }
                flatpickr(this, config);
            });
        };
    }
    /**
     * Premium Navbar Search Functionality
     * Handles global Ctrl+K shortcut and HUD interaction.
     */
    function initPremiumSearch() {
        const $input = $("#premiumSearchInput");

        // 1. Keyboard Shortcut (Ctrl+K)
        $(document).on("keydown", function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === "k") {
                const searchInput = document.getElementById('premiumSearchInput');
                if (searchInput) {
                    e.preventDefault();
                    searchInput.focus();
                }
            }
        });
    }

    // Initialize Premium Search
    initPremiumSearch();


})(jQuery);

