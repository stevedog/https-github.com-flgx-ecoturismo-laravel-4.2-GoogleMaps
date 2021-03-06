'use strict';

$(document).ready(function() {
    $('.image-viewer input[type="file"]').change(function(){
        showOnViewer(this);
    });
});

function showOnViewer(fileInput)
{
    var files = fileInput.files;

    for (var i = 0; i < files.length; i++) {           
        var file        = files[i];
        var imageType   = /image.*/;    

        if (!file.type.match(imageType)) {
            continue;
        }           

        var img     = document.getElementById("image-viewer-thumbnail");            
        img.file    = file;   
        var reader  = new FileReader();

        reader.onload = (function(aImg) { 
            return function(e) { 
                aImg.src = e.target.result; 
            }; 
        })(img);

        reader.readAsDataURL(file);
    }  
}