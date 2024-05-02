document.addEventListener("DOMContentLoaded", function () {
    let universiteSelected = [];

    let universitesTable = new DataTable("#universitesTable", {
        // dom: "Bfrtip",
        //buttons: ["copy", "excel", "pdf"],
        scrollX: true,
        language: {
            lengthMenu: " _MENU_ enregistrements",
            paginate: {
                previous: "Précédent",
                next: "Suivant",
            },
        },
        oLanguage: {
            sZeroRecords: "Aucun résultat correspondant trouvé...!",
            sEmptyTable: "Aucun enregistrement trouvé...!",
            sInfo: "Affichage de _START_ à _END_ sur un total de _TOTAL_",
            sInfoEmpty: "Affichage de 0 à 0 sur un total de 0",
            sInfoFiltered: "",
            sLengthMenu: "_MENU_ enregistrements par page",
            sSearch: "Recherche :",
        },
        select: {
            style: "multi",
            selector: ".form-check-input",
        },
    });

    universitesTable.on("select", function (e, dt, type, indexes) {
        let checked = universitesTable.rows(indexes).data()[0];

        let universiteIdChecked = $(checked[0]).find(".form-check-input").val();

        universiteSelected.push(universiteIdChecked);
        console.log(universiteSelected);
    });

    universitesTable.on("deselect", function (e, dt, type, indexes) {
        let checked = universitesTable.rows(indexes).data()[0];

        let universiteIdChecked = $(checked[0]).find(".form-check-input").val();

        universiteSelected = universiteSelected.filter(
            (input) => input !== universiteIdChecked
        );
        $("#checkAllHeader").prop("checked", false);
        console.log(universiteSelected);
    });

    // //---------------------------------------
    // var checkAll = document.getElementById("checkAllHeader");
    // if (checkAll) {
    //     checkAll.onclick = function () {
    //         var checkboxes = document.querySelectorAll(
    //             '.form-check input[type="checkbox"]'
    //         );
    //         if (checkAll.checked == true) {
    //             Array.from(checkboxes).forEach(function (checkbox) {
    //                 checkbox.checked = true;
    //                 universiteSelected.push($(checkbox.val()));
    //                 // checkbox.closest("tr").classList.add("table-active");
    //                 universitesTable.rows().select();
    //             });
    //         } else {
    //             Array.from(checkboxes).forEach(function (checkbox) {
    //                 checkbox.checked = false;
    //                 // checkbox.closest("tr").classList.remove("table-active");
    //                 universitesTable.rows().deselect();
    //             });
    //         }
    //     };
    // }

    var btns = $(".btn-delete");
    $.each(btns, function (i, btn) {
        $(btn).on("click", function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            console.log(id);
            universiteSelected = [];
            universiteSelected.push(id);
            $("#delete-record").trigger("click");
        });
    });

    $("#delete-record").on("click", function (e) {
        e.preventDefault();
        if (universiteSelected.length === 0) {
            Swal.fire({
                title: "Selectionner au moins une universite!",
                text: "",
                icon: "warning",
                confirmButtonText: "Fermer",
                confirmButtonClass: "btn btn-info w-xs me-2 mt-2",
                showCancelButton: false,
                buttonsStyling: false,
                showCloseButton: false,
            });
        } else {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer ce(s) élément(s) ?",
                text: "",
                icon: "question",
                confirmButtonText: "Supprimer",
                cancelButtonText: "Annuler",
                confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-info w-xs mt-2",
                showCancelButton: true,
                buttonsStyling: false,
                showCloseButton: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: route("delete-universites"),
                        data: {
                            universites_ids: universiteSelected,
                        },
                        success: function (response) {
                            if (response.success) {
                                window.location.reload();
                            }
                        },

                        error: function (error) {
                            Swal.fire({
                                title: "Oups!",
                                text: "Une erreur s'est produite!",
                                icon: "error",
                                confirmButtonText: "Okay!",
                                confirmButtonClass:
                                    "btn btn-primary w-xs me-2 mt-2",
                                showCancelButton: false,
                                buttonsStyling: false,
                                showCloseButton: false,
                            });
                            // console.log(error);
                        },
                    });
                }
            });
        }
    });
});
