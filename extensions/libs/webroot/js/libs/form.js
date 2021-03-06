(function($) {
	var FormHelper = $.FormHelper = {};

	/**
	 * generate a form input
	 */
	FormHelper.input = function(data, metaData) {
		$('#' + metaData.target).empty();
		if ($.Core.type(data) == 'string') {
		}

		$.FormHelper.select(data, metaData);
	};

	/**
	 * generate a select dropdown
	 */
	FormHelper.select = function(data, metaData) {
		var options = '<option>' + $.Core.config('Website.empty_select') + '</option>';
		$.each(data, function(index, name) {
			options += '<option value="' + index + '">' + name + '</option>';
		});
		$('#' + metaData.target).empty().html(options);
	};

	/**
	 * toggle checkboxes
	 */
	FormHelper.checkboxToggleAll = function() {
		var tog = false;
		var toggleId = '#' + Infinitas.model + 'All';
		$(toggleId).click(function(){
			$("input:checkbox[not:"+toggleId+"]").attr("checked",!tog).change();
			tog = !tog;
		});
	};
})(jQuery);