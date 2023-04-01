
const url = window.location.href;
if (url.indexOf("msg=Y") > 0) {

    setTimeout(function () {
        document.getElementById("alert").style.display = "block";
    }, 1);
}
if (url.indexOf("msg=Y") > 0) {
    setTimeout(function () {
        document.getElementById("alert").style.display = "none";
    }, 4000);
}


var playBtn = document.getElementById('userdata');
var  resetBtn = document.getElementById('login-button1');
var  middleBtn = document.getElementById('login-button2');
var soundclick = document.getElementById('soundclick');
var audios = document.querySelectorAll('audio');

playBtn.addEventListener('mouseover', function () {
  [].forEach.call(audios, function (audio) {
      // do whatever
      audio.play();
  });
}, false);

playBtn.addEventListener('mouseleave', function () {
  soundclick.pause();
  soundclick.currentTime = 0;
}, false);

resetBtn.addEventListener('mouseover', function () {
  soundclick.play();
}, false);

resetBtn.addEventListener('mouseleave', function () {
  soundclick.pause();
  soundclick.currentTime = 0;
}, false);

middlebtn.addEventListener('mouseleave', function () {
  soundclick.pause();
}, false);

middlebtn.addEventListener('mouseleave', function () {
  soundclick.pause();
  soundclick.currentTime = 0;
}, false);

