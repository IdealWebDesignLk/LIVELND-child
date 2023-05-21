// setting up header video
window.addEventListener('load',()=>{
    document.getElementById('kd-main-youtube-video').src="https://www.youtube.com/embed/X0N22PMdF1U?enablejsapi=1&rel=0&start=18&mute=1&autoplay=1&modestbranding=1"


    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('kd-main-youtube-video', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady() {
        console.log("hey Im ready");
        //do whatever you want here. Like, player.playVideo();
    }

    function onPlayerStateChange() {
        console.log("my state changed");
    }

    let videoStarted = 0

})