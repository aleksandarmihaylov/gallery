$(document).ready(function(){

var user_href;
var user_href_splitted;
var user_id;
var image_src;
var image_href_splitted;
var image_name;

$(".modal_thumbnails").click(function(){


$("#set_user_image").prop("disabled", false);
// prop - grabbing the attribute and putting a value WITH "" for the attributes;

user_href = $("#user-id").prop("href");
user_href_splitted = user_href.split("="); //it splits everything in 2 before and after the "="
										//if you have i am = very cool OUTPUT : I am [0] very cool [1] in the array that it creates
user_id = user_href_splitted[user_href_splitted.length -1]; // you need -1 to diplay is 

image_src = $(this).prop("src"); //everytime you click the THIS (element) you get its "src"
image_href_splitted = image_src.split("/");
image_name = image_href_splitted[image_href_splitted.length -1]; // you need -1 to diplay is 


});

$("#set_user_image").click(function(){

$.ajax({

	url: "includes/ajax_code.php",
	data: {image_name: image_name, user_id: user_id},
	type: "POST",
	success:function(data){

		if(!data.error){

			$(".user_image_box a img").prop('src', data);

			//check if everything is working

		}
	}



});

});


tinymce.init({selector:'textarea'});

});

