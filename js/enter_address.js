!function ($) {
	init();

	function onCountryChange(e) {
		var self = $(this);
		hideSelectBlocks($(e.delegateTarget).find('[data-input-type="city"], [data-input-type="metro"]'));

		loadData({
			data: {id: $(e.target).val()},
			route: self.attr('data-route'),
			self: self,
			target: $(e.delegateTarget).find('[data-input-type="city"]')
		});
	}

	function onCityChange(e) {
		var metroContainer = $(e.delegateTarget).find('[data-input-type="metro"]');
		hideSelectBlocks(metroContainer);
		loadData({
			data: {id: $(e.target).val()},
			route: $(this).attr('data-route'),
			self: $(this),
			target: metroContainer
		});
	}

	function onChange(e) {
		$(this).find('option[value=""]').remove();
	}

	function hideSelectBlocks(selects) {
		selects
			.addClass('hidden')
			.each(function () {
				$(this).find('span.glyphicon').remove();
				$(this).find('select').empty();
			});
	}

	function showSelectBlock(selects) {
		selects
			.removeClass('hidden has-error has-success')
			.find('span.glyphicon, div.text-danger')
			.remove();
	}

	function init() {
		var addressContainers = $('[data-block="address"]');
		addressContainers.each(function () {
			addressContainers
				.on('change', '[data-input-type="country"]', onCountryChange)
				.on('change', '[data-input-type="city"]', onCityChange)
				.on('change', 'select', onChange);
		});
	}

	function loadData(options) {
		$.ajax({
			data: options.data,
			url: options.route,
			type: 'POST',
			dataType: 'json',
			cache: false,
			beforeSend: function () {
				options.self.addClass('disabled');
			},
			complete: function () {
				options.self.removeClass('disabled');
			},
			error: function () {

			},
			success: function (response) {
				if (response['status'] === 'ok') {
					var html = '<option value=""></option>';
					for (var key in response['items']) {
						html += '<option value="' + key + '">' + response['items'][key] + '</option>';
					}
					options.target.find('select').html(html);
					showSelectBlock(options.target);
				}
			}
		});
	}
}(jQuery);