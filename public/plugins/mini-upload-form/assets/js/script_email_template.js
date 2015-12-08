$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({
       

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),
        acceptFileTypes:'/(\.|\/)(gif|jpe?g|png)$/i',

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
           //JSON.parse(data);
            //add validation for file type
            $("#loadingImage").show();
            if(data.files[0]['type'] != 'image/png' && data.files[0]['type'] != 'image/jpg' && data.files[0]['type'] != 'image/jpeg'){ alert("Only .png, .jpg, and .jpeg is allowed."); return; }

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }            
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        },
        
        done:function(e, data){
            if(data.result.success){
               
             $("#loadingImage").hide();
                var newImg = "<div class='dragImage'><a class='thumbnail' href='javascript:void(0);'><img src='"+APP_URL+data.result.filePath+"' height='50' width='50' alt='...' class='margin' style='height:50px;width:50px;' /></a></div>";
                $('.imagePrview').append(newImg);
            }
        }
        

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});