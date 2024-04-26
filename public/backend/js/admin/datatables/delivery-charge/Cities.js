(function($) {
    "use strict";
    $(document).ready(function() {
        $('#BlogTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [{
                    data: 'state_id',
                    name: 'state_id'
                },
                {
                    data: 'name_en',
                    name: 'name_en'
                },
                {
                    data: 'charge',
                    name: 'charge'
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