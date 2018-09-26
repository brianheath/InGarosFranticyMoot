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
                "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>" +
                "<p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.</p>" +
                "<p>Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.</p>" +
                "<p>Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.</p>" +
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
    
    /* Dropdown */
    $('.add-post-dropdown .dropdown-item').click(function() {
        var title = $(this).text();
        var pageId = $(this).attr('page');
        
        $('.dropdown button').text(title);
        $('input[name=parent-page-id]').attr('value', pageId);
    });
    
    
    
    /**
     * Admin - General Options
     */
    
    /* Set Homepage Button */
    (function() {
        var pageId = $('input[name=homepage-id]').attr('value');
        var pageTitle = $('a.dropdown-item[page=' + pageId + ']').text();
        
        $('.homepage-dropdown button.dropdown-toggle').text(pageTitle);
    })();
    
    /* Dropdown */
    $('.homepage-dropdown .dropdown-item').click(function() {
        var homepage = $(this).text();
        var pageId = $(this).attr('page');
        
        $('.dropdown button').text(homepage);
        $('input[name=homepage-id]').attr('value', pageId);
    });
    
});