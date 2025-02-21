document.addEventListener('DOMContentLoaded', function () {
    AOS.init();

  });

  document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("show.bs.modal", function () {
        document.querySelectorAll(".modal-backdrop").forEach(function (backdrop, index) {
            if (index > 0) backdrop.remove(); // Remove backdrops duplicados
        });
    });
});

