(function($) {
    "use strict";
    $(document).ready(function() {
        $('#BlogTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [{
                    data: 'country_id',
                    name: 'country_id'
                },
                {
                    data: 'name_en',
                    name: 'name_en'
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