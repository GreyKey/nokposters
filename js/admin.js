$(document).ready(function() {
    
    $(".status-select").on("change", function() {
        var current_status = $(this).data("status");

        var row = $(this).parents().eq(1);
        
        var btn = row.find('.update-order-btn');
        
        if (this.value == current_status) {
            btn.prop("disabled", true);
            row.removeClass('row-edit');
        }
        else {
            btn.prop("disabled", false);
            row.addClass('row-edit');
        }
    });

    $(".update_order_status").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var row = $(this).parents().eq(1);
        var select = row.find(".status-select");
        var new_status_code = row.find("option:selected").text();
        var current_status  = row.find('.current_status');
        var status_id  = select.val();
        var order_id = form.find("#order-id").val();
        var submit = form.find('.update-order-btn').val();
        $.ajax({
            type: "POST",
            url: "update_order.php",
            dataType: 'JSON',
            data: {
                order_id: order_id,
                status_id: status_id,
                submit:submit,
            },
            success: function(data) {
                if(data[0] == 1) {
                    current_status.text(new_status_code);
                    select.data("status", status_id);
                    form.find('.update-order-btn').prop("disabled", true);
                    row.removeClass('row-edit');
                }
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });



    $(".featured-checkbox").on("change", function() {
        var stored_data = $(this).data('featured');
        var new_value = $(this).prop('checked') ? 1 : 0;
        var row = $(this).parents().eq(1);
        var btn = row.find('.update-product-btn');

        if (stored_data !== new_value) {
            btn.prop("disabled", false);
            row.addClass('row-edit');
        }
        else {
            btn.prop("disabled", true);
            row.removeClass('row-edit');
        }
    });

    $(".update_product").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var row = $(this).parents().eq(1);
        var checkbox = row.find('.featured-checkbox');
        
        var featured = checkbox.prop('checked') ? 1 : 0;
        var sale_input = row.find('.input-group');
        var label = sale_input.find('span');
        var new_price = sale_input.find('.new-sale-price').val();
        var new_label = new_price === "0" ? "" : new_price;

        var product_id = form.find("#product-id").val();
        var submit = form.find('.update-product-btn').val();
        $.ajax({
            type: "POST",
            url: "update_product.php",
            dataType: 'JSON',
            data: {
                product_id: product_id,
                featured: featured,
                new_price: new_price,
                submit:submit,
            },
            success: function(data) {
                if(data[0] == 1) {
                    label.text(new_label);
                    checkbox.data('featured', featured);
                    sale_input.find('.new-sale-price').val('');
                    form.find('.update-product-btn').prop("disabled", true);
                    row.removeClass('row-edit');
                }
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });
    
    $(".new-sale-price").keyup(function(e) {
        e.preventDefault();
        var row = $(this).parents().eq(2);
        var btn = row.find('.update-product-btn');

        if ($(this).val() !== '') {
            row.addClass('row-edit');
            btn.prop("disabled", false);
        }
        else {
            row.removeClass('row-edit');
            btn.prop("disabled", true);
        }
    });








});