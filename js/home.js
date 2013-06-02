$(function(){

	$('#location').change(function(){
		$.getJSON('/inventory/ajax/children.php', { id: $('#location').attr('value') }, function(json) {
			$('#location2').remove();
			if ( json.length > 0 ) {
				$('<select class="input-block-level" id="location2"><option></option></select>').insertAfter('#location');
				$.each(json,function(){
					$('<option value="'+this.id+'">'+this.friendlyName+'</option>').appendTo('#location2');
				});
		$('#location2').change(function(){
	console.log('change!');
			$.getJSON('/inventory/ajax/children2.php', { id: $('#location2').attr('value') }, function(json) {
				console.log(json);
				if ( json.length > 0 ) {
					$('#itemname').empty();
					$.each(json,function(){
						$('<option value="'+this.id+'">'+this.friendlyName+'</option>').appendTo('#itemname');
					});
				}
			});
		});
			}
		});
		$.getJSON('/inventory/ajax/children2.php', { id: $('#location').attr('value') }, function(json) {
			if ( json.length > 0 ) {
				$('#itemname').empty();
				$.each(json,function(){
					$('<option value="'+this.id+'">'+this.friendlyName+'</option>').appendTo('#itemname');
				});
			}
		});

	});

});