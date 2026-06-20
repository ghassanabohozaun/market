$(document).ready(function () {
    /**
     * Rebuild the UI based on state
     */
    function updateFileinputUI($component) {
        const $input = $component.find(".fileinput-trigger");
        const $previewContainer = $component.find(".fileinput-preview");
        const $placeholder = $component.find(".fileinput-placeholder");
        const $currentImg = $component.find(".fileinput-current-img");
        const $localResetBtn = $component.find(".fileinput-local-reset");
        const $deletedFlag = $component.find(".fileinput-deleted-flag");
        const isEditMode = $component.data("mode") === "edit";

        const hasFile =
            $input[0] && $input[0].files && $input[0].files.length > 0;
        const isDeleted = $deletedFlag.val() === "1";

        if (hasFile) {
            // A new file is selected. Dynamic preview handles the image.
            $placeholder.addClass("d-none");
            $currentImg.addClass("d-none");
            $localResetBtn.removeClass("d-none"); // Show Undo button
        } else {
            // No new file is selected.
            $previewContainer.find("img.fileinput-dynamic-preview").remove();

            if (isEditMode) {
                if (isDeleted) {
                    // Original image was requested to be deleted locally
                    $placeholder.removeClass("d-none");
                    $currentImg.addClass("d-none");
                    $localResetBtn.addClass("d-none"); // Nothing to undo until HUD Discard
                } else {
                    // Show original image
                    $placeholder.addClass("d-none");
                    $currentImg.removeClass("d-none");
                    $localResetBtn.addClass("d-none"); // Hide by default until a NEW file is selected (or if user specifically wants to delete)
                }
            } else {
                // Create Mode - Empty State
                $placeholder.removeClass("d-none");
                $currentImg.addClass("d-none");
                $localResetBtn.addClass("d-none"); // Nothing to undo
            }
        }
    }

    /**
     * Handle Image Selection (Show Preview)
     */
    $(document).on("change", ".fileinput-trigger", function () {
        const input = this;
        const $component = $(this).closest(".fileinput-component");
        const $previewContainer = $component.find(".fileinput-preview");
        const imageFit = $component.data("fit") || "contain";

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $previewContainer
                    .find("img.fileinput-dynamic-preview")
                    .remove();
                $previewContainer.prepend(
                    `<img src="${e.target.result}" class="fileinput-dynamic-preview" style="width: 100%; height: 100%; object-fit: ${imageFit} !important; background-color: #f8f9fa;">`,
                );
                updateFileinputUI($component);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            // If input is cleared (e.g. via HUD discard or cancellation)
            updateFileinputUI($component);
        }
    });

    /**
     * Handle Local Reset (Undo selection / Delete original)
     */
    $(document).on("click", ".fileinput-local-reset", function () {
        const $component = $(this).closest(".fileinput-component");
        const $input = $component.find(".fileinput-trigger");
        const $deletedFlag = $component.find(".fileinput-deleted-flag");

        const hasFile =
            $input[0] && $input[0].files && $input[0].files.length > 0;

        // Clear file input value
        $input.val("");
        if ($input.next().find(".custom-file-name").length) {
            $input
                .next()
                .find(".custom-file-name")
                .text(
                    (window.Translations &&
                        window.Translations.no_file_chosen) ||
                        "No file chosen",
                );
        }

        if (hasFile) {
            // We are undoing a NEWLY selected file override
            // Keep the deletedFlag whatever it was before (so if they had deleted the original, it stays deleted)
        } else {
            // We are undoing the ORIGINAL DB IMAGE (local delete)
            $deletedFlag.val("1");
            // Explicitly notify HUD that the deletedFlag changed for tracking
            if (window.activeHud) {
                window.activeHud.handleFieldChange($deletedFlag[0]);
            }
        }

        updateFileinputUI($component);

        // Trigger HUD for the file input change
        if (window.activeHud) {
            window.activeHud.handleFieldChange($input[0]);
        }
    });

    /**
     * Listen for programmatic changes to the deleted flag (e.g., from HUD Discard)
     */
    $(document).on("change", ".fileinput-deleted-flag", function () {
        updateFileinputUI($(this).closest(".fileinput-component"));
    });

    /**
     * Setup on Load
     */
    $(".fileinput-component").each(function () {
        updateFileinputUI($(this));
    });
});
