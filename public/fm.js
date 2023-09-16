// Function to list files and directories
function listFiles() {
    $.ajax({
        url: '/filemanager/listFiles', // Adjust the URL to your route
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            // Clear the existing list
            $('#file-list').empty();

            // Populate the list with files and directories
            Object.keys(data).forEach((key) => {
                $('#file-list').append('<li class="list-group-item"><a class="text-decoration-none">' + data[key] + '</a><button type="button" class="btn btn-primary float-end btn-sm" onclick="downloadFile(\'' + data[key] + '\')">Download</button></li>');
            });
        }
    });
}

// Function to download a file
function downloadFile(filename) {
    window.location.href = '/filemanager/downloadFile/' + filename; // Adjust the URL to your route
}

// List files on page load
$(document).ready(function () {
    listFiles();
});