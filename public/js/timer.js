let seconds = 0;
let minutes = 0;
let stopped = false;

/** @type {number} */
let intervalID;

function setStopwatch() {
    if (seconds === 60) {
        minutes++;
        seconds = 0;
    }
    seconds++;
    stringifyTimer();
}

$("#timer").on("click", async () => {
    stringifyTimer();
    intervalID = setInterval(setStopwatch, 1000);
});

$("#stop-timer").on("click", async () => {
    if (!stopped) {
        clearInterval(intervalID);
        stopped = true;
    } else alert("Already Stopped");
});

$("#reset-timer").on("click", async () => {
    seconds = 0;
    minutes = 0;
    if (!intervalID) alert("Timer is not started yet");
    else stringifyTimer();
});

function stringifyTimer() {
    let secondsStr = seconds < 10 ? `0${seconds}` : seconds;
    let minutesStr = minutes < 10 ? `0${minutes}` : minutes;

    $("#timer-target").text(`${minutesStr}:${secondsStr}`);
}
