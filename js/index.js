$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault();
        var email = $("#login-email").val();
        var password = $("#login-password").val();
        var submit = $("#login-submit").val();
        $.ajax({
            type: "POST",
            url: "login/authenticate.php",
            data: {
                email: email, password:password, submit:submit
            },
            success: function(data) {
                if (data == 1) {
                    window.location.href = 'admin.php'
                }
                else if (data == 2) {
                    window.location.href = 'index.php'
                }
                else {
                    $("#login-error-message").html(data);
                }

            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });

    $("#signup-form").submit(function(e) {
        e.preventDefault();
        var email = $("#signup-email").val();
        var first_name = $("#signup-firstname").val();
        var last_name = $("#signup-lastname").val();
        var password = $("#signup-password").val();
        var password_verify = $("#signup-password-verify").val();
        var submit = $("#signup-submit").val();
        if (password !== password_verify) {
            $("#signup-error-message").text("Password confirmation does not match");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "login/register.php",
            data: {
                email: email,
                first_name: first_name,
                last_name: last_name,
                password: password,
                submit: submit
            },
            success: function(data) {
                if(data) {
                    $("#signup-error-message").text(data);
                }
                else {
                    window.location.href = 'index.php';
                }
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });


$("#login-admin-form").submit(function(e) {
        e.preventDefault();
        var email = $("#login-email").val();
        var password = $("#login-password").val();
        var submit = $("#login-submit").val();
        $.ajax({
            type: "POST",
            url: "login/authenticate-admin.php",
            data: {
                email: email, password:password, submit:submit
            },
            success: function(data) {
                if (data == 1) {
                    location.reload(); 
                }
                else {
                    $("#login-error-message").html(data);
                }

            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });


// CART EVENTS

    $(".add_to_cart").submit(function(e) {
        e.preventDefault();
        var product_id = $("#product-id").val();
        var quantity = 1;
        var button = $("#add-cart-submit");
        var submit = button.val();
        var alert = $(".cart-alert");
        $.ajax({
            type: "POST",
            url: "add_to_cart.php",
            dataType: 'JSON',
            data: {
                product_id: product_id, quantity:quantity, submit:submit
            },
            success: function(result) {
                if (result[0] == 1) {
                    alert.text("Successfully added to cart");
                    alert.addClass('alert-success');
                    alert.slideDown(400).delay(2000).slideUp(500);
                    // Cart Animation
                    var color = $("#cart_quantity").css('color');
                    $("#cart_quantity").animate( {
                        backgroundColor: "#184281",
                        color: "yellow"
                    }, 200 ).delay(400).queue(function () {
                        $("#cart_quantity").animate( {
                            backgroundColor: "#346cc0",
                            color: color
                        }, 200).dequeue();
                    });
                }
                else {
                    alert.text("Can't order more than three");
                    alert.removeClass("alert-success");
                    alert.addClass("alert-danger");
                    alert.slideDown(400);
                }
                $("#cart_total").text(result[1]);
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });

    $(".remove_from_cart").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var rowDiv = $(this).parents().eq(2);
        var product_id = form.find("#product-id").val();
        var p_subtotal = form.parents().eq(1).data("price");
        var qty = rowDiv.find('.quantity-select option').filter(':selected').val();
        var subtotal = $("#cart-subtotal").text();
        var submit = form.find('.remove-from-cart').val();
        $.ajax({
            type: "POST",
            url: "remove_from_cart.php",
            dataType: 'JSON',
            data: {
                product_id: product_id,
                product_subtotal: p_subtotal,
                qty: qty,
                subtotal: subtotal,
                submit:submit
            },
            success: function(data) {
                rowDiv.fadeOut(200, function(){
                    $(this).empty();
                });
                rowDiv.fadeIn(200, function (){
                    $(this).addClass("item-removed");
                    $(this).text(data[0]);
                    $("#cart-subtotal").text(data[1][0]);
                    $("#cart-shipping").text(data[1][1]);
                    $("#cart-total-price").text(data[1][2]);
                    $("#cart_total").text(data[2]);
                });
                
                
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });

    $("#clear-cart").click(function(e) {
        e.preventDefault();
        var form = $(this);
        var cart_list = $("#cart-container");
        var submit = form.val();
        $.ajax({
            type: "POST",
            url: "clear_cart.php",
            data: {
                submit:submit
            },
            success: function(data) {
                cart_list.fadeOut(200, function(){
                    $(this).empty();
                });
                form.hide();
                //rowDiv.addClass("item-removed");
                cart_list.fadeIn(200, function (){
                    $(this).removeClass("row");
                    $(this).addClass("p-5 empty-cart text-center");

                    $(this).text($.trim(data));
                    $("#cart_total").text(0);
                });
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });


    $(".quantity-select").on("change", function() {
        var old_quantity = $(this).data("quantity");
        $(this).data("quantity", this.value);
        
        var div = $(this).parents().eq(1);
        var span = div.find(".quantity-updated");

        var diff = this.value - old_quantity;
        var product_id = div.find("#product-id").val();
        var p_subtotal = div.data("price");
        var subtotal = $("#cart-subtotal").text();
        var submit = "Update";
        //Animations
        $.ajax({
            type: "POST",
            url: "update_cart.php",
            dataType: 'JSON',
            data: {
                product_id: product_id,
                product_subtotal: p_subtotal,
                diff: diff,
                subtotal: subtotal,
                submit: submit
            },
            success: function(result) {
                
                

                span.animate({
                    opacity: 1
                }, 600).delay(400).queue(function () {
                    span.animate( {
                        opacity: 0
                    }, 600).dequeue();
                });
                // $(".cost-div").animate( {
                //     opacity: 0
                // }, 600);

                // $(".cost-div").animate({
                //     opacity: 1
                // },600);
                $("#cart_total").text(result[0]);
                $("#cart-subtotal").text(result[1][0]);
                $("#cart-shipping").text(result[1][1]);
                $("#cart-total-price").text(result[1][2]);
                
                
            },
            error: function(xhr, ajaxOptions, thrownerror){}
        });
    });

    $('.artist-select').on('change', function () {
        $('#go-to-artist-btn').prop('disabled', !$(this).val());
    }).trigger('change');

});