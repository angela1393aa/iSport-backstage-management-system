/////////////////////// showVideoList.php //////////////////////////////
let uploadSuccessMessage = document.getElementById('uploadSuccessMessage');
uploadSuccessMessage = new bootstrap.Modal(uploadSuccessMessage);

// If come from uploadVideo, this will show
if ($('.show-popup').length > 0) {
    uploadSuccessMessage.show();
}

let table = document.getElementById('videoTableItems');
let searchInput = document.getElementById('searchInput');
let totalVideos = document.getElementById('totalVideos');
let categorySelect = document.getElementById('categorySelect');
let rowCountSelect = document.getElementById('rowCountSelect');
let thead = document.querySelector('.thead');
let thCategory = document.querySelector('th-category');

// // Execute to get videos and options
getVideos();

// Get the promise from axios and put into table
async function getVideos() {
    let promise = await axios.get('api/Video/loadVideos.php');
    let videos = promise.data.videoData;

    // Get the number of total videos
    let total = videos.length;

    // Get the options to select
    showOptions(videos);

    videos.forEach(video => {
        // Format description
        let description = video.description.replace(/\n/g, '<br />');

        // Create tbody interval
        let videoItem = `<tr onclick = 'document.location="showVideo.php?id=${video.id}";'
        style = 'cursor:pointer; background-color: aliceblue;' class='videoItem' data-show='true' data-page=''>
            <td class='px-3 py-3 td-pic'>
                <img class='pic' src='${video.thumbnail}'>
                                    </td>
                <td class='px-2 py-3 td-title'>
                    ${video.title}
                </td>
                <td class='px-3 py-3 td-description'>
                    <div style='max-height: 118px; overflow: scroll;'>
                        ${description}
                    </div>
                </td>
                <td class='px-2 py-3 td-category' data-id='${video.category_id}'>
                    ${video.category_name}
                </td>
                <td class='px-2 py-3 td-duration'>
                    ${video.duration}
                </td>
                <td class='px-2 py-3 td-upload_date'>
                    ${video.upload_date}
                </td>
                <td class='px-2 py-3 td-views'>
                    ${video.views}
                </td>
            </tr>`;

        table.innerHTML += videoItem;
    });

    // NoVideo row
    let noVideo = `<tr style = 'background-color: #cf4747be; display: none;' id='noVideo'>
                                        <td class='px-3 py-3 td-pic'>
                                            <img class='pic'>
                                        </td>
                                        <td class='px-2 py-3 td-title'>
                                        </td>
                                        <td class='px-3 py-3 td-description'>
                                        <div style='max-height: 118px; overflow: scroll;'>
                                            沒有影片資料，試試其他關鍵字
                                        </div>
                                        </td>
                                        <td class='px-2 py-3 td-category'>
                                        </td>
                                        <td class='px-2 py-3 td-duration'>
                                        </td>
                                        <td class='px-2 py-3 td-upload_date'>
                                        </td>
                                        <td class='px-2 py-3 td-views'>
                                        </td>
                                    </tr>`;

    table.innerHTML += noVideo;

    // Update the number of the videos
    totalVideos.innerText = `共有 ${total} 部影片`;
    pageButtons();
}

// When executing getVideo(), the videos data will be pass into this function and execute it immediately
function showOptions(videos) {
    let categories = [];
    let ids = [];
    for (let i = 0; i < videos.length; i++) {
        let category = videos[i].category_name;
        let id = videos[i].category_id;

        if (categories.indexOf(category) === -1) {
            categories.push(category);
        }
        if (ids.indexOf(id) === -1) {
            ids.push(id);
        }
    }
    let options = `<option value='0' selected>
                        所有分類
                    </option>`;

    // Sort the options, put the options into a temporary array
    let tpmArr = [];

    for (let i = 0; i < categories.length; i++) {
        let id = ids[i];
        let category = categories[i];
        tpmArr[i] += `<option value='${id}'>${category}</option>`;
    }

    // Sort it by value
    tpmArr.sort();
    tpmArr.forEach(arr => {
        options += arr;
    });
    categorySelect.innerHTML += options;
}

// Live search
searchInput.addEventListener('keyup', () => {
    // Get the rows after created
    let videoItems = document.querySelectorAll('.videoItem');

    // Get the number of total videos
    let total = videoItems.length;

    // Get the value of search bar and trim the space if there was
    let keyword = searchInput.value.trim();

    // Set a variable to get the number of hidden videos
    let hiddenVideo = 0;

    // Get value from categorySelect
    value = categorySelect.value;

    // Select noVideo row
    let noVideo = document.getElementById('noVideo');

    videoItems.forEach(video => {
        thead.style.opacity = "1";
        categorySelect.style.opacity = "1";
        rowCountSelect.style.opacity = "1";
        noVideo.style.display = "none";

        if (value === '0') {
            if (video.innerText.indexOf(keyword) > -1) {
                // InnerText contains this keyword
                video.style.display = "";
                video.setAttribute('data-show', 'true');

            } else {
                video.style.display = "none";
                video.setAttribute('data-show', 'false');
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    rowCountSelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }

        } else {
            if (video.innerText.indexOf(keyword) > -1 && video.childNodes[7].dataset.id === value) {
                // InnerText contains this keyword & category is selected
                video.style.display = "";
                video.setAttribute('data-show', 'true');

            } else {
                video.style.display = "none";
                video.setAttribute('data-show', 'false');
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    rowCountSelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }
        }
    });
    // Update the number of the videos
    totalVideos.innerText = `共有 ${total - hiddenVideo} 部影片`;
    pageButtons();
});


