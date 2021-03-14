var total = document.querySelector('#cart-total-price').dataset.total;
paypal.Buttons({
    style: {
        layout: 'horizontal',
        height: 40,
        label: 'paypal',
        tagline: 'true'
    },
    
    createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: total
            }
          }]
        });
      },
    onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            window.location.replace("success.php")
        });
    }
}).render('#paypal-checkout');