/** @type {string[]} */
let sentence;
/** @type {number} */
let sentenceLen;

let pos = 0;
let correct = 0;
let mistakes = 0;
/** @type {number} */
let numOfWords;

let wordsTyped = 0;

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
    $("#word-counter").text("");
    $("#key-input").attr("readonly", "readonly");
    const targetDiv = $("#target-div");

    numOfWords = Number($("input#n-words").val());
    $("#word-counter").text(`${wordsTyped}/${numOfWords}`);

    if (!numOfWords || numOfWords <= 0) {
        alert("Huh! insert a number!");
        return;
    }
    $(e.target).attr("disabled", "disabled");

    const resp = await fetch(
        `https://random-word-api.vercel.app/api?words=${numOfWords}`
    );

    /** @type {string[]} */
    const words = await resp.json();
    sentence = words.join(" ").split("");
    sentenceLen = sentence.length;
    correct = pos = mistakes = wordsTyped = 0;
    targetDiv.text(words.join(" "));

    $("#key-input").removeAttr("readonly");
    $("#key-input").trigger("focus").val("");

    $(e.target).removeAttr("disabled");
});

$("#key-input").on("keydown", ({ key, target }) => {
    if (IGNORE_KEYS.includes(key)) return;
    if (sentence[pos] === key) correct++;

    if (key !== "Backspace" && sentence[pos] === key) {
        ++pos;
    } else if (sentence[pos] !== key && key === "Backspace") {
        ++mistakes;
    }

    if (key === " " || key === "Enter") {
        $("#word-counter").text(`${++wordsTyped}/${numOfWords}`);
    }

    if (key === "Enter") {
        const accuracy = Math.round((correct / sentenceLen) * 100);
        const time = $("#timer-target").text();
        let [min, sec] = time.split(":");
        [min, sec] = [Number(min), Number(sec)];

        let totalMinutes = sec / 60;
        if (min > 0) totalMinutes += min;

        const typed = $(target).val().split(" ").length;
        const wpm = Math.round(typed / totalMinutes);

        $("#results").html(`
            <h4 class="mt-5">Accuracy: ${accuracy}%</h4>
            <h4>WPM: ${wpm}</h4>
            <h4>Mistakes: ${mistakes}</h4>
        `);

        $(target).trigger("blur");
        $("html, body").animate(
            {
                scrollTop: $("#results").offset().top,
            },
            2000
        );
    }
});
