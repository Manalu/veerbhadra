// import $ = require("jquery");
// import * as $ from "jquery";

$(document).ready(function () {
  // on add row click event
  $('#add_row').click(function (e) {
    e.preventDefault(); // prevent default event
    const formName: string = $(this).attr('data-form-name');
    let rowCount: any = $('#rowCount').val();
    rowCount = parseInt(rowCount);

    if (formName === 'create_work_order') {
      let finalTemplate:string = ``;
      let flatNumberTemp: string = `<td><input type="text" name="flat_number[]" class="form-control input-sm" placeholder="Flat Number"></td>`;
      let workOrderDescTemp: string = `<td><textarea name="work_order_desc[]" rows="4" cols="30" class="form-control input-sm" placeholder="Work Order Description" data-parsley-required="true" required></textarea></td>`;
      let quantityTemp: string = `<td><input type="text" name="quantity[]" class="form-control input-sm" data-quantity-position="${rowCount }" placeholder="Quantity" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="100000" data-parsley-required="true" required></td>`;
      
      let unitTemp: string = `<td><select name="unit[]" class="form-control input-sm"><option value="" selected>- Unit -</option>`;
      let unitOptions = ['EA', 'FIT', 'FLAT', 'FT', 'KG', 'M', 'MTR', 'NOS', 'POINT'];

      unitOptions.forEach(function(element){
        unitTemp += `<option value="${ element }">${ element }</option>`;
      });

      unitTemp += `</select></td>`;

      let rateTemp: string = `<td><input type="text" name="rate[]" class="form-control input-sm" data-rate-position="${rowCount }" placeholder="Rate" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>`;
      let amountTemp: string = `<td><input type="text" name="amount[]" class="form-control input-sm" data-amount-position="${rowCount }" placeholder="Amount" readonly="true" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>`;
      
      finalTemplate = `<tr>${flatNumberTemp} ${workOrderDescTemp } ${ quantityTemp } ${ unitTemp } ${ rateTemp } ${ amountTemp }</tr>`;
      
      $(finalTemplate).insertAfter($('#work_order_table tr:last-child'));
      $('#rowCount').val(rowCount+1); // increment rowCounter
    }
  });

  // on delete row click event
  $(document).on('click', '#delete_row', function (e) {
    e.preventDefault(); // prevent default event
    const formName: string = $(this).attr('data-form-name');
    let rowCount:any = $('#rowCount').val();
    rowCount = parseInt(rowCount);

    if (formName === 'create_work_order') {
      if (rowCount > 1) {
        $('#work_order_table tr:last-child').remove();        
        $('#rowCount').val(rowCount-1);// decrement row count
      }
    }
  });

  // calculate total amount of work order
  // watching for quantity field change event
  $(document).on('change', '[data-quantity-position]', function () {
    let quantityPosition: any = $(this).attr('data-quantity-position');
    quantityPosition = parseInt(quantityPosition);

    let quantityValue: any = $(this).val();
    quantityValue = parseFloat(quantityValue);
    
    // check rate value is set or not
    let rateValue: any = $(`[data-rate-position=${quantityPosition}]`).val();
    rateValue = parseFloat(rateValue);

    if ($.isNumeric(quantityValue) && $.isNumeric(rateValue)) {
      let amount: number = quantityValue * rateValue;
      $(`[data-amount-position=${quantityPosition}]`).val(amount.toFixed(2));
    }

  });

  // watching for rate field change event
  $(document).on('change', '[data-rate-position]', function () {
    let ratePosition: any = $(this).attr('data-rate-position');
    ratePosition = parseInt(ratePosition);

    let rateValue: any = $(this).val();
    rateValue = parseFloat(rateValue);

    // get quantity value
    let quantityValue: any = $(`[data-quantity-position=${ratePosition}]`).val();
    quantityValue = parseFloat(quantityValue);

    if ($.isNumeric(rateValue) && $.isNumeric(quantityValue)) {
      let amount: number = quantityValue * rateValue;
      $(`[data-amount-position=${ratePosition}]`).val(amount.toFixed(2));
    }    
  });

});