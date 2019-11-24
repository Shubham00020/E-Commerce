<!--footer-->
<div class="footer">
		<div class="footer-bottom">
			<p class="footer-class animated wow fadeInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;"> © 2017 Youth Fashion . All Rights Reserved | Design by <a href="#" target="_blank">Advik</a> </p>
	</div>
</div>
<!--footer-->
<script>
function updateSizes(){
	var sizeString = '';
	for(var i = 1;i <= 12;i++){
		if(jQuery('#size'+i).val() != ''){
			sizeString +=jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
		}
	}
	jQuery('#sizes').val(sizeString);
}

function get_child_options(selected){
	if(typeof selected === 'undefined'){
		var selected = '';
	}
	var parentID = jQuery('#parent').val();
	jQuery.ajax({
		url: '/web/admin/parsers/child_categories.php',
		type: 'POST',
		data: {parentID : parentID, selected: selected},
		success: function(data){
			jQuery('#child').html(data);
		},
		error: function(){alert("Something went wrong with the child options.")},
	});
}
	jQuery('select[name="parent"]').change(function(){
		get_child_options();
	});
</script>
</body>
</html>