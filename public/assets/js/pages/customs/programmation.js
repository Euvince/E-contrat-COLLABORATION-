document.addEventListener("DOMContentLoaded", function () {
    let programmationSelected = [];

    let programmationsTable = new DataTable("#programmationsTable", {
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
            sZeroRecords: "Aucune évaluation trouvée pour cette date ...!",
            sEmptyTable: "Aucune évaluation trouvée pour cette date ...!",
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

    programmationsTable.on("select", function (e, dt, type, indexes) {
        let checked = programmationsTable.rows(indexes).data()[0];

        let programmationIdChecked = $(checked[0])
            .find(".form-check-input")
            .val();

        programmationSelected.push(programmationIdChecked);
        console.log(programmationSelected);
    });

    programmationsTable.on("deselect", function (e, dt, type, indexes) {
        let checked = programmationsTable.rows(indexes).data()[0];

        let programmationIdChecked = $(checked[0])
            .find(".form-check-input")
            .val();

        programmationSelected = programmationSelected.filter(
            (input) => input !== programmationIdChecked
        );
        $("#checkAllHeader").prop("checked", false);
        console.log(programmationSelected);
    });
});
