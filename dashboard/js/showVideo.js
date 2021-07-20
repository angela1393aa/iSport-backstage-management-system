/////////////////////// showVideo.php //////////////////////////////
function _(element) {
    return document.getElementById(element);
}

// Main
let searchParams = new URLSearchParams(window.location.search);
let id = searchParams.get('id');

let updateForm = _('updateForm');

let titleInput = _('titleInput');
let titleInvalid = _('titleInvalid');
let titleInvalidMessage = _('titleInvalidMessage');
let titleValid = _('titleValid');

let fileInput = _('fileInput');

let descriptionInput = _('descriptionInput');
let descriptionInvalid = _('descriptionInvalid');
let descriptionValid = _('descriptionValid');
let descriptionInvalidMessage = _('descriptionInvalidMessage');

let categoryInput = document.querySelectorAll('.categoryInput');

let updateBtn = _('updateBtn');

// Video Input
let previewVideo = document.querySelector('.video-preview__video');
let videoPreview = _('videoPreview');

// Thumbnails
let selectedThumbnailPreview = _('selectedThumbnailPreview');
let thumbnailImage1 = _('thumbnailImage-1');
let thumbnailImage2 = _('thumbnailImage-2');
let thumbnailImage3 = _('thumbnailImage-3');

// Get the promise from axios
async function getOneVideo() {
    let promise = await axios.get('api/Video/loadOneVideo.php?id=' + id);
    let video = promise.data;

    titleInput.value = `${video.title}`;

    // Video
    previewVideo.src = `${video.filePath}`;

    // Thumbnails
    let selected;
    let selectedId;
    let notSelected = [];
    video.thumbnails.forEach(thumbnail => {
        if (thumbnail.selected == 1) {
            selected = thumbnail.filePath;
            selectedId = thumbnail.id;
        } else {
            notSelected.push(thumbnail.filePath);
        }
    });
    selectedThumbnailPreview.src = selected;
    selectedThumbnailPreview.setAttribute('data-id', selectedId);

    thumbnailImage1.src = `${video.thumbnails[0].filePath}`;
    thumbnailImage1.setAttribute('data-id', `${video.thumbnails[0].id}`);
    thumbnailImage2.src = `${video.thumbnails[1].filePath}`;
    thumbnailImage2.setAttribute('data-id', `${video.thumbnails[1].id}`);
    thumbnailImage3.src = `${video.thumbnails[2].filePath}`;
    thumbnailImage3.setAttribute('data-id', `${video.thumbnails[2].id}`);

    // Description
    descriptionInput.value = `${video.description}`;

    // Category
    categoryInput.forEach(option => {
        if (option.value == `${video.category_id}`) {
            option.selected = true;
            return;
        }
    });

};
getOneVideo();

thumbnailImage1.addEventListener('click', function () {
    selectedThumbnailPreview.src = this.src;
    selectedThumbnailPreview.setAttribute('data-id', this.getAttribute('data-id'));

});
thumbnailImage2.addEventListener('click', function () {
    selectedThumbnailPreview.src = this.src;
    selectedThumbnailPreview.setAttribute('data-id', this.getAttribute('data-id'));
});
thumbnailImage3.addEventListener('click', function () {
    selectedThumbnailPreview.src = this.src;
    selectedThumbnailPreview.setAttribute('data-id', this.getAttribute('data-id'));
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

        updateBtn.disabled = true;
    } else {
        titleInput.style.border = '2px solid #52b69a';
        titleInvalid.style.display = 'none';
        titleInvalidMessage.style.display = 'none';
        titleValid.style.display = 'flex';

        // Check description input & file input
        if (description.length < 10 || description.length > 201) {
            updateBtn.disabled = true;
        } else {
            updateBtn.disabled = false;
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

        updateBtn.disabled = true;
    } else {
        descriptionInput.style.border = '2px solid #52b69a';
        descriptionInvalid.style.display = 'none';
        descriptionInvalidMessage.style.display = 'none';
        descriptionValid.style.display = 'flex';

        // Check title input
        if (title.length < 5 || title.length > 41) {
            updateBtn.disabled = true;
        } else {
            updateBtn.disabled = false;
        }
    }
});

// Delete
function deleteVideo() {
    axios.put('api/Video/deleteVideo.php', {
        id: `${id}`
    })
        .then(
            setTimeout(() => {
                changeModalContent();
            }, 200)
        );
}
// Delete Button Content
function changeModalContent() {
    let h3Warning = document.querySelector('.h3-warning');
    let spWarning = document.querySelector('.sp-warning');
    let modalHeaderSuccess = document.querySelector('.modal-header.success');
    let imgWarning = document.querySelector('.img-warning');
    let h5Warning = document.querySelector('.h5-warning');
    let modalBodySuccess = document.querySelector('.modal-body.success');
    let btnWarning = document.querySelector('.botton-warning');
    let modalFooterSuccess = document.querySelector('.modal-footer.success');

    // Warning
    h3Warning.style.opacity = "0";
    h3Warning.style.visibility = "hidden";
    h3Warning.style.transform = "translateX(-300px)";
    spWarning.style.opacity = "0";
    spWarning.style.visibility = "hidden";


    setTimeout(() => {
        spWarning.style.display = "none";
    }, 400);

    imgWarning.style.opacity = "0";
    imgWarning.style.visibility = "hidden";
    imgWarning.style.transform = "translateX(-300px)";
    h5Warning.style.opacity = "0";
    h5Warning.style.visibility = "hidden";
    h5Warning.style.transform = "translateX(-300px)";

    btnWarning.style.opacity = "0";
    btnWarning.style.visibility = "hidden";

    // Success
    modalHeaderSuccess.style.opacity = "1";
    modalHeaderSuccess.style.visibility = "visible";
    modalHeaderSuccess.style.transform = "translateX(0)";

    modalBodySuccess.style.opacity = "1";
    modalBodySuccess.style.visibility = "visible";
    modalBodySuccess.style.transform = "translateX(0)";

    modalFooterSuccess.style.opacity = "1";
    modalFooterSuccess.style.visibility = "visible";
}

let updateSuccessMessage = _('updateSuccessMessage');
updateSuccessMessage = new bootstrap.Modal(updateSuccessMessage);
function updateVideo() {
    let thumbnailId;
    thumbnailId = selectedThumbnailPreview.getAttribute('data-id');
    title = titleInput.value;
    description = descriptionInput.value;

    let category;
    categoryInput.forEach(option => {
        if (option.selected == true) {
            category = option.value;
        }
    });

    axios.put('api/Video/updateVideo.php', {
        id: `${id}`,
        thumbnailId: `${thumbnailId}`,
        title: `${title}`,
        description: `${description}`,
        category: `${category}`,
    })
        // .then(location.href = 'showVideoList.php');
        .then(
            updateSuccessMessage.show()
        );
}