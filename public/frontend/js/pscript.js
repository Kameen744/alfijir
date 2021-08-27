// window.onload = function () {
//     console.log('window loaded');
//     var file = document.getElementById("thefile");
//     var playButton = document.getElementById('playButton');
//     var audio = new Audio();

//     playButton.onclick = function () {

//         console.log('play clicked');
//         // var files = this.files;
//         audio.src = 'zarafi.mp3';
//         audio.load();
//         audio.play();
//         var context = new AudioContext();
//         var src = context.createMediaElementSource(audio);
//         var analyser = context.createAnalyser();

//         var canvas = document.getElementById("range");
//         canvas.width = window.innerWidth;
//         canvas.height = window.innerHeight;
//         var ctx = canvas.getContext("2d");

//         src.connect(analyser);
//         analyser.connect(context.destination);

//         analyser.fftSize = 256;

//         var bufferLength = analyser.frequencyBinCount;
//         console.log(bufferLength);

//         var dataArray = new Uint8Array(bufferLength);

//         var WIDTH = canvas.width;
//         var HEIGHT = canvas.height;

//         var barWidth = (WIDTH / bufferLength) * 2.5;
//         var barHeight;
//         var x = 0;

//         function renderFrame() {
//             requestAnimationFrame(renderFrame);

//             x = 0;

//             analyser.getByteFrequencyData(dataArray);

//             ctx.fillStyle = "#000";
//             ctx.fillRect(0, 0, WIDTH, HEIGHT);

//             for (var i = 0; i < bufferLength; i++) {
//                 barHeight = dataArray[i];

//                 var r = barHeight + (25 * (i / bufferLength));
//                 var g = 250 * (i / bufferLength);
//                 var b = 50;

//                 ctx.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
//                 ctx.fillRect(x, HEIGHT - barHeight, barWidth, barHeight);

//                 x += barWidth + 1;
//             }
//         }

//         audio.play();
//         renderFrame();
//     };
// };

window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;

window.onload = function () {
    var playAudio = document.getElementById('playButton');
    audio = new Audio('https://stream.zenolive.com/hcpkdf28ya0uv.aac');
    playAudio.onclick = function () {

        if (audio.paused) {

            // audio = new Audio('https://stream.zenolive.com/hcpkdf28ya0uv.aac');
            // audio = new Audio('https://node-28.zeno.fm/hcpkdf28ya0uv.aac?rj-ttl=5&rj-tok=AAABdKxMePUAZ21OfKH5B_wKSw');
            var ctx = new AudioContext();
            var analyser = ctx.createAnalyser();
            var audioSrc = ctx.createMediaElementSource(audio);

            // we have to connect the MediaElementSource with the analyser 
            audioSrc.connect(analyser);
            analyser.connect(ctx.destination);
            // we could configure the analyser: e.g. analyser.fftSize (for further infos read the spec)
            // analyser.fftSize = 64;
            // frequencyBinCount tells you how many values you'll receive from the analyser
            var frequencyData = new Uint8Array(analyser.frequencyBinCount);

            // we're ready to receive some data!
            var canvas = document.getElementById('range'),
                cwidth = canvas.width,
                cheight = canvas.height - 2,
                meterWidth = 6, //width of the meters in the spectrum
                gap = 2, //gap between meters
                capHeight = 2,
                capStyle = '#fff',
                meterNum = 800 / (10 + 2), //count of the meters
                capYPositionArray = []; ////store the vertical position of hte caps for the preivous frame
            ctx = canvas.getContext('2d'),
                gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(1, '#F36621');
            gradient.addColorStop(0.5, 'rgba(255, 255, 255, 1)');
            gradient.addColorStop(0, '#F36621');
            // loop
            function renderFrame() {
                var array = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(array);
                var step = Math.round(array.length / meterNum); //sample limited data from the total array
                ctx.clearRect(0, 0, cwidth, cheight);
                for (var i = 0; i < meterNum; i++) {
                    var value = array[i * step];
                    if (capYPositionArray.length < Math.round(meterNum)) {
                        capYPositionArray.push(value);
                    };
                    ctx.fillStyle = capStyle;
                    //draw the cap, with transition effect
                    if (value < capYPositionArray[i]) {
                        ctx.fillRect(i * 12, cheight - (--capYPositionArray[i]), meterWidth, capHeight);
                    } else {
                        ctx.fillRect(i * 12, cheight - value, meterWidth, capHeight);
                        capYPositionArray[i] = value;
                    };
                    ctx.fillStyle = gradient; //set the filllStyle to gradient for a better look
                    ctx.fillRect(i * 12 /*meterWidth+gap*/, cheight - value + capHeight, meterWidth, cheight); //the meter
                }
                requestAnimationFrame(renderFrame);
            }
            renderFrame();
            audio.play();
            playAudio.innerHTML = '<i class="fa fa-pause"></i>';
        } else {
            audio.pause();
            playAudio.innerHTML = '<i class="fa fa-play"></i>';
        }

    }
};
