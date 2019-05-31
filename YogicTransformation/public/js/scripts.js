$(document).ready(function() {
    
    /**
     * Website functions
     */
    
    /* Make the header background scroll all pretty-like */
    $window = $(window);
    $('header[data-type="background"], section[data-type="background"]').each(function(){
		
        var $bgobj = $(this); // assigning the object

        $(window).scroll(function() {

            // Scroll the background at var speed, the yPos is a negative value because we're scrolling it UP!								
            var yPos = -($window.scrollTop() / $bgobj.data('speed'));

            // Put together our final background position
            var coords = '50% '+ yPos + 'px';

            // Move the background
            $bgobj.css({ backgroundPosition: coords });

        });
    });
    
    
    
    
    

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
        var pageCSS = $('#page_css').val();
        var pageTitle = $('#page_title').val();
        var headerCode = $('textarea#header_code').val();
        var footerCode = $('textarea#footer_code').val();
        
        var headCode = '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><link rel="stylesheet" href="/css/styles.css" />' +
                '<style>' + pageCSS + '</style>';
        
        var htmlString = headerCode + 
                '<br><br>...Your posts will go here...<br><br>' + 
                footerCode;
        
        $('.modal-title').html(pageTitle);
        $('.modal-body iframe').contents().find('head').html(headCode);
        $('.modal-body iframe').contents().find('body').html(htmlString);
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
    
    /* Edit User */
    $('.btn-role').click(function(){
        $(this).toggleClass('btn-primary btn-secondary');
        
        setRoles();
    });
    
    /* Set initial role(s) */
    (function() {
        setRoles();
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
    
    
    /**
     * Admin - Styling
     */
    
    $('textarea#site_css').on('keydown', function(event) {
        if (event.keyCode === 13 && event.ctrlKey) {
            $('form[name=site-css]').submit();
        }
    });
    
    
    
    /**
     * Admin - General Options
     */
    
    /* Set Default Dropdown Value */
    if ($('.dropdown').length) {
        var itemId = $('input[name=dropdown-value]').attr('value');
        var label = $('a.dropdown-item[item-id=' + itemId + ']').text();
        
        if (itemId) {
            $('.dropdown button.dropdown-toggle').text(label);
        }
    }
    
    
    
    /**
     *  Click to toggle targets, typically textareas.
     *  This will hide the 'Refresh Header/Footer' buttons and toggle the 
     *  caret icons from down to right.
     **/
//    $('.toggle-code').click(function() {
//        var target = $(this).data('target');
//        
//        $(target).slideToggle();
//        $(target).next('button').toggle();
//        $(this).prev('i.fas').toggleClass('fa-caret-right');
//        $(this).prev('i.fas').toggleClass('fa-caret-down');
//    });
    
    /* An attempt at allowing the tab key to insert a tab */
    $('textarea.code-box').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();
            var position = this.selectionStart;
            $(this).val($(this).val().substring(0, position)
                + "\t"
                + $(this).val().substring(position));
                
            // return the cursor to the position + the tab
            this.selectionStart = this.selectionEnd = position + 1;
        }
    });
    
    /* Resize code-box textareas to fit the content */
    $('textarea.code-box').each(function() {
        autoResize(this);
    });
    
    
    
    
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
    
    /* Set Value of User's Role(s) */
    function setRoles() {
        var roleIDs = "";
        
        $('.btn-role.btn-primary').each(function() {
            roleIDs = roleIDs + $(this).val() + ",";
        });
        
        $('#role_ids').val(roleIDs);
    }
   
    /* Auto resize this element (usually a textarea) */
    function autoResize(target) {
        target.style.height = (target.scrollHeight + 10) + 'px';
        console.info(target.scrollHeight);
    }
    
});