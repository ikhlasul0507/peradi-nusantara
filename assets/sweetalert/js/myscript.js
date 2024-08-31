$(document).ready(function(){
	let arrayLink=  window.location.pathname.split( '/' );
	let link = window.location.origin + "/"+ arrayLink[1] + "/";

	// $(".formVote").on('submit', function(e){
	// 	e.preventDefault();
	// 	data = {
	// 		'kdvt' : $(this).find("input[name = 'kdvt']").val(),
	// 		'id_pvt' : $(this).find("input[name = 'id_pvt']").val(),
	// 		'nvt' : $(this).find("input[name = 'nvt']").val(),
	// 		'jk_v' : $(this).find("input[name = 'jk_v']").val(),
	// 		'jr_vt' : $(this).find("input[name = 'jr_vt']").val(),
	// 	}
	// 	console.log(data);
	// })

	// $.ajax({
	// 	url : link + "f_end/vote/pvp/",
	// 	method : "POST",
	// 	dataType :"JSON",
	// 	success : function(data){
	// 		console.log(data);
	// 	}
	// });

	console.log(link);

	let flashData = $("#statusVote");

// 	if (flashData != undefined) {
// 	if(flashData.data("pesan") == true){
// 		Swal.fire({
// 		  icon: 'success',
// 		  title: flashData.data("pesan"),
// 		  type: 'success'
// 		});
// 	}else{
// 		Swal.fire({
// 		  icon: 'error',
// 		  title: "Maaf Voucher Salah",
// 		  type: 'error'
// 		});
// 	}	
// }

	console.log(flashData);
});





// 


