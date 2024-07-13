$(document).ready(function () {
    $('#uploadForm').on('submit', function (e) {
        e.preventDefault();

        var fileInput = $('#xmlFile');
        if (fileInput.get(0).files.length === 0) {
            $('#response').html('Por favor, selecione um arquivo.');
            return;
        }
        var formData = new FormData(this);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#response').html(response);
                loadUploads();
                $('#xmlFile').val('')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    function loadUploads() {
        $.ajax({
            url: 'list_uploads.php',
            type: 'GET',
            success: function (response) {
                $('#uploadsList').html(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#uploadsList').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    }

    loadUploads();
});
