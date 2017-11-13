// import $ = require("jquery");
// import * as $ from "jquery";
$(document).ready(function () {
    // on add row click event
    $('#add_row').click(function (e) {
        e.preventDefault(); // prevent default event
        var formName = $(this).attr('data-form-name');
        var rowCount = $('#rowCount').val();
        rowCount = parseInt(rowCount);
        if (formName === 'create_work_order') {
            var finalTemplate = "";
            var flatNumberTemp = "<td><input type=\"text\" name=\"flat_number[]\" class=\"form-control input-sm\" placeholder=\"Flat Number\"></td>";
            var workOrderDescTemp = "<td><textarea name=\"work_order_desc[]\" rows=\"4\" cols=\"30\" class=\"form-control input-sm\" placeholder=\"Work Order Description\" data-parsley-required=\"true\" required></textarea></td>";
            var quantityTemp = "<td><input type=\"text\" name=\"quantity[]\" class=\"form-control input-sm\" data-quantity-position=\"" + rowCount + "\" placeholder=\"Quantity\" data-parsley-type=\"number\" data-parsley-min=\"0.1\" data-parsley-max=\"100000\" data-parsley-required=\"true\" required></td>";
            var unitTemp_1 = "<td><select name=\"unit[]\" class=\"form-control input-sm\"><option value=\"\" selected>- Unit -</option>";
            var unitOptions = ['EA', 'FIT', 'FLAT', 'FT', 'KG', 'M', 'MTR', 'NOS', 'POINT'];
            unitOptions.forEach(function (element) {
                unitTemp_1 += "<option value=\"" + element + "\">" + element + "</option>";
            });
            unitTemp_1 += "</select></td>";
            var rateTemp = "<td><input type=\"text\" name=\"rate[]\" class=\"form-control input-sm\" data-rate-position=\"" + rowCount + "\" placeholder=\"Rate\" data-parsley-min=\"0.1\" data-parsley-max=\"10000000\" data-parsley-required=\"true\" required></td>";
            var amountTemp = "<td><input type=\"text\" name=\"amount[]\" class=\"form-control input-sm\" data-amount-position=\"" + rowCount + "\" placeholder=\"Amount\" readonly=\"true\" data-parsley-min=\"0.1\" data-parsley-max=\"10000000\" data-parsley-required=\"true\" required></td>";
            finalTemplate = "<tr>" + flatNumberTemp + " " + workOrderDescTemp + " " + quantityTemp + " " + unitTemp_1 + " " + rateTemp + " " + amountTemp + "</tr>";
            $(finalTemplate).insertAfter($('#work_order_table tr:last-child'));
            $('#rowCount').val(rowCount + 1); // increment rowCounter
        }
    });
    // on delete row click event
    $(document).on('click', '#delete_row', function (e) {
        e.preventDefault(); // prevent default event
        var formName = $(this).attr('data-form-name');
        var rowCount = $('#rowCount').val();
        rowCount = parseInt(rowCount);
        if (formName === 'create_work_order') {
            if (rowCount > 1) {
                $('#work_order_table tr:last-child').remove();
                $('#rowCount').val(rowCount - 1); // decrement row count
            }
        }
    });
    // calculate total amount of work order
    // watching for quantity field change event
    $(document).on('change', '[data-quantity-position]', function () {
        var quantityPosition = $(this).attr('data-quantity-position');
        quantityPosition = parseInt(quantityPosition);
        var quantityValue = $(this).val();
        quantityValue = parseFloat(quantityValue);
        // check rate value is set or not
        var rateValue = $("[data-rate-position=" + quantityPosition + "]").val();
        rateValue = parseFloat(rateValue);
        if ($.isNumeric(quantityValue) && $.isNumeric(rateValue)) {
            var amount = quantityValue * rateValue;
            $("[data-amount-position=" + quantityPosition + "]").val(amount.toFixed(2));
        }
    });
    // watching for rate field change event
    $(document).on('change', '[data-rate-position]', function () {
        var ratePosition = $(this).attr('data-rate-position');
        ratePosition = parseInt(ratePosition);
        var rateValue = $(this).val();
        rateValue = parseFloat(rateValue);
        // get quantity value
        var quantityValue = $("[data-quantity-position=" + ratePosition + "]").val();
        quantityValue = parseFloat(quantityValue);
        if ($.isNumeric(rateValue) && $.isNumeric(quantityValue)) {
            var amount = quantityValue * rateValue;
            $("[data-amount-position=" + ratePosition + "]").val(amount.toFixed(2));
        }
    });
});
