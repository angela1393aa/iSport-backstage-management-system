/////////////////////// showVideo.php //////////////////////////////
let searchParams = new URLSearchParams(window.location.search);
let id = searchParams.get('id');
let updateForm = document.getElementById('updateForm');
let titleInput = document.getElementById('titleInput');
let fileInput = document.getElementById('fileInput');
let descriptionInput = document.getElementById('descriptionInput');
let categoryInput = document.querySelectorAll('.categoryInput');

// Get the promise from axios
async function getOneVideo() {
    let promise = await axios.get('api/Video/loadOneVideo.php?id=' + id);
    let video = promise.data;

    titleInput.value = `${video.title}`;
    // fileInput.value = `${video.filePath}`;
    descriptionInput.value = `${video.description}`;

    categoryInput.forEach(option => {
        if (option.value == `${video.category_id}`) {
            option.selected = true;
            return;
        }
    });

};
getOneVideo();

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

function updateVideo() {
    // title = titleInput.value;
    // filePath = fileInput.value;
    // description = descriptionInput.value;
    // category = categoryInput.value;

    // console.log(title);
    // console.log(filePath);
    // console.log(description);
    // console.log(category);




    // let config = {
    //     'Content-Type': 'multipart/form-data'
    // };
    // axios.put('api/Video/updateVideo.php', {
    //     id: `${id}`,
    //     title: `${title}`,
    //     filePath: `${filePath}`,
    //     description: `${description}`,
    //     category: `${category}`,
    // }, config)
    //     // .then(location.href = 'showVideoList.php');
    //     .then(
    //         res => console.log(res)
    //     );
}

updateForm.addEventListener('submit', function (e) {
    let formData = new FormData(updateForm);
    // console.log(updateForm.files);
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }
    // console.log(data);
    e.preventDefault();

});


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
