document.addEventListener("DOMContentLoaded", function () {

    $(".delete-cahier").on("click", function (e) {
        e.preventDefault();
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cet élément du cahier de texte ?",
                text: "",
                icon: "error",
                confirmButtonText: "Supprimer",
                cancelButtonText: "Annuler",
                confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-info w-xs mt-2",
                showCancelButton: true,
                buttonsStyling: false,
                showCloseButton: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr('href');
                }
            });
    });
});
