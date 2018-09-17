Stripe.setPublishableKey('pk_test_TYooMQauvdEDq54NiTphI7jx');

var $form = $('#checkout-form');

$form.sumit(function(event) {
	  $('#charge-error').addClass('hidden');
	  $form.find('buttom').prop('disabled', true);
	  Stripe.card.createToken({
	  number: $('#card-number').val(),
	  cvc: $('#card-cvc').val(),
	  exp_month: $('#card-expiry-month').val(),
	  exp_year: $('#card-expiry-year').val(),
	  name: $('#card-name').val()
	}, stripeResponseHandler);
	return false;

});

function stripeResponseHandler(status, response) {
	if (response.error) {
		$('#charge-error').removeClass('hidden');
		$('#charge-error').text(response.error.message);
		$form.find('buttom').prop('disabled', false);
	} else {
		var token = response.id;
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));

		// Submit the form:
   		 $form.get(0).submit();
	}
}