// Sorting function (onclick)
let sortDirection;
function sortable(th) {
    // Convert direction
    sortDirection = !sortDirection;

    // Get data-value from th
    let i = th.getAttribute('data-value');

    //Get videos from table
    let videoItems = document.querySelectorAll('.videoItem');

    // Make videoItems into Array from htmlcollection
    let rowsArrFromNodeList = Array.from(videoItems);

    // Filter the video that had been hidden
    let filteredRow = rowsArrFromNodeList.filter(
        item => item.style.display !== "none"
    );

    filteredRow
        .sort((a, b) => {
            return a.childNodes[i].innerHTML.localeCompare(
                b.childNodes[i].innerHTML
            );
        })
        .forEach(row => {
            sortDirection
                ? table.insertBefore(row, table.childNodes[table.length])
                : table.insertBefore(row, table.childNodes[0]);
        });


    // Set entity again
    let order = th.getAttribute('data-order');
    let text = th.textContent;

    // Clear up the entity
    text = text.substring(0, text.length - 1);

    if (order === 'desc') {
        th.setAttribute('data-order', 'asc');
        text += '&#9660;';

    } else {
        th.setAttribute('data-order', 'desc');
        text += '&#9650;';

    };

    // Put the entity back to column
    th.innerHTML = text;
}

// Select function (onclick)
function selectOption() {
    let videoItems = document.querySelectorAll('.videoItem');

    // Get the number of total videos
    let total = videoItems.length;

    // Get value of searchInput and filter again
    let keyword = searchInput.value.trim();

    // Set a variable to get the number of hidden videos
    let hiddenVideo = 0;

    // Get value from categorySelect
    value = categorySelect.value;

    videoItems.forEach(video => {
        thead.style.opacity = "1";
        categorySelect.style.opacity = "1";
        rowCountSelect.style.opacity = "1";
        noVideo.style.display = "none";

        if (value === '0') {
            if (video.innerText.indexOf(keyword) > -1) {
                // InnerText contains this keyword
                video.style.display = "";
                video.setAttribute('data-show', 'true');

            } else {
                video.style.display = "none";
                video.setAttribute('data-show', 'false');
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    rowCountSelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }

        } else {
            if (video.innerText.indexOf(keyword) > -1 && video.childNodes[7].dataset.id === value) {
                // InnerText contains this keyword & category is selected
                video.style.display = "";
                video.setAttribute('data-show', 'true');

            } else {
                video.style.display = "none";
                video.setAttribute('data-show', 'false');
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    rowCountSelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }
        }
    });
    // Update the number of the videos
    totalVideos.innerText = `共有 ${total - hiddenVideo} 部影片`;
    pageButtons();
}

// Row count set as 5 at first
let size = 5;
// Change row count when selected
function selectRowCount(value) {
    size = value;
    pageButtons();
}

let pagination = document.getElementById('pagination');

// When executing getVideo(), the videos data will be pass into this function and execute it immediately
function pageButtons() {
    // Get amount of data
    let videoItems = document.querySelectorAll('.videoItem');
    // Make a container
    let videoShow = [];
    videoItems.forEach(video => {
        if (video.getAttribute('data-show') === 'true') {
            videoShow.push(video);
        }
    });

    // How many page
    let pages = Math.ceil(videoShow.length / size);

    // Set data-page
    for (let i = 1; i <= pages; i++) {
        numStart = (i - 1) * size;
        numEnd = i * size;

        let j = numStart;
        while (j < numEnd) {
            if (videoShow[j] === undefined) {
                // When there are not enough videos in the last page
                break;
            }
            videoShow[j].setAttribute('data-page', i);
            j++;
        }
    }

    // Show page 1 at first
    videoShow.forEach(video => {
        // console.log(video.getAttribute('data-page'));
        if (video.getAttribute('data-page') === '1') {
            video.style.display = '';
        } else {
            video.style.display = 'none';
        }
    });

    pagination.innerHTML = '';
    pagination.innerHTML += '<li class=""><button id="lastButton" type="button" class="btn btn-danger" onclick="changeButton(this.id)"><span aria-hidden="true"><i class="fas fa-caret-left"></i></span></button></li>';
    for (let i = 1; i <= pages; i++) {
        if (i > 3) {
            pagination.innerHTML += `<li class="page-item numberButton"><button type="button" class="btn btn-warning" onclick="show(this)" data-num="${i}">${i}</button></li>`;
        } else {
            pagination.innerHTML += `<li class="page-item numberButton show"><button type="button" class="btn btn-warning" onclick="show(this)" data-num="${i}">${i}</button></li>`;
        }
    }
    pagination.innerHTML += '<li class=""><button id="nextButton" type="button" class="btn btn-danger" onclick="changeButton(this.id)"><span aria-hidden="true"><i class="fas fa-caret-right"></i></span></button></li>';
}

let currentPage = 0;
function show(page) {
    currentPage = page.getAttribute('data-num');

    // Get amount of data
    let videoItems = document.querySelectorAll('.videoItem');
    // Make a container
    let videoShow = [];
    videoItems.forEach(video => {
        if (video.getAttribute('data-show') === 'true') {
            videoShow.push(video);
        }
    });

    videoShow.forEach(video => {
        if (video.getAttribute('data-page') === currentPage) {
            video.style.display = '';
        } else {
            video.style.display = 'none';
        }
    });

}
let currentMax = 2;
let currentMin = 0;
function changeButton(buttonId) {
    let numberButton = document.querySelectorAll('.numberButton');


    if (buttonId === 'nextButton') {
        numberButton[currentMax].nextSibling.classList.add('show');
        numberButton[currentMin].classList.remove('show');
        currentMax++;
        currentMin++;
    }
}