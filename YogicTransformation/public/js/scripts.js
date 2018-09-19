$(document).ready(function() {

    /**
     * For Pages modal
     */
    $('i.fas').click(function() {
        var action = $(this).attr('action');
        var pageId = $(this).parent('td').attr('id');
        var title = $('#' + pageId + '_title').text();
        var url = $('#' + pageId + '_url').text();
        
        if (action === 'view') {
            $('.modal-title').text(title);
            $('iframe').attr('src', url);
        }
        else if (action === 'edit') {
            // Edit the page
        }
        else if (action === 'delete') {
            // Go get tacos, obviously.
        }
    });
    
});