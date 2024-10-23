function isNumberKey(evt,id) {
    var inputField = evt.target;
    var maxLength = 0;
    if(id === "nik"){
        maxLength = 16;
    }else if(id === "hp"){
        maxLength = 13;
    }else if(id === "usia"){
        maxLength = 2;
    }
    var charCode = evt.which ? evt.which : evt.keyCode;
    
    // Allow: backspace, delete, tab, escape, enter, and arrows
    if (
        charCode == 8 ||  // Backspace
        charCode == 9 ||  // Tab
        charCode == 27 || // Escape
        charCode == 13 || // Enter
        (charCode >= 35 && charCode <= 40) // Arrow keys
    ) {
        return true;
    }

    // Allow: 0-9
    if (charCode >= 48 && charCode <= 57) {
        if (inputField.value.length >= maxLength) {
            return false;
        }else{
            return true;
        }
    }

    // Forbids everything else
    return false;
}

function isAlphaKey(evt,id) {
    var charCode = evt.which ? evt.which : evt.keyCode;
    var inputField = evt.target;
    var maxLength = 0;
    if(id === "nama"){
        maxLength = 50;
    }else if(id === "kampus"){
        maxLength = 100;
    }else if(id === "ref" || id === "pic"){
        maxLength = 30;
    }

    // Allow: A-Z, a-z
    if ((charCode >= 65 && charCode <= 90) || // Uppercase A-Z
        (charCode >= 97 && charCode <= 122) ||
        charCode == 32 || charCode == 46 || charCode == 44) { // Lowercase a-z
        if (inputField.value.length >= maxLength) {
            return false;
        }else{
            return true;
        }
    }

    // Forbid everything else
    return false;
}

function validateEmailKeypress(event) {
    var charCode = event.which ? event.which : event.keyCode;
    var inputField = event.target;
     // Maximum length of 16 characters
    var maxLength = 40;
    // Allow: A-Z, a-z, 0-9, @, and .
    if (
        (charCode >= 48 && charCode <= 57) ||  // 0-9
        (charCode >= 65 && charCode <= 90) ||  // A-Z
        (charCode >= 97 && charCode <= 122) || // a-z
        charCode == 64 || // @ character
        charCode == 46   // . character
    ) {
        if (inputField.value.length >= maxLength) {
            return false; // Prevent input if max length is reached
        }else{
            return true; // Allow input
        }
    }

    // Block any other character
    return false;
}

function validateImageFile(event) {
    var fileInput = event.target;
    var file = fileInput.files[0]; // Get the selected file
    var maxSize = 5 * 1024 * 1024; // 5MB

    if (file) {
        var fileType = file.type; // Get the MIME type of the file
        var fileSize = file.size;
        // Allowed image types and PDF
        var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        if (allowedTypes.includes(fileType) && fileSize <= maxSize) {
            // File is valid
            return true;
        } else {
            alert("Please upload an image or PDF file, maximum size 5MB!");
            // Clear the file input
            fileInput.value = "";
            return false;
        }
    }
}



function validatePhoneNumber(input) {
    var value = input.value;
    // If the first character is not 0, clear the input
    if (value.length > 0 && value[0] !== '0') {
        input.value = ''; // Reset the input field
        Swal.fire({
            title: "Phone number must start with 0",
        });
    }
}