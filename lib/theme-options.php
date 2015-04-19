<?php

// define our settings sections
function tvds_options_page_sections(){
    $sections = array();
    // $sections[$id]               = $title;
    $sections['txt_section']        = 'Text Form Fields';
    $sections['txtarea_section']    = 'Textarea Form Fields';
    $sections['select_section']     = 'Select Form Fields';
    $sections['checkbox_section']   = 'Checkbox Form Fields';

    return $sections;
}

// define our form fields
function tvds_options_page_fields(){
    // text form fields selection
    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_txt_input',
        'title'     => 'Text Input - Some HTML OK!',
        'desc'      => 'A regular text input field. Some inline HTML (<a>, <b>, <em>, <i>, <strong>) is allowed',
        'type'      => 'text',
        'std'       => 'Some default value'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_nohtml_txt_input',
        'title'     => 'Text Input - No HTML!',
        'desc'      => 'A text input field where no html input is allowed.',
        'type'      => 'text',
        'std'       => 'Some default value',
        'class'     => 'nohtml'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_numeric_txt_input',
        'title'     => 'Numeric Input',
        'desc'      => 'A text input field where only numeric input is allowed.',
        'type'      => 'text',
        'std'       => '123',
        'class'     => 'numeric'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_multinumeric_txt_input',
        'title'     => 'Multinumeric Input',
        'desc'      => 'A text input field where only multiple numeric input (i.e. comma separated numeric values) is allowed.',
        'type'      => 'text',
        'std'       => '123,234,345',
        'class'     => 'multinumeric'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_url_txt_input',
        'title'     => 'Url Input',
        'desc'      => 'A text input field which can be used for urls.',
        'type'      => 'text',
        'std'       => 'http://rigid-webdesign.nl',
        'class'     => 'url'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_email_txt_input',
        'title'     => 'Email Input',
        'desc'      => 'A text input field which can be used for email input.',
        'type'      => 'text',
        'std'       => 'email@email.com',
        'class'     => 'email'
    );

    $options[] = array(
        'section'   => 'txt_section',
        'id'        => TVDS_SHORTNAME.'_multi_txt_input',
        'title'     => 'Multi-Text Inputs',
        'desc'      => 'A group of text input fields.',
        'type'      => 'multi-text',
        'choices'   => array('Text input 1 |txt_input1', 'Text input 2 |txt_input2', 'Text input 3 |txt_input3', 'Text input 4 |txt_input4'),
        'std'       => ''
    );

    // textarea form fields section
    $options[] = array(
        'section'   => 'txtarea_section',
        'id'        => TVDS_SHORTNAME.'_txtarea_input',
        'title'     => 'Text Input - HTML OK!',
        'desc'      => 'A textarea for a block of text. HTML tags allowed!',
        'type'      => 'textarea',
        'std'       => 'Some default value'
    );

    $options[] = array(
        'section'   => 'txtarea_section',
        'id'        => TVDS_SHORTNAME.'_nohtml_txtarea_input',
        'title'     => 'Text Input - No HTML!',
        'desc'      => 'A textarea for a block of text. No HTML!',
        'type'      => 'textarea',
        'std'       => 'Some default value',
        'class'     => 'nohtml'
    );

    $options[] = array(
        'section'   => 'txtarea_section',
        'id'        => TVDS_SHORTNAME.'_allowlinebreaks_txtarea_input',
        'title'     => 'No HTML! Line breaks OK!',
        'desc'      => 'No HTML! Line breaks allowed!',
        'type'      => 'textarea',
        'std'       => 'Some default value',
        'class'     => 'allowlinebreaks'
    );

    $options[] = array(
        'section'   => 'txtarea_section',
        'id'        => TVDS_SHORTNAME.'_inlinehtml_txtarea_input',
        'title'     => 'Some Inline HTML only!',
        'desc'      => 'A textarea for a block of text. Only some inline HTML ("<a>, <b>, <em>, <strong>, <blockquote>, <cite>, <code>, <del>, <q>) is allowed!',
        'type'      => 'textarea',
        'std'       => 'Some default value',
        'class'     => 'inlinehtml'
    );

    // select form fields section
    $options[] = array(
        'section'   => 'select_section',
        'id'        => TVDS_SHORTNAME.'_select_input',
        'title'     => 'Select (type one)',
        'desc'      => 'A regular select form field',
        'type'      => 'select',
        'std'       => '3',
        'choices'   => array('1', '2', '3')
    );

    $options[] = array(
        'section'   => 'select_section',
        'id'        => TVDS_SHORTNAME.'_select2_input',
        'title'     => 'Select (type two)',
        'desc'      => 'A select field with a label for the option and corresponding value',
        'type'      => 'select2',
        'std'       => '',
        'choices'   => array('Option 1 |opt1', 'Option 2 |opt2', 'Option 3 |opt3', 'Option 4 |opt4',)
    );

    // checkbox form fields section
    $options[] = array(
        'section'   => 'checkbox_section',
        'id'        => TVDS_SHORTNAME.'_checkbox_input',
        'title'     => 'Checkbox',
        'desc'      => 'Some Description',
        'type'      => 'checkbox',
        'std'       => 1 // 0 for off
    );

    $options[] = array(
        'section'   => 'checkbox_section',
        'id'        => TVDS_SHORTNAME.'_multicheckbox_inputs',
        'title'     => 'Multi-Checkbox',
        'desc'      => 'Some Description',
        'type'      => 'multi-checkbox',
        'std'       => '',
        'choices'   => array('Checkbox 1 |chcbx1', 'Checkbox 2 |chcbx2', 'Checkbox 3 |chcbx3', 'Checkbox 4 |chcbx4',)
    );

    return $options;
}