function encodeJSON(object){
	return JSON && JSON.stringify(object) || $.stringifyJSON(object);
}

function decodeJSON(json){
	return JSON && JSON.parse(json) || $.parseJSON(json);
}


$(document).ready(function(){
	$('#stageOne').animate({
			top: 0
		}, 800,function(){

	});

	$('#stageOne').children().css('opacity',0).animate({
			opacity : 1
	},1500,function() {

	});

	var map = $('#map');
	$('#Trimite').click(function(){
		$('#stageOne').animate({
			top: -600
		}, 800,function(){

		});
		
		var detrimis = $("#DATE").val();

		$.ajax({url:"./ajax.php", data: { 'data':detrimis }, success:function(data){
			

			var blue = new google.maps.MarkerImage("./images/icon_blue.png", null, null, new google.maps.Point(20, 34));
			var orange = new google.maps.MarkerImage("./images/icon_orange.png", null, null, new google.maps.Point(20, 34));


			//alert(data);
			var r = decodeJSON(data);
			var x = r['markers'];
			var y = decodeJSON(detrimis);
			// alert(x.markers[0].id);
			var markers = new Array();
			for (i=0; i < x.length; i++)
			{
				temp = new Array();
				temp['id'] 			= x[i].id;
				temp['lat'] 		= x[i]['lat'];
				temp['lng'] 		= x[i]['lng'];
				temp['data'] 		= new Array();
 				temp['data']['nume'] = y.data[i].nume;
				temp['data']['nr_membri'] = y.data[i].nr_membri;
				temp['data']['vecini'] = new Array();
				temp['data']['vecini'] = y.data[i].vecini;
				temp['data']['nonVecini'] = new Array();
				temp['data']['nonVecini'] = y.data[i].nonVecini;
				temp['options'] = new Array();
				temp['id'] = 'marker'+i;
				if (x[i].satisfacut == 1) temp['options']['icon'] = blue; 
				else temp['options']['icon'] = orange; 
				//alert(y.data[i].nume);
				markers.push(temp);
				
				//alert(markers[i]['lat']);
			}
			//alert(encodeJSON(markers));
			//markers = decodeJSON(data);

			/*var markers=[
			{ lat: 44.45891279066387, lng: 26.28610241986696, data: '{"nume":"Ionescu","nr_membri":"4","vecini":[1,2,52,12]}' , options:{ icon: blue , zIndex: 99999 }, id: 'marker0' },
			{ lat: 44.46391279066387, lng: 26.28610241986696, data: '{"nume":"Popescu","nr_membri":"2","vecini":[8,4,12]}' , options:{ icon: blue , zIndex: 99999 }, id: 'marker1' },
			{ lat: 44.49891279066387, lng: 26.58610241986696, data: '{"nume":"Anonim","nr_membri":"5","vecini":[1,2,5,13]}' , options:{ icon: orange , zIndex: 99999 }, id: 'marker2' },
			{ lat: 44.43891279066387, lng: 26.18610241986696, data: '{"nume":"Cristea","nr_membri":"3","vecini":[6,10,11,32]}' , options:{ icon: orange , zIndex: 99999 }, id: 'marker3' }
			];

*/


		$('#map').gmap3('destroy').gmap3({
			marker : {
	        	values : markers,
	            options : {
	                draggable : false,
	                icon: blue,
	                animation: google.maps.Animation.DROP
	            },
	            events:{
              		click: function(marker, event, context){
				        var map = $(this).gmap3("get"),
				          	infowindow = $(this).gmap3({get:{name:"infowindow"}});


				        var data 	= decodeJSON(context.data);
				        var id 		= context.id.replace('marker','');
				        var vecini 	= "", nonVecini = "";

				        if (typeof data.vecini != 'undefined')
				        for (var i = 0; i < data.vecini.length; i++)
						{
							if (i == 0) vecini = "N"+data.vecini[i];
						    else vecini +=", N"+data.vecini[i]; 
						}

						if (typeof data.nonVecini != 'undefined')
						for (var i = 0; i < data.nonVecini.length; i++)
						{
							if (i == 0) nonVecini = "N"+data.nonVecini[i];
						    else nonVecini +=", N"+data.nonVecini[i]; 
						}
				        var div;
				        div  = '<div class="infoDiv"><div><label>Nume:</label><input id="family'+id+'" type="text" value="'+data['nume']+'" /></div>';
				        div += '<div><label>Numar membri:</label><input id="membri'+id+'" type="text" value="'+data['nr_membri']+'" /></div>';
				        div += '<div><label>Doreste sa aiba ca vecini pe:</label><textarea id="vecini'+id+'">'+vecini+'</textarea></div>';
				        div += '<div><label>Nu doreste sa aiba ca vecini pe:</label><textarea id="nonVecini'+id+'">'+nonVecini+'</textarea></div></div>';

				        if (infowindow)
				        {
				          	infowindow.open(map, marker);
				          	infowindow.setContent(div);
				          	//$('input[type="text"], textarea')
				        }
				        else 
				        {
				          	$('#map').gmap3({
				            	infowindow:{
					              	anchor:marker, 
					              	options:{content: div}
					            }
				          	});

				        }
				    }
            	}
	        },
			map : {
			    options : {
			      	zoom: 18,
			      	minZoom: 10
			    }
			}
	    },"autofit"); 
		} });
		$('#stageTwo').removeClass('scale1').addClass('scale2').animate({
			opacity:1			
		}, 800,function(){
			$('#reintroducetiDate').animate({top:-38},300);
		});

	});

	$('#reintroducetiDate').click(function(){
		$('#stageOne').animate({
			top: 0
		}, 800,function(){

		});

		$('#stageTwo').removeClass('scale2').addClass('scale1').animate({
			opacity:0
		},800);
		$('#reintroducetiDate').animate({top:0},300);

	});

	var mapContainer = $("#stageTwo > .wrapper").width();
	$('#map').width(mapContainer-400);

	
});

$(window).resize(function(){
	var mapContainer = $("#stageTwo > .wrapper").width();
	$('#map').width(mapContainer-400);
});
$(window).load(function(){

});

/*var obj = new Object();
obj.date = new Array();
obj.date[0] 				= new Array ();
obj.date[0]['id'] 			= 1;
obj.date[0]['nume'] 		= "Andrei";
obj.date[0]['nr_membri'] 	= 5;
obj.date[0]['vecini'] 		= new Array(2,6,15,7);
obj.date[0]['nonVecini'] 	= new Array(3,4,21,72);
alert(encodeJSON(obj));*/
