$(document).ready(function () {
    // parsley front end validation
    // parsleyOptions
    var parsleyOptions = {
        successClass: 'has-success',
        errorClass: 'has-error',
        classHandler: function (_el) {
            return _el.$element.closest('.form-group');
        }
    };
    // form validation initiate
    if ($('form').length > 0) {
        $('form').parsley(parsleyOptions);
    }
    // initilize datepicker
    $(function () {
        $('#datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            todayHighlight: true,
            autoclose: true
        });
    });

    // Dynamic row add and remove
    // onclick
    $('add_row').click(function () {
        console.log('hello from add row click');
    });
});