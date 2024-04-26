(function($) {
    "use strict";
    $(document).ready(function () {
        $('#BlogTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                              {
                    data: 'percentage',
                    name: 'percentage'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    });
})(jQuery)
