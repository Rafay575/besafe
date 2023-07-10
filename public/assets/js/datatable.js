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
    {
      extend: 'copy',
      exportOptions: {
        columns: ':not(:last-child)'
      }
    },
    {
      extend: 'csv',
      exportOptions: {
        columns: ':not(:last-child)'
      }
    },
    {
      extend: 'excel',
      exportOptions: {
        columns: ':not(:last-child)'
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: ':not(:last-child)'
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: ':not(:last-child)'
      }
    }
  ],
  dom: '<"text-center"<"d-flex justify-content-between align-items-center"lBf>>rtip',
} );
