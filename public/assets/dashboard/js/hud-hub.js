/**
 * HUD Hub - Shared Logic for Floating Command HUD
 * Handles change tracking and visibility for any form.
 * Optimized for Premium UI elements like Select2 and Summernote.
 */
class HudHub {
    constructor(formSelector, config = {}) {
        this.form = document.querySelector(formSelector);
        if (!this.form) return;

        this.hud = document.getElementById(config.hudId || "commandHud");
        this.countSpan = document.getElementById(
            config.countId || "changeCount",
        );
        this.discardBtn = document.getElementById(
            config.discardId || "btnHudDiscard",
        );
        this.config = config; // Store config for later use

        if (!this.hud) {
            console.warn("HudHub: HUD element not found.");
            return;
        }

        this.initialState = new Map();
        this.changedFields = new Set();
        this.debounceTimer = null;

        this.init();
    }

    init() {
        // Store initial values and attach listeners
        this.trackAllFields();

        // Listen for standard form changes (Standard + jQuery compatibility with namespacing)
        if (window.jQuery) {
            const $form = jQuery(this.form);
            $form.off(".hudHub"); // Clear all previous HUD listeners on this form

            $form.on("change.hudHub", "input, select, textarea", (e) => {
                this.handleFieldChange(e.target);
            });
            $form.on("input.hudHub", "input, textarea", (e) => {
                if (e.target.tagName !== "SELECT") {
                    this.debouncedHandleChange(e.target);
                }
            });
        } else {
            // Keep native listeners but they are harder to clean up globally
            // For now, we prioritize the jQuery path which is used in this project
            this.form.addEventListener("change", (e) =>
                this.handleFieldChange(e.target),
            );
            this.form.addEventListener("input", (e) => {
                if (e.target.tagName !== "SELECT") {
                    this.debouncedHandleChange(e.target);
                }
            });
        }

        // Discard handler with listener protection
        if (this.discardBtn && window.jQuery) {
            const $btn = jQuery(this.discardBtn);
            $btn.off("click.hudKeep").on("click.hudKeep", (e) => {
                e.preventDefault();

                if (window.Swal) {
                    Swal.fire({
                        title:
                            window.Translations?.ask_discard_changes ||
                            "Are you sure?",
                        text:
                            window.Translations?.discard_warning_text ||
                            "Unsaved changes will be lost.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText:
                            window.Translations?.yes_discard || "Yes, discard",
                        cancelButtonText:
                            window.Translations?.no_cancel || "No",
                        showClass: {
                            popup: "swal2-noanimation",
                            backdrop: "swal2-noanimation",
                        },
                        hideClass: {
                            popup: "",
                            backdrop: "",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.discard();
                        }
                    });
                } else if (
                    confirm(
                        window.Translations?.ask_discard_changes ||
                            "Discard changes?",
                    )
                ) {
                    this.discard();
                }
            });
        }

        // 6. Sync UI state immediately (fixes "ghost" visibility from previous instances)
        // Set 'true' for instant sync to prevent "diving" animation on modal open
        this.updateHud(true);
    }

    discard() {
        // 1. Restore field values from initialState (True Undo)
        this.initialState.forEach((val, fieldKey) => {
            let input = this.form.querySelector(
                `[id="${fieldKey}"], [name="${fieldKey}"]`,
            );

            // SPECIAL CASE: Checkboxes/Radios might have composite fieldKeys
            if (!input) {
                const multiInputs = this.form.querySelectorAll(
                    'input[type="checkbox"], input[type="radio"]',
                );
                for (const element of multiInputs) {
                    if (this.getFieldKey(element) === fieldKey) {
                        input = element;
                        break;
                    }
                }
            }

            if (!input) return;

            if (input.type === "checkbox") {
                input.checked = val;
            } else if (input.type === "radio") {
                const radio = this.form.querySelector(
                    `input[name="${input.name}"][value="${val}"]`,
                );
                if (radio) radio.checked = true;
            } else {
                input.value = val;
                // Trigger change for Select2/Summernote and standard UI updates
                if (window.jQuery) {
                    const $input = jQuery(input);
                    if ($input.data("select2")) {
                        $input.trigger("change.select2");
                    }
                    if ($input.hasClass("summernote")) {
                        $input.summernote("code", val);
                    }
                    // Always trigger a standard change for any JS-driven previews (like flags)
                    $input.trigger("change");
                } else {
                    input.dispatchEvent(new Event("change", { bubbles: true }));
                }
            }
        });

        // 2. Clear changed fields tracking
        this.changedFields.clear();

        // 3. Clear validation errors (if helper exists)
        if (window.clearFormErrors) {
            window.clearFormErrors("#" + this.form.id);
        }

        // 4. Handle custom discard logic or simple reset
        if (typeof this.config.onDiscard === "function") {
            this.config.onDiscard(this.form);
        } else {
            // Default: try to close modal if form is inside one
            const modal = this.form.closest(".modal");
            if (modal && window.jQuery) {
                jQuery(modal).modal("hide");
            }
        }

        // 5. Update HUD visibility (smooth)
        this.updateHud(false);
    }

