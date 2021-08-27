window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;

window.onload = function () {
    var playAudio = document.getElementById('playButton');
    audio = new Audio();
    // https://www.google.ie/gwt/x?u=[YourHttpLink]
    playAudio.onclick = function () {

        if (audio.paused) {

            // // audio = new Audio('https://stream.zenolive.com/hcpkdf28ya0uv.aac');
            // // audio = new Audio('https://node-28.zeno.fm/hcpkdf28ya0uv.aac?rj-ttl=5&rj-tok=AAABdKxMePUAZ21OfKH5B_wKSw');
            // var ctx = new AudioContext();
            // var analyser = ctx.createAnalyser();
            // var audioSrc = ctx.createMediaElementSource(audio);

            // // we have to connect the MediaElementSource with the analyser
            // audioSrc.connect(analyser);
            // analyser.connect(ctx.destination);
            // // we could configure the analyser: e.g. analyser.fftSize (for further infos read the spec)
            // // analyser.fftSize = 64;
            // // frequencyBinCount tells you how many values you'll receive from the analyser
            // var frequencyData = new Uint8Array(analyser.frequencyBinCount);

            // // we're ready to receive some data!
            // var canvas = document.getElementById('range'),
            //     cwidth = canvas.width,
            //     cheight = canvas.height - 2,
            //     meterWidth = 6, //width of the meters in the spectrum
            //     gap = 2, //gap between meters
            //     capHeight = 2,
            //     capStyle = '#fff',
            //     meterNum = 800 / (10 + 2), //count of the meters
            //     capYPositionArray = []; ////store the vertical position of hte caps for the preivous frame
            // ctx = canvas.getContext('2d'),
            //     gradient = ctx.createLinearGradient(0, 0, 0, 300);
            // gradient.addColorStop(1, '#F36621');
            // gradient.addColorStop(0.5, 'rgba(255, 255, 255, 1)');
            // gradient.addColorStop(0, '#F36621');
            // // loop
            // function renderFrame() {
            //     var array = new Uint8Array(analyser.frequencyBinCount);
            //     analyser.getByteFrequencyData(array);
            //     var step = Math.round(array.length / meterNum); //sample limited data from the total array
            //     ctx.clearRect(0, 0, cwidth, cheight);
            //     for (var i = 0; i < meterNum; i++) {
            //         var value = array[i * step];
            //         if (capYPositionArray.length < Math.round(meterNum)) {
            //             capYPositionArray.push(value);
            //         };
            //         ctx.fillStyle = capStyle;
            //         //draw the cap, with transition effect
            //         if (value < capYPositionArray[i]) {
            //             ctx.fillRect(i * 12, cheight - (--capYPositionArray[i]), meterWidth, capHeight);
            //         } else {
            //             ctx.fillRect(i * 12, cheight - value, meterWidth, capHeight);
            //             capYPositionArray[i] = value;
            //         };
            //         ctx.fillStyle = gradient; //set the filllStyle to gradient for a better look
            //         ctx.fillRect(i * 12 /*meterWidth+gap*/, cheight - value + capHeight, meterWidth, cheight); //the meter
            //     }
            //     requestAnimationFrame(renderFrame);
            // }
            // renderFrame();
            audio.src = 'https://stream.zeno.fm/mfrehf28ya0uv';
            audio.play();
            playAudio.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
            audio.pause();
            playAudio.innerHTML = '<i class="fa fa-play"></i>';
        }
    }
};
