let seconds = 0;
let minutes = 0;
// let stopped = false;

import { IGNORE_KEYS } from "./getWords.js";

/** @type {number} */
let intervalID;

// const IGNORE_KEYS = [
//     "Home",
//     "Backspace",
//     "End",
//     "Alt",
//     "PageUp",
//     "PageDown",
//     "AltGraph",
//     "ArrowUp",
//     "ArrowDown",
//     "ArrowLeft",
//     "ArrowRight",
//     "Control",
//     "Delete",
//     "Insert",
//     "Escape",
//     "Tab",
// ];

function stopwatch() {
    if (seconds === 60) {
        minutes++;
        seconds = 0;
    }
    seconds++;
    stringifyTimer();
}

$("#key-input")
    .on("keydown", (e) => {
        if (IGNORE_KEYS.includes(e.key)) return;

        if (!intervalID) {
            intervalID = setInterval(stopwatch, 1000);
        }

        if (intervalID && e.key === "Enter") {
            seconds = 0;
            minutes = 0;
            clearInterval(intervalID);
            intervalID = null;
        }

        stringifyTimer();
    })
    .on("blur", () => {
        if (intervalID) {
            seconds = 0;
            minutes = 0;
            clearInterval(intervalID);
            intervalID = null;
        }
    });

function stringifyTimer() {
    let secondsStr = seconds < 10 ? `0${seconds}` : seconds;
    let minutesStr = minutes < 10 ? `0${minutes}` : minutes;

    $("#timer-target").text(`${minutesStr}:${secondsStr}`);
}
