// setting up header video
var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
        console.log('onYouTubeIframeAPIReady');
        console.log(document.getElementById('kd-main-youtube-video'));
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

    window.addEventListener('load',()=>{
        let playBtn = document.getElementById('kd-play-video');
        let pauseBtn = document.getElementById('kd-pause-video');

        // play video
        playBtn.addEventListener('click' , ()=>{
            console.log(player)
            player.playVideo();
            playBtn.style.display = 'none';
            pauseBtn.style.display = 'block';
        })

        // pause video
        pauseBtn.addEventListener('click' , ()=>{
            console.log(player)
            player.pauseVideo();
            pauseBtn.style.display = 'none';
            playBtn.style.display = 'block';
        })
    })
