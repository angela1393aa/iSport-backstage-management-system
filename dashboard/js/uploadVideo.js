/////////////////////// uploadVideoFile.php //////////////////////////////
function _(element) {
    return document.getElementById(element);
}

// For preview video
let fileInput = _('fileInput');
let previewContainer = _('imagePreview');
let forFileInput = document.querySelector('.forFileInput');
let previewDefaultText = document.querySelector('.video-preview__default-text');
let previewVideo = document.querySelector('.video-preview__video');
let videoPreview = document.getElementById('videoPreview');

fileInput.addEventListener('change', function () {
    let file = this.files[0];

    if (file) {
        let reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewVideo.style.display = "block";
        videoPreview.style.border = '2px solid #262626a9';

        reader.onload = function (e) {
            previewVideo.setAttribute('src', this.result);
        };

        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = "";
        previewVideo.style.display = "";
    }
});

forFileInput.addEventListener("dragover", (e) => {
    e.preventDefault();

    videoPreview.style.backgroundColor = '#145ca063';
    videoPreview.style.border = '5px dashed #262626a9';
    videoPreview.style.color = '#262626a9';
});

forFileInput.addEventListener("dragleave", (e) => {
    e.preventDefault();

    videoPreview.style.backgroundColor = 'transparent';
    videoPreview.style.border = '1px solid #ced4da';
    videoPreview.style.color = '#cccccc';
});

forFileInput.addEventListener("drop", function (e) {
    e.preventDefault();

    fileInput.files = e.dataTransfer.files;
    let file = fileInput.files[0];
    console.log(e);

    if (file) {
        let reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewVideo.style.display = "block";
        videoPreview.style.backgroundColor = 'transparent';
        videoPreview.style.border = '2px solid #262626a9';

        reader.onload = function (e) {
            previewVideo.setAttribute('src', this.result);
        };

        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = "";
        previewVideo.style.display = "";
    }
});







// Upload modal
$(".uploadFileForm").submit(function () {
    $("#loadingModal").modal("show");
});




























// let titleInput = _('titleInput');
// let fileInput = _('fileInput');
// let descriptionInput = _('descriptionInput');
// let categoryInput = document.querySelectorAll('.categoryInput');

// let file = fileInput.files[0];
// console.log(file.name);
// console.log(file.size);
// console.log(file.type);

// let formData = new FormData();
// for (let [key, value] of formData.entries()) {
//     console.log(key, value);
// }
// formData.append('fileInput', file);
// for (let [key, value] of formData.entries()) {
//     console.log(key, value);
// }

// let title = titleInput.value;
// let filePath = formData;
// let description = descriptionInput.value;
// let category = 1;

// categoryInput.forEach(option => {
//     if (option.selected === true) {
//         category = option.value;
//     }
// });
// let config = {
//     headers: {
//         'Content-Type': 'multipart/form-data'
//     }
// };

// axios.post('api/Video/uploadVideo.php', {
//     title: `${title}`,
//     filePath: `${filePath}`,
//     description: `${description}`,
//     category: `${category}`
//     // formData
// }, config)
//     .then(response => console.log(response.data))
//     .catch(err => console.log(err));
// // .then(location.href = 'showVideoList.php');





// let ajax = new XMLHttpRequest();
// ajax.upload.addEventListener('progress', progressHandler, false);
// ajax.addEventListener('load', completeHandler, false);
// ajax.addEventListener('error', errorHandler, false);
// ajax.addEventListener('abort', abortHandler, false);
// ajax.open('post', 'Video.php');
// ajax.send(formData);

// function progressHandler(e) {
//     _(loadedAndTotal).innerHTML = "Uploaded " + e.loaded + 'bytes of ' + e.total;
//     let percent = (e.loaded / e.total) * 100;
//     _('progressBar').value = Math.round(percent);
//     _('status').innerHTML = Math.round(percent) + '% uploaded... please wait';
// }

// function completeHandler(e) {
//     _('status').innerHTML = e.target.responseText;
//     _('progressBar').value = 0;
// }

// function errorHandler(e) {
//     _('status').innerHTML = 'Upload Failed';
// }

// function abortHandler(e) {
//     _('status').innerHTML = 'Upload Aborted';
// }



