

var deferredPrompt;


if (!window.Promise) {
  window.Promise = Promise;
}

if ('serviceWorker' in navigator) {
  navigator.serviceWorker
    .register('sw.js')
    .then(function () {
      console.log('Service worker registered!');
    })
    .catch(function (err) {
      console.log(err);
    });
}




window.addEventListener('beforeinstallprompt', function (event) {
  console.log('beforeinstallprompt fired');
  // event.preventDefault();
  deferredPrompt = event;
  return false;
});








var find_files = document.querySelector('#find_files');


if (find_files != null) {

  //find_files.addEventListener('click', installAppIcon);

  var show_file = document.querySelector('.show_file');

  if (show_file != null) {

    show_file.addEventListener('click', installAppIcon);
  }

}
function installAppIcon() {

  console.log(deferredPrompt + " prom")

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
}
