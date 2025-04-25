document.addEventListener("DOMContentLoaded", function () {
    if (window.Fancybox) {
        console.log("✅ Fancybox found");
        Fancybox.bind("[data-fancybox='gallery']", {
            Thumbs: false,
            Toolbar: true,
        });
    } else {
        console.warn("❌ Fancybox not available");
    }
});
