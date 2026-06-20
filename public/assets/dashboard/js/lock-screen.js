let idleTime = 0;
const idleLimit = 300; // 300 seconds (5 minutes)

// Reset timer on any user activity
function resetTimer() {
    idleTime = 0;
}

// Increment idle timer every second
setInterval(() => {
    idleTime++;
    if (idleTime >= idleLimit) {
        if (!window.location.href.includes("lock-screen")) {
            window.location.href = window.Translations.routes.lock_screen;
        }
    }
}, 1000);

window.onload = resetTimer;
window.onmousemove = resetTimer;
window.onmousedown = resetTimer;
window.ontouchstart = resetTimer;
window.onclick = resetTimer;
window.onkeypress = resetTimer;

// Handle Unlock AJAX
$(document).ready(function () {
    const lockForm = $("#lock-form");
    const passwordInput = $("#lock-password");
    const passwordGroup = $("#password-group");
    const errorEl = $("#lock-error");
    const submitBtn = $("#unlock-btn");

    lockForm.on("submit", function (e) {
        e.preventDefault();

        const password = passwordInput.val();

        // Reset state
        passwordGroup.removeClass("is-invalid");
        errorEl.addClass("d-none").text("");

        if (!password) {
            passwordGroup.addClass("is-invalid");
            errorEl
                .removeClass("d-none")
                .text(window.Translations.messages.failed);
            return;
        }

        submitBtn
            .prop("disabled", true)
            .html(
                '<i class="mdi mdi-loading mdi-spin"></i> ' +
                    window.Translations.labels.unlock,
            );

        $.ajax({
            url: window.Translations.routes.unlock_screen,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                password: password,
            },
            success: function (response) {
                if (response.status) {
                    if (typeof flasher !== "undefined") {
                        flasher.success(
                            window.Translations.messages.unlock_success,
                            window.Translations.messages.success || "Success"
                        );
                    }

                    // Small delay for UX transition
                    setTimeout(() => {
                        window.location.replace(
                            response.redirect ||
                                window.Translations.routes.dashboard_index,
                        );
                    }, 500);
                } else {
                    submitBtn
                        .prop("disabled", false)
                        .text(window.Translations.labels.unlock);

                    passwordGroup.addClass("is-invalid");
                    errorEl
                        .removeClass("d-none")
                        .text(
                            response.message ||
                                window.Translations.messages.failed,
                        );
                }
            },
            error: function (xhr) {
                submitBtn
                    .prop("disabled", false)
                    .text(window.Translations.labels.unlock);

                let errorMsg = window.Translations.messages.error;
                if (xhr.status === 422) {
                    errorMsg =
                        xhr.responseJSON.message ||
                        window.Translations.messages.failed;
                }

                passwordGroup.addClass("is-invalid");
                errorEl.removeClass("d-none").text(errorMsg);

                if (typeof flasher !== "undefined") {
                    flasher.error(
                        errorMsg,
                        window.Translations.messages.error || "Error"
                    );
                }
            },
        });
    });

    // Clear error on input
    passwordInput.on("input", function () {
        passwordGroup.removeClass("is-invalid");
        errorEl.addClass("d-none");
    });
});
