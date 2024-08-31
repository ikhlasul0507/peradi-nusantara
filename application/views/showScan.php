<!DOCTYPE html>
<html>
<head>
	<title>	Hay</title>
</head>
<body style="background-color: black">
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<div id="qr-reader" style="width: 600px"></div>
<script type="">
	function onScanSuccess(decodedText, decodedResult) {
			if (decodedResult !== null || decodedResult !== ""){
				alert("Scan Berhasil");
			}
    		alert(`Code scanned = ${decodedText}`, decodedResult);
    		cekData(decodedText, decodedResult);
	}
	var html5QrcodeScanner = new Html5QrcodeScanner(
		"qr-reader", { fps: 70, qrbox: 250 });
	html5QrcodeScanner.render(onScanSuccess);

	function cekData(decodedText, decodedResult){
		var dataID = `${decodedText}`, decodedResult;
		alert(dataID);
		var dataJSON = {
				id : dataID
			}
		fetch("<?php echo base_url('Admin/getETicketById')?>",{
			body : JSON.stringify(dataJSON)
			})
		  .then((response) => response.json())
		  .then((data) => {
		  	alert(data);
		  });
	}
	
</script>


</body>
</html>