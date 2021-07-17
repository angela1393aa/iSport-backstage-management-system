/////////////////////// showVideoList.php //////////////////////////////
let table = document.getElementById('videoTableItems');
let searchInput = document.getElementById('searchInput');
let totalVideos = document.getElementById('totalVideos');
let categorySelect = document.getElementById('categorySelect');
let thead = document.querySelector('.thead');
let thCategory = document.querySelector('th-category');

// Execute to get videos and options
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
        style = 'cursor:pointer; background-color: aliceblue;' class='videoItem'>
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
}

// When executing getVideo(), the videos data will be pass into this function and execute it immideiately
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

    // Sort the options, put the options into a temperary array
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
        noVideo.style.display = "none";

        if (value === '0') {
            if (video.innerText.indexOf(keyword) > -1) {
                // InnerText contains this keyword
                video.style.display = "";

            } else {
                video.style.display = "none";
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }

        } else {
            if (video.innerText.indexOf(keyword) > -1 && video.childNodes[7].dataset.id === value) {
                // InnerText contains this keyword & category is selected
                video.style.display = "";

            } else {
                video.style.display = "none";
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }
        }
    });
    // Update the number of the videos
    totalVideos.innerText = `共有 ${total - hiddenVideo} 部影片`;
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
        noVideo.style.display = "none";

        if (value === '0') {
            if (video.innerText.indexOf(keyword) > -1) {
                // InnerText contains this keyword
                video.style.display = "";

            } else {
                video.style.display = "none";
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }

        } else {
            if (video.innerText.indexOf(keyword) > -1 && video.childNodes[7].dataset.id === value) {
                // InnerText contains this keyword & category is selected
                video.style.display = "";

            } else {
                video.style.display = "none";
                hiddenVideo++;

                // When the hiddenVideos equal all videos
                if (hiddenVideo === videoItems.length) {
                    thead.style.opacity = ".7";
                    categorySelect.style.opacity = ".7";
                    noVideo.style.display = "table-row";

                }
            }
        }
    });
    // Update the number of the videos
    totalVideos.innerText = `共有 ${total - hiddenVideo} 部影片`;
}