    trackAllFields() {
        const inputs = this.form.querySelectorAll(
            'input:not([type="hidden"]), input.fileinput-deleted-flag, select, textarea',
        );
        inputs.forEach((input) => {
            const fieldKey = this.getFieldKey(input);
            if (!fieldKey) return;

            const val = this.getInputValue(input);
            this.initialState.set(fieldKey, val);

            // SPECIAL CASE: Select2 integration
            if (window.jQuery && jQuery(input).data("select2")) {
                jQuery(input)
                    .off("change.hudHub")
                    .on("change.hudHub", () => this.handleFieldChange(input));
            }

            // SPECIAL CASE: Summernote integration
            if (window.jQuery && jQuery(input).hasClass("summernote")) {
                jQuery(input)
                    .off("summernote.change.hudHub")
                    .on("summernote.change.hudHub", () =>
                        this.handleFieldChange(input),
                    );
            }
        });
    }

    getFieldKey(input) {
        if (input.type === "checkbox") {
            return input.id || input.name + "_" + input.value;
        }
        return input.id || input.name;
    }

    getInputValue(input) {
        if (input.type === "checkbox") {
            return input.checked;
        }
        if (input.type === "radio") {
            const checkedGroup = this.form.querySelector(
                `input[name="${input.name}"]:checked`,
            );
            return checkedGroup ? checkedGroup.value : null;
        }
        return input.value;
    }

    debouncedHandleChange(input) {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            this.handleFieldChange(input);
        }, 300);
    }

    handleFieldChange(input) {
        const fieldKey = this.getFieldKey(input);
        if (!fieldKey) return;

        const currentVal = this.getInputValue(input);
        const originalVal = this.initialState.get(fieldKey);

        // Professional comparison (handling nulls/undefined/empty strings)
        const isChanged =
            String(currentVal ?? "").trim() !==
            String(originalVal ?? "").trim();

        if (isChanged) {
            this.changedFields.add(fieldKey);
        } else {
            this.changedFields.delete(fieldKey);
        }

        this.updateHud(false);
    }

    updateHud(instant = false) {
        const count = this.changedFields.size;

        if (this.countSpan) {
            this.countSpan.textContent = count;
        }

        if (instant && this.hud) {
            // Disable transition for instant sync
            const originalTransition = this.hud.style.transition;
            this.hud.style.transition = "none";

            if (count > 0) {
                this.hud.classList.add("visible");
            } else {
                this.hud.classList.remove("visible");
            }

            // Force reflow
            this.hud.offsetHeight;
            this.hud.style.transition = originalTransition;
            return;
        }

        if (count > 0) {
            this.hud.classList.add("visible");
        } else {
            this.hud.classList.remove("visible");
        }
    }

    /**
     * Resets the HUD state after a successful submission.
     * Captures current field values as the new 'initial' state.
     */
    reset() {
        const inputs = this.form.querySelectorAll(
            'input:not([type="hidden"]), select, textarea',
        );
        inputs.forEach((input) => {
            const fieldKey = this.getFieldKey(input);
            if (!fieldKey) return;
            const val = this.getInputValue(input);
            this.initialState.set(fieldKey, val);
        });
        this.changedFields.clear();
        this.updateHud(false);
    }
}

// Global initialization helper
window.hudInstances = window.hudInstances || {};
window.initHud = function (formId, config) {
    const runInit = () => {
        const form = document.getElementById(formId);
        if (form) {
            // Cleanup existing instance for this form if any
            if (window.hudInstances[formId]) {
                // Potential cleanup logic here if needed
            }
            window.hudInstances[formId] = new HudHub("#" + formId, config);
            window.activeHud = window.hudInstances[formId]; // Still support legacy global reference
        }
    };

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", runInit);
    } else {
        runInit();
    }
};
