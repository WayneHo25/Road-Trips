function spbhlpr_LoadSpinner(title,msg){
	var msgLength = msg.length;
	var titleLength = title.length;
    var charsPerLine = 12;
    var msgEmSize = charsPerLine / msgLength;
    var titleEmSize = charsPerLine / titleLength;
    var textBaseSize = 20;
    var msgFontSize;
        msgFontSize = msgEmSize < .52 ? msgEmSize * textBaseSize:11;
        console.log(msgEmSize);
        console.log(msgFontSize);
    var titleFontSize;
    	titleFontSize = titleEmSize < 1 ? titleEmSize * textBaseSize:textBaseSize;

	var html = '<div id="spbhlpr-load-spinner">'+
	'<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">'+
	'<circle cx="50" cy="50" fill="none" stroke="#FFF" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(203.718 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle>'+
	'<text x="0%" y="45%" textLength="100%" style="font-size:'+titleFontSize+'px">'+title+'</text>'+
	'<text x="0%" y="60%" textLength="100%" style="font-size:'+msgFontSize+'px">'+msg+'</text>'+
	'</svg>'+
	'</div>';

	document.getElementById('wpwrap').insertAdjacentHTML('beforeend',html);
}