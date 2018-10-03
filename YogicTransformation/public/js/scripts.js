$(document).ready(function() {

    /**
     * Admin - Pages
     */
    
    /* Manage Items */
    $('i.fas').click(function() {
        var action = $(this).attr('action');
        var itemId = $(this).parent('td').attr('item-id');
        var title = $('#item_' + itemId + '_title').text();
        var token = $('form [name=_token]').attr('value');
        var itemType = $('td[item-type]').attr('item-type');
        
        if (action === 'view' && itemType === 'page') {
            var url = $('#item_' + itemId + '_url').text();
            $('.modal-title').text(title);
            $('iframe').attr('src', url);
        }
        else if (action === 'view' && itemType === 'post') {
            var author = $('#item_' + itemId + '_author').text();
            var postDate = $('#item_' + itemId + '_date').text();
            
            $.getJSON('/admin/' + itemType + '/' + itemId, function(data) {
                $('#preview_post h1').text(title);
                $('#preview_post h4').text('by ' + author).show();
                $('#preview_post .modal-body h5').text(postDate).show();
                $('#preview_post .body').html(data.body);
                
                if (!data.show_author)
                    $('#preview_post h4').hide();
                
                if (!data.show_date)
                    $('#preview_post .modal-body h5').hide();
            });
            
        }
        else if (action === 'edit') {
            // Edit the page
            window.location.href = '/admin/edit_' + itemType + '/' + itemId;
        }
        else if (action === 'delete') {
            // Go get tacos, obviously.
            if (!window.confirm('Are you sure you wish to delete "' + title + '"?')) {
                return;
            }

            $.ajax({
                url:'/admin/' + itemType + '/' + itemId,
                method: 'DELETE',
                type: 'DELETE',
                data: {_method: 'delete', _token: token},
                success: function() {
                    $('#item_' + itemId + '_row').remove();
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });
        }
    });
    
    /* Edit page */
    $('button#update_header').click(function(){
        var code = $('textarea#header_code').val();
        
        $('#header_output').html(code);
    });
    
    $('button#update_footer').click(function(){
        var code = $('textarea#footer_code').val();
        
        $('#footer_output').html(code);
    });
    
    $('textarea').on('keydown', function(event) {
        if (event.keyCode === 13 && event.ctrlKey) {
            $(this).next('button').click();
        };
    });
    
    $('#check_navbar').click(function(event) {
        if (event.target.checked) {
            $('.modal-navbar').show();
        }
        else {
            $('.modal-navbar').hide();
        }
    });
    
    $('#preview_page_update').on('show.bs.modal', function() {
        var pageTitle = $('#page_title').val();
        var headerCode = $('textarea#header_code').val();
        var footerCode = $('textarea#footer_code').val();
        var htmlString = headerCode + 
                '...<br><br>Your posts will go here<br><br>...' + 
                footerCode;
        
        $('.modal-title').html(pageTitle);
        $('.modal-body').html(htmlString);
    });
    
    (function() {
        if ($('#check_navbar').is(':checked')) {
            $('.modal-navbar').show();
        }
        else {
            $('.modal-navbar').hide();
        }
    })();
    
    
    
    /**
     * Admin - Users
     */
    
    /* Add User */
    $('.generate-password').click(function() {
        var input = $(this).closest('div').find('input');
        input.val(generatePw);
    });
    
    /* Dropdown */
    $('.dropdown .dropdown-item').click(function() {
        var label = $(this).text();
        var itemId = $(this).attr('item-id');
        
        $('.dropdown button').text(label);
        $(this).closest('.form-group').find('input[type=hidden]').val(itemId);
    });
    
    
    
    /**
     * Admin - Posts
     */
    
    /* Add Post */
    $('.preview-post').on('click', function() {
        var author = "TEMP";
        var today = new Date().toLocaleDateString();
        
        $('#preview_post h1').text($('#post_title').val());
        $('#preview_post h4').text('by ' + author).show();
        $('#preview_post .modal-body h5').text(today).show();
        $('#preview_post .body').html($('#post_body').val());

        if (!$('#check_author').is(':checked'))
            $('#preview_post h4').hide();

        if (!$('#check_show_date').is(':checked'))
            $('#preview_post .modal-body h5').hide();
    });
    
    
    
    /**
     * Admin - General Options
     */
    
    /* Set Homepage Button */
    (function() {
        var itemId = $('input[name=homepage-id]').attr('value');
        var label = $('a.dropdown-item[item-id=' + itemId + ']').text();
        
        $('.homepage-dropdown button.dropdown-toggle').text(label);
    })();
    
//    /* Dropdown */
//    $('.homepage-dropdown .dropdown-item').click(function() {
//        var homepage = $(this).text();
//        var pageId = $(this).attr('page');
//        
//        $('.dropdown button').text(homepage);
//        $('input[name=homepage-id]').attr('value', pageId);
//    });
   
    
    
    
    /**
     * Admin Functions
     */
    
    /* Generate Password */
    function generatePw() {
        var possible = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        var newPassword = '';
        
        for(var i=0; i < 16; i++) {
            newPassword += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        
        return newPassword;
    }
    
    
});