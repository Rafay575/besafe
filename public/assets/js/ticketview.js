
const fileInput = document.getElementById('comment_attachment');
const filePreview = document.getElementById('filePreview');
const progressBar = document.getElementById('progressBar');
const removeFileBtn = document.getElementById('removeFileBtn');
let fileUrl = null;
var progress = 0;
function handleFileUpload() {
    const file = fileInput.files[0];
    if (file) {

        filePreview.style.display = 'flex';
        removeFileBtn.style.display = 'flex';
        fileUrl = URL.createObjectURL(file);
        // Simulate file upload progress
        simulateUploadProgress();
    }
}

function simulateUploadProgress() {

    const interval = setInterval(() => {
        progress += 10;
        progressBar.style.width = progress + '%';

        if (progress >= 100) {
            clearInterval(interval);
        }
    }, 300);
}
filePreview.onclick = function () {
    if (fileUrl && progress >= 100) {
        window.open(fileUrl, '_blank'); // Open the file in a new tab
    }
}

removeFileBtn.onclick = function () {
    fileInput.value = '';
    progress = 0;
    filePreview.style.display = 'none';
    removeFileBtn.style.display = 'none';
    progressBar.style.width = '0%';
};



function toggleCommentForm() {
    const commentForm = document.getElementById('commentForm');
    if (commentForm.classList.contains('d-none')) {
        commentForm.classList.remove('d-none');
    } else {
        commentForm.classList.add('d-none');
    }
}
$(document).ready(function () {
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function () {
        return $star_rating.each(function () {
            if (parseInt($('#rating').val()) >= parseInt($(this).data('rating'))) {
                return $(this).removeClass('fa-star-o').addClass('fa-star');
            } else {
                return $(this).removeClass('fa-star').addClass('fa-star-o');
            }
        });
    };

    $star_rating.on('click', function () {
        var rating = $(this).data('rating');
        $('#rating').val(rating);
        SetRatingStar();
    });

    SetRatingStar();
});

var review_open = false;
var other_open = true;  // Assuming "other-section" is initially open

function toggleSections() {
    const reviewSection = document.getElementById('rafay-section-1');
    const otherSection = document.getElementById('other-section');
    if (review_open) {
        reviewSection.style.display = 'none ';
        otherSection.style.display = 'block  ';
        review_open = false;
        other_open = true;
    } else {
        reviewSection.style.display = 'block ';
        otherSection.style.display = 'none ';
        review_open = true;
        other_open = false;
    }
}
let mediaRecorder;
let audioChunks = [];
let isRecording = false; // Declared globally
let timerInterval;
let seconds = 0;
let minutes = 0;
let stream; // Store the stream once microphone access is granted

const recordButton = document.getElementById("recordButton");
const recordIcon = document.getElementById("recordIcon");
const timerElement = document.getElementById("timer"); // Timer element
const audioPlayback = document.getElementById("audioPlayback");
const voiceNoteInput = document.getElementById("voiceNoteInput");
const voicepreview = document.getElementById("voicepreview");
const recordedTime = document.getElementById("recordedTime");
const removeVoiceBtn = document.getElementById("removeVoiceBtn");

voicepreview.onclick = function () {
    if (audioPlayback.paused) {
        try {
            audioPlayback.play(); // Play the audio
            voicepreview.classList.add("playing"); // Add the playing class
            removeVoiceBtn.style.display = "none";
        } catch (err) {
            console.error("Error playing the audio:", err);
        }
    } else {
        try {
            audioPlayback.pause(); // Pause the audio
            voicepreview.classList.remove("playing"); // Remove the playing class
            removeVoiceBtn.style.display = "flex";
        } catch (err) {
            console.error("Error pausing the audio:", err);
        }
    }
};

audioPlayback.onended = function () {
    try {
        voicepreview.classList.remove("playing"); // Remove the playing class to stop the animation
        removeVoiceBtn.style.display = "flex";
    } catch (err) {
        console.error("Error on audio ended:", err);
    }
};

// Function to request microphone access
async function getMicrophoneAccess() {
    try {
        if (!stream) {
            stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            console.log("Microphone access granted");
        }
        return stream; // Return the stream after access is granted
    } catch (err) {
        console.error("Microphone access denied:", err);
        alert("Microphone access is required to record audio.");
        throw err; // Throw an error to stop further execution
    }
}

// Function to start recording
recordButton.onclick = async function () {
    try {
        // Request microphone access before starting recording
        const micStream = await getMicrophoneAccess();

        if (!isRecording) {
            mediaRecorder = new MediaRecorder(micStream); // Use the stream with granted access
            mediaRecorder.start();

            recordButton.classList.add("active");
            recordIcon.classList.replace("fa-microphone", "fa-stop");

            audioChunks = [];

            mediaRecorder.ondataavailable = event => {
                audioChunks.push(event.data);
            };

            isRecording = true;
            timerElement.style.display = "block";
            seconds = 0;
            minutes = 0;
            updateTimer();
            startTimer(); // Start the timer
        } else {
            // Stop recording
            mediaRecorder.stop();
            console.log(seconds);

            mediaRecorder.onstop = async () => {
                try {
                    const audioBlob = new Blob(audioChunks, { type: "audio/mp3" });
                    const audioUrl = URL.createObjectURL(audioBlob);
                    audioPlayback.src = audioUrl;

                    // Convert audio blob to Base64 string to submit with the form
                    const reader = new FileReader();
                    reader.onloadend = function () {
                        voiceNoteInput.value = reader.result; // Set the hidden input value with base64 string
                    };
                    reader.readAsDataURL(audioBlob);
                } catch (err) {
                    console.error("Error processing the audio data:", err);
                }
            };

            recordButton.classList.remove("active");
            recordIcon.classList.replace("fa-stop", "fa-microphone");

            timerElement.style.display = "none";
            voicepreview.style.display = "flex";
            removeVoiceBtn.style.display = "flex";

            isRecording = false;
            stopTimer(); // Stop the timer
        }
    } catch (err) {
        console.error("Error during recording:", err);
    }
};

// Start the timer
function startTimer() {
    try {
        timerInterval = setInterval(() => {
            seconds++;
            if (seconds === 60) {
                seconds = 0;
                minutes++;
            }
            updateTimer();
        }, 1000);
    } catch (err) {
        console.error("Error starting the timer:", err);
    }
}

// Stop the timer
function stopTimer() {
    try {
        clearInterval(timerInterval);
    } catch (err) {
        console.error("Error stopping the timer:", err);
    }
}

// Update the timer display
function updateTimer() {
    try {
        const formattedMinutes = minutes < 10 ? `${minutes}` : minutes;
        const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
        timerElement.textContent = `${formattedMinutes}:${formattedSeconds}`;
    } catch (err) {
        console.error("Error updating the timer:", err);
    }
}

// Remove voice note functionality
removeVoiceBtn.onclick = function () {
    try {
        audioPlayback.pause();
        audioPlayback.currentTime = 0; // Pause the audio
        audioChunks = [];
        console.log('Pausing the audio');
        voiceNoteInput.value = '';
        voicepreview.style.display = 'none';
        removeVoiceBtn.style.display = 'none';
        recordedTime.textContent = '00:00'; // Reset the displayed time
    } catch (err) {
        console.error("Error removing the voice note:", err);
    }
};

// Timer for audio playback
audioPlayback.onplay = function () {
    try {
        // Start updating the timer when the audio starts playing
        audioPlayback.ontimeupdate = function () {
            const currentTime = Math.floor(audioPlayback.currentTime);
            const minutes = Math.floor(currentTime / 60);
            const seconds = currentTime % 60;

            recordedTime.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        };
    } catch (err) {
        console.error("Error during audio playback:", err);
    }
};


