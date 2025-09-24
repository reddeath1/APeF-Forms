(function( $ ) {
    'use strict';

    $(function() {
        // Add a confirmation dialog to the delete links
        $('.delete-submission').on('click', function(e) {
            if (!confirm('Are you sure you want to delete this submission? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

})( jQuery );
