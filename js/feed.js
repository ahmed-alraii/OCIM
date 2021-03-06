/* var shareImageButton = document.querySelector('#share-image-button');
var createPostArea = document.querySelector('#create-post');
var closeCreatePostModalButton = document.querySelector('#close-create-post-modal-btn');
var sharedMomentsArea = document.querySelector('#shared-moments');

var form = document.querySelector('form');
var inputTitel = document.querySelector('#title');
var inputLocation = document.querySelector('#location');

var videoPlayer = document.querySelector('#player');
var canvasElement = document.querySelector('#canvas');
var captureButton = document.querySelector('#capture-btn');
var imagePicker = document.querySelector('#image-picker');
var imagePickerArea = document.querySelector('#pick-image');

var picture;

function initialzeMedia() {

    if (!('mediaDevices' in navigator)) {

        navigator.mediaDevices = {};
    }

    if (!('getUserMedia' in navigator.mediaDevices)) {

        navigator.mediaDevices.getUserMedia = function (constrains) {

            var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

            if (!getUserMedia) {

                return Promise.reject(new Error('GetUserMedia is not Implemented....'));
            }

            return new Promise(function (resolve, reject) {
                getUserMedia.call(navigator, constrains, resolve, reject);
            });

        }

    }



    var back_camera_constrains = {
        video: {
            width: 640,
            height: 480,
            facingMode: {
                exact: "environment"
            }
        }
    }

    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(function (stream) {
            videoPlayer.srcObject = stream;
            videoPlayer.style.display = 'block';
            captureButton.style.display = 'block';

        })
        .catch(function (err) {

            imagePickerArea.style.display = 'block';

        });
}

captureButton.addEventListener('click', function (event) {
    event.preventDefault();
    canvasElement.style.display = 'block';
    videoPlayer.style.display = 'none';
    captureButton.style.display = 'none';
    var context = canvasElement.getContext('2d');
    context.drawImage(videoPlayer, 0, 0, canvas.width, videoPlayer.videoHeight / (videoPlayer.videoWidth / canvas.width));

    videoPlayer.srcObject.getVideoTracks().forEach(function (track) {

        track.stop();

    });

    picture = dataURItoBlob(canvasElement.toDataURL());

});


// when the brower not suport camera go to file picker
imagePicker.addEventListener('change', function () {
    picture = event.target.files[0];
});

*/
/*

function openCreatePostModal() {
    createPostArea.style.display = 'block';
    // setTimeout(function () {
    createPostArea.style.transform = 'translateY(0)';

    initialzeMedia();

    // }, 1)

    if (deferredPrompt) {
        deferredPrompt.prompt();

        deferredPrompt.userChoice.then(function (choiceResult) {
            console.log(choiceResult.outcome);

            if (choiceResult.outcome === 'dismissed') {
                console.log('User cancelled installation');
            } else {
                console.log('User added to home screen');
            }
        });

        deferredPrompt = null;
    }

    // if ('serviceWorker' in navigator) {
    //   navigator.serviceWorker.getRegistrations()
    //     .then(function(registrations) {
    //       for (var i = 0; i < registrations.length; i++) {
    //         registrations[i].unregister();
    //       }
    //     })
    // }
}

function closeCreatePostModal() {
    createPostArea.style.transform = 'translateY(100vh)';
    imagePickerArea.style.display = 'none';
    videoPlayer.style.display = 'none';
    canvasElement.style.display = 'none';

    // stop video stream

    videoPlayer.srcObject.getVideoTracks().forEach(function (track) {
        track.stop();
    });

    // createPostArea.style.display = 'none';
}

shareImageButton.addEventListener('click', openCreatePostModal);

closeCreatePostModalButton.addEventListener('click', closeCreatePostModal);

// Currently not in use, allows to save assets in cache on demand otherwise
function onSaveButtonClicked(event) {
    console.log('clicked');
    if ('caches' in window) {
        caches.open('user-requested')
            .then(function (cache) {
                cache.add('https://httpbin.org/get');
                cache.add('/src/images/sf-boat.jpg');
            });
    }
}

function clearCards() {
    while (sharedMomentsArea.hasChildNodes()) {
        sharedMomentsArea.removeChild(sharedMomentsArea.lastChild);
    }
}


function updateUI(data) {
    clearCards();
    for (var i = 0; i < data.length; i++) {
        createCard(data[i]);
    }
}



function createCard(data) {
    var cardWrapper = document.createElement('div');
    cardWrapper.className = 'shared-moment-card mdl-card mdl-shadow--2dp';
    var cardTitle = document.createElement('div');
    cardTitle.className = 'mdl-card__title';
    cardTitle.style.backgroundImage = 'url(' + data.image + ')';
    cardTitle.style.backgroundSize = 'cover';
    cardTitle.style.height = '180px';
    cardWrapper.appendChild(cardTitle);
    var cardTitleTextElement = document.createElement('h2');
    cardTitleTextElement.style.color = 'white';
    cardTitleTextElement.className = 'mdl-card__title-text';
    cardTitleTextElement.textContent = data.title;
    cardTitle.appendChild(cardTitleTextElement);
    var cardSupportingText = document.createElement('div');
    cardSupportingText.className = 'mdl-card__supporting-text';
    cardSupportingText.textContent = data.location;
    cardSupportingText.style.textAlign = 'center';
    // var cardSaveButton = document.createElement('button');
    // cardSaveButton.textContent = 'Save';
    // cardSaveButton.addEventListener('click', onSaveButtonClicked);
    // cardSupportingText.appendChild(cardSaveButton);
    cardWrapper.appendChild(cardSupportingText);
    componentHandler.upgradeElement(cardWrapper);
    sharedMomentsArea.appendChild(cardWrapper);
}


var url = 'http://localhost:8881/CourseFile_Project_v2/get_courses.php.json';
var networkDataReceived = false;

fetch(url)
    .then(function (res) {
        return res.json();
    })
    .then(function (data) {
        networkDataReceived = true;
        console.log('From web', data);
        var dataArray = [];

        for (var key in data) {
            dataArray.push(data[key]);
        }
        updateUI(dataArray);
    });



if ('indexedDB' in window) {

    readAllData('courses')
        .then(function (data) {
            console.log('From cache ', data);
            updateUI(data);
        });

}

/*
function sendData() {

    var postData = new FormData();
    var id = new Date().toISOString();

    postData.append('id', id);
    postData.append('title', inputTitel.value);
    postData.append('location', inputLocation.value);
    postData.append('picture', picture, id + '.png');


    fetch('https://us-central1-pwagram-4e0c0.cloudfunctions.net/storePostData', {
            method: 'POST',
            body: postData,

        })
        .then(function (res) {
            console.log('data sent ', res)
            updateUI();


        })
}

form.addEventListener('submit', function (event) {

    event.preventDefault();

    if (inputTitel.value.trim() === '' || inputLocation.value.trim() === '') {

        alert('Please Enter All Data');

        return;


    }

    closeCreatePostModal();

    if ('serviceWorker' in navigator && 'SyncManager' in window) {

        navigator.serviceWorker.ready
            .then(function (sw) {

                var post = {
                    id: new Date().toISOString(),
                    title: inputTitel.value,
                    location: inputLocation.value,
                    picture: picture
                }

                writeData('sync-posts', post)
                    .then(function () {

                        return sw.sync.register('sync-new-post');

                    })
                    .then(function () {

                        var snackbarcontainer = document.querySelector('#confirmation-toast');

                        var data = {
                            message: 'your data are sync to be post'
                        };
                        snackbarcontainer.MaterialSnackbar.showSnackbar(data);
                    })
                    .catch(function (err) {
                        console.log(err)
                    })


            })
    } else {

        sendData();

    }


})

*/