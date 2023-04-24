if (document.getElementById('dataTable')) {
  const dataTableSearch = new simpleDatatables.DataTable("#dataTable", {
    searchable: true,
    fixedHeight: false,
    perPage: 7
  });

  document.querySelectorAll(".export").forEach(function(el) {
    el.addEventListener("click", function(e) {
      var type = el.dataset.type;

      var data = {
        type: type,
        filename: "table-" + type,
      };

      if (type === "csv") {
        data.columnDelimiter = "|";
      }

      dataTableSearch.export(data);
    });
  });
};