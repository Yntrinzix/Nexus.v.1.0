/*var ourRequest = new XMLHttpRequest();
ourRequest.open('GET','https://ieventdemoqna.000webhostapp.com/js/test.json');
ourRequest.onload = function(){
	var ourData = JSON.parse(ourRequest.responseText);
	console.log(ourData[0]);
	console.log("java");
};
ourRequest.send();



	loadJSON("http://api.open-notify.org/astros.json",gotData,jsonp);


function gotData(data){
	println(data);
	console.log(data);
	
	
}*/



	
	$.getJSON("https://ieventdemoqna.000webhostapp.com/js/test.json",function(response){
		alert(response.startMonth);
	});

