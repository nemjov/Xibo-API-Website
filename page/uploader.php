<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop File Upload</title>

</head>
<body>

<div class="drop-area" id="monday-drop-area" ondrop="handleDrop(event, 'monday')" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
    <span class="drop-text" id="span-monday">Drop files for Monday here</span>
</div>

<div class="drop-area" id="tuesday-drop-area" ondrop="handleDrop(event, 'tuesday')" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
    <span class="drop-text" id="span-tuesday">Drop files for Tuesday here</span>
</div>

<div class="drop-area" id="wednesday-drop-area" ondrop="handleDrop(event, 'wednesday')" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
    <span class="drop-text" id="span-wednesday">Drop files for Wednesday here</span>
</div>

<div class="drop-area" id="thursday-drop-area" ondrop="handleDrop(event, 'thursday')" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
    <span class="drop-text" id="span-thursday">Drop files for Thursday here</span>
</div>

<div class="drop-area" id="friday-drop-area" ondrop="handleDrop(event, 'friday')" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)">
    <span class="drop-text" id="span-friday">Drop files for Friday here</span>
</div>




<!-- Add 'defer' attribute to the script tag -->

<script>
    // Move the handleDragOver, handleDragLeave, handleDrop, and handleFiles functions above the HTML elements
    function handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
        e.dataTransfer.dropEffect = 'copy';
        e.currentTarget.classList.add('dragged-over');
    }

    function handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
        e.currentTarget.classList.remove('dragged-over');
    }

    function handleDrop(e, uploadDay) {
        e.preventDefault();
        e.stopPropagation();
        e.target.classList.remove('dragged-over');

        var files = e.dataTransfer.files;
        // Process the dropped files and upload them
        handleFiles(files, uploadDay);
    }

    function handleFiles(files, uploadDay) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var formData = new FormData();
            formData.append('file', file);

            // Make an AJAX request to the server
            $.ajax({
                url: '/page/upload.php?day=' + uploadDay,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Append the log message to the output div
                    $('#span-'+ uploadDay).html('Filename:'+file.name);
                    $('#span-'+ uploadDay).addClass('dragged-over');
                    $('#output').append(response + '<br>');
                },
                error: function(error) {
                    console.error('Error uploading file:', error);
                }
            });
        }
    }
    // PREVENT OPENING BODY
    // Disable file opening when files are dragged onto the body
    document.body.addEventListener('dragover', function(event) {
        event.preventDefault();
    });

    document.body.addEventListener('drop', function(event) {
        event.preventDefault();
    });



</script>


</body>
</html>
