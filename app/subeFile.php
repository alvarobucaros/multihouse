<style>
    #dropBox{
    border: 3px dashed #0087F7;
    border-radius: 5px;
    background: #F3F4F5;
    cursor: pointer;
}
#dropBox{
    min-height: 150px;
    padding: 54px 54px;
    box-sizing: border-box;
}
#dropBox p{
    text-align: center;
    margin: 2em 0;
    font-size: 16px;
    font-weight: bold;
}
#fileInput{
    display: none;
} 
</style>


<form>      
    <div id="dropBox">
        <p>Select file to upload</p>
    </div>
    <input type="file" name="fileInput" id="fileInput" />
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!--https://www.codexworld.com/ajax-file-upload-using-jquery-php/-->

<!--<script>
 $(function(){
    //file input field trigger when the drop box is clicked
    $("#dropBox").click(function(){
        $("#fileInput").click();
    });
    
    //prevent browsers from opening the file when its dragged and dropped
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    //call a function to handle file upload on select file
    $('input[type=file]').on('change', fileUpload2);
});

function fileUpload2(){
    
}
function fileUpload(event){
    //notify user about the file upload status
    $("#dropBox").html(event.target.value+" Cargando...");
    
    //get selected file
    files = event.target.files;
    
    //form data check the above bullet for what it is  
    var data = new FormData();                                   

    //file data is presented as an array
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
//alert(file.type);
        if(!file.type.match('application/pdf' )  ){              
            //check file type
            $("#dropBox").html("Please choose an images file.");
        }else if(file.size > 1048576){
            //check file size (in bytes)
            $("#dropBox").html("Sorry, your file is too large (>1 MB)");
        }else{
            //append the uploadable file to FormData object
            data.append('file', file, file.name);
            
            //create a new XMLHttpRequest
            var xhr = new XMLHttpRequest();     
            
            //post file data for upload
            xhr.open('POST', 'uploadFile.php', true);  
            xhr.send(data);
            xhr.onload = function () {
                //get response and show the uploading status
                var response = JSON.parse(xhr.responseText);
                if(xhr.status === 200 && response.status == 'ok'){
                    $("#dropBox").html("File has been uploaded successfully. Click to upload another.");
                }else if(response.status == 'type_err'){
                    $("#dropBox").html("Please choose an images file. Click to upload another.");
                }else{
                    $("#dropBox").html("Some problem occured, please try again.");
                }
            };
        }
    }
}
</script>    -->