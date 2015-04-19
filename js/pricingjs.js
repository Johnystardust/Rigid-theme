jQuery(document).ready(function(){
    $ = jQuery;

    $('#add-service').click(function(){
        // checks how many form fields there are and makes it an int
        var count = $('#services-can-add .form-field').length;
        var i = parseInt(count);

        $('#services-can-add').append('<tr class="form-field"><td><input type="text" name="tvds_theme_pricing_options[pricing][]"></td>' +
        '<td><input type="button" class="remove-service button button-cancel" value="Remove Service"></td></tr>');
    });

    // Remove a label text input field
    $(document).on('click' ,'.remove-service', function(){
        $(this).parents(':eq(1)').remove();
    });

    // Add a new label text input field
    $('#add-labels').click(function(){
        // checks how many form fields there are and makes it an int
        var count = $('#labels-can-add .form-field').length;
        var i = parseInt(count);

        $('#labels-can-add').append('<tr class="form-field"><td><input type="text" name="tvds_theme_work_options[default_labels][]"></td>' +
        '<td><input type="button" class="remove-label button button-cancel" value="Remove Label"></td></tr>');
    });

    // Remove a label text input field
    $(document).on('click', '.remove-label', function(){
        $(this).parents(':eq(1)').remove();
    });
});