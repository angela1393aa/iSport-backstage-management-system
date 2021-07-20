/////////////////////// uploadVideoFile.php ////////////////////////////////////////////////////////////
function _(element) {
    return document.getElementById(element);
}

// Main
let titleInput = _('titleInput');
let titleInvalid = _('titleInvalid');
let titleInvalidMessage = _('titleInvalidMessage');
let titleValid = _('titleValid');

let fileInput = _('fileInput');

let descriptionInput = _('descriptionInput');
let descriptionInvalid = _('descriptionInvalid');
let descriptionValid = _('descriptionValid');
let descriptionInvalidMessage = _('descriptionInvalidMessage');

// For preview video
let forFileInput = document.querySelector('.forFileInput');
let previewDefaultText = document.querySelector('.video-preview__default-text');
let previewVideo = document.querySelector('.video-preview__video');
let previewDefaultImage = document.querySelector('.video-preview__default-image');
let previewDefaultWarning = document.querySelector('.video-preview__default-warning');
let previewDefaultNecessary = document.querySelector('.video-preview__default-necessary');
let videoPreview = _('videoPreview');

// Upload Button
let uploadBtn = _('uploadBtn');

//////////////////////////////////////////////////////////////////////////////////////////////////

fileInput.addEventListener('change', function () {
    // Title
    let title = titleInput.value;
    title = title.trim();


    // Description
    let description = descriptionInput.value;
    description = description.trim();

    // File
    let file = this.files[0];

    if (file) {
        let reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewVideo.style.display = "block";
        videoPreview.style.border = '2px solid #52b69a';
        previewDefaultImage.style.display = "none";
        previewDefaultNecessary.style.display = 'none';

        reader.onload = function (e) {
            previewVideo.setAttribute('src', this.result);
        };

        videoPreview.setAttribute('data-value', 'true');

        if (title.length < 5 || title.length > 41 || description.length < 10 || description.length > 200 || videoPreview.getAttribute('data-value') === 'false') {
            uploadBtn.disabled = true;
        } else {
            uploadBtn.disabled = false;
        }


        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = "";
        previewVideo.style.display = "";
        videoPreview.style.border = '2px solid #9d0208';
        previewDefaultImage.style.display = "block";
        previewDefaultWarning.style.display = 'none';
        previewDefaultNecessary.style.display = 'flex';
        videoPreview.setAttribute('data-value', 'false');
        uploadBtn.disabled = true;
    }
});

forFileInput.addEventListener("dragover", (e) => {
    e.preventDefault();

    videoPreview.style.backgroundColor = '#145ca063';
    videoPreview.style.border = '5px dashed #262626a9';
    videoPreview.style.color = '#262626a9';
    previewDefaultImage.style.display = "none";
    previewDefaultWarning.style.display = 'none';
    previewDefaultNecessary.style.display = 'none';
});

forFileInput.addEventListener("dragleave", (e) => {
    e.preventDefault();

    videoPreview.style.backgroundColor = 'transparent';
    videoPreview.style.border = '1px solid #ced4da';
    videoPreview.style.color = '#cccccc';
    previewDefaultImage.style.display = "block";
    previewDefaultWarning.style.display = 'none';
    previewDefaultNecessary.style.display = 'none';
});

forFileInput.addEventListener("drop", function (e) {
    e.preventDefault();

    // Title
    let title = titleInput.value;
    title = title.trim();


    // Description
    let description = descriptionInput.value;
    description = description.trim();

    // File
    fileInput.files = e.dataTransfer.files;
    let file = fileInput.files[0];

    // Get the type of the file
    let fileType = file.type;

    if (fileType !== 'video/mp4') {
        previewDefaultText.style.display = "";
        previewVideo.style.display = "";
        videoPreview.style.backgroundColor = 'transparent';
        videoPreview.style.border = '2px solid #9d0208';
        previewDefaultWarning.style.display = 'flex';
        previewDefaultImage.style.display = "block";
        return;
    }

    if (file) {
        let reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewVideo.style.display = "block";
        videoPreview.style.backgroundColor = 'transparent';
        videoPreview.style.border = '2px solid #52b69a';
        previewDefaultImage.style.display = "none";
        previewDefaultWarning.style.display = 'none';
        previewDefaultNecessary.style.display = 'none';


        reader.onload = function (e) {
            previewVideo.setAttribute('src', this.result);
        };

        videoPreview.setAttribute('data-value', 'true');

        if (title.length < 5 || title.length > 41 || description.length < 10 || description.length > 200 || videoPreview.getAttribute('data-value') === 'false') {
            uploadBtn.disabled = true;
        } else {
            uploadBtn.disabled = false;
        }

        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = "";
        previewVideo.style.display = "";
        videoPreview.style.border = '1px solid #ced4da';
        previewDefaultImage.style.display = "block";
        videoPreview.setAttribute('data-value', 'false');
        uploadBtn.disabled = true;
    }
});

// Title Input
titleInput.addEventListener('keyup', function () {
    // Title
    let title = titleInput.value;
    title = title.trim();

    // Description
    let description = descriptionInput.value;
    description = description.trim();

    if (title.length < 5 || title.length > 41) {
        titleInput.style.border = '2px solid #9d0208';
        titleValid.style.display = 'none';
        titleInvalid.style.display = 'flex';
        titleInvalidMessage.style.display = 'flex';

        uploadBtn.disabled = true;
    } else {
        titleInput.style.border = '2px solid #52b69a';
        titleInvalid.style.display = 'none';
        titleInvalidMessage.style.display = 'none';
        titleValid.style.display = 'flex';

        // Check description input & file input
        if (description.length < 10 || description.length > 201 || videoPreview.getAttribute('data-value') === 'false') {
            uploadBtn.disabled = true;
        } else {
            uploadBtn.disabled = false;
        }
    }
});

// Description Input
descriptionInput.addEventListener('keyup', () => {
    // Description
    let description = descriptionInput.value;
    description = description.trim();

    // Title
    let title = titleInput.value;
    title = title.trim();

    if (description.length < 10 || description.length > 201) {
        descriptionInput.style.border = '2px solid #9d0208';
        descriptionValid.style.display = 'none';
        descriptionInvalid.style.display = 'flex';
        descriptionInvalidMessage.style.display = 'flex';

        uploadBtn.disabled = true;
    } else {
        descriptionInput.style.border = '2px solid #52b69a';
        descriptionInvalid.style.display = 'none';
        descriptionInvalidMessage.style.display = 'none';
        descriptionValid.style.display = 'flex';

        // Check title input & file input
        if (title.length < 5 || title.length > 41 || videoPreview.getAttribute('data-value') === 'false') {
            uploadBtn.disabled = true;
        } else {
            uploadBtn.disabled = false;
        }
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



