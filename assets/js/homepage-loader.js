// setting up header video
var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('kd-main-youtube-video', {
            videoId: 'X0N22PMdF1U',
            playerVars: {
                'autoplay': 1,
                'loop' : 1,
                'start' : 1,
                'rel' : 0,
                'mute' : 1
              },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        console.log("hey Im ready");
        event.target.playVideo();
        //do whatever you want here. Like, player.playVideo();
    }

    function onPlayerStateChange() {
        console.log("my state changed");
    }

    let videoStarted = 0
