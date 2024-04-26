(function($) {
    "use strict";
    $(document).ready(function () {
        $('#socialLink').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                {
                    data: 'Facebook',
                    name: 'Facebook'
                },

                {
                    data: 'Twitter',
                    name: 'Twitter'
                },

                {
                    data: 'Instagram',
                    name: 'Instagram'
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
