/** @type {string[]} */
let sentence;
/** @type {number} */
let sentenceLen;

let pos = 0;
let correct = 0;
/** @type {number} */
let numOfWords;

export const IGNORE_KEYS = [
    "Home",
    "End",
    "Alt",
    "PageUp",
    "PageDown",
    "AltGraph",
    "ArrowUp",
    "ArrowDown",
    "ArrowLeft",
    "ArrowRight",
    "Control",
    "Delete",
    "Insert",
    "Escape",
    "Tab",
    "Shift",
];

$(() => {
    $("#get-words").trigger("click");
});

$("#get-words").on("click", async (e) => {
    $("#results").html("");
    const targetDiv = $("#target-div");

    numOfWords = Number($("input#n-words").val());

    if (!numOfWords || numOfWords <= 0) {
        alert("Huh! insert a number, nigga");
        return;
    }
    $(e.target).attr("disabled", "disabled");

    const resp = await fetch(
        `https://random-word-api.herokuapp.com/word?number=${numOfWords}`
    );

    /** @type {string[]} */
    const words = await resp.json();
    sentence = words.join(" ").split("");
    sentenceLen = sentence.length;
    correct = pos = 0;

    targetDiv.text(words.join(" "));

    $("#key-input").trigger("focus").val("");

    $(e.target).removeAttr("disabled");
});

$("#key-input").on("keydown", ({ key }) => {
    if (IGNORE_KEYS.includes(key)) return;

    if (sentence[pos] === key) {
        correct++;
    }

    if (key !== "Backspace" && sentence[pos] === key) {
        ++pos;
    }

    if (key === "Enter") {
        const accuracy = Math.round((correct / sentenceLen) * 100);
        const time = $("#timer-target").text();
        const [min, sec] = time.split(":");

        let totalMinutes = Number(sec) / 60;
        if (Number(min) > 0) {
            totalMinutes += Number(min);
        }
        const typed = $("#key-input").val().split(" ").length;
        const wpm = Math.round(typed / totalMinutes);

        $("#results").html(`
            Accuracy: ${accuracy}<br />
            WPM: ${wpm}
        `);
    }
});
