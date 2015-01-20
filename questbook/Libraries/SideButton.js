//QuestBook SideButton JavaScript
function SideButtonAnimateElement(_elementSelector) {
	//OnDocumentReady
	$(document).ready(function(){
		//Button Animation
		$(_elementSelector).mouseenter(function(){
			var ThisObj = $(this);
			$(ThisObj).data("timer", setTimeout(function(){
				$(ThisObj).data("anim", true);
				$(ThisObj).stop(true, true).animate({
					width: '+=10px',
					'line-height': '+=10px',
					height: '+=10px',
					color: '#ffcc00'
				}, 250);
			}, 100));
		}).mouseout(function(){
			clearTimeout($(this).data("timer"));
			if($(this).data("anim") == true) {
				$(this).data("anim", false);
				$(this).stop(true, true).animate({
					width: '-=10px',
					'line-height': '-=10px',
					height: '-=10px',
					color: '#54504A'
				}, 95);
			}
		});
	});
}