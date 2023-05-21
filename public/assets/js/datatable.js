// Set the global default options for DataTables
$.extend(true, $.fn.dataTable.defaults, {
  searching: true,
  paging: true,
  serverSide: true,
  lengthMenu: [5,10, 25, 50, 100,200,300,500,1000],
  pageLength: 10,
  processing: true,
  language: {
    paginate: {
      previous: '<i class="fas fa-arrow-left"></i>',
      next: '<i class="fas fa-arrow-right"></i>'
    },
  },
  buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
  ],
  dom: '<"text-center"<"d-flex justify-content-between align-items-center"lBf>>rtip',
} );
