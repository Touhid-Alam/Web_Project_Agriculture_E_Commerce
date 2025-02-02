document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            const deliveryUsername = form.querySelector("select[name='DeliveryUsername']").value.trim();

            if (!deliveryUsername) {
                alert("Please select a delivery person.");
                event.preventDefault();
                return;
            }
        });
    });
});
