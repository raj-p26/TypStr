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

let userID = localStorage.getItem("user_id");
let hasCustomText = false;

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
    /** @type {string} */
    const customText = $("#custom-text").val();
    $("#results").html("");
    $("#word-counter").text("");
    $("#key-input").attr("readonly", "readonly");
    const targetDiv = $("#target-div");
    /** @type {string[]} */
    let words;
    correct = pos = mistakes = wordsTyped = 0;

    if (!customText) {
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

        words = await resp.json();
        words = words.join(" ");
    } else {
        words = customText;
        numOfWords = customText.split(" ").length;
        hasCustomText = true;
    }
    sentence = words.split("");
    sentenceLen = sentence.length;
    targetDiv.text(words);

    $("#key-input").removeAttr("readonly");
    $("#key-input").trigger("focus").val("");

    $(e.target).removeAttr("disabled");
});

$("#key-input").on("keydown", async ({ key, target }) => {
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
        const complete = Math.round((typed / numOfWords) * 100);

        if (userID) {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            let data = {
                accuracy,
                wpm,
                mistakes,
                completed: complete,
                user_id: userID,
                num_of_words: numOfWords,
                record_type: hasCustomText ? "Custom Text" : "Randomized Text",
                _token: csrfToken,
            };

            const resp = await fetch("http://localhost:8000/records", {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json",
                },
            });
            console.log(resp.body);
        }

        $("#results").html(`
            <h4 class="mt-5">Accuracy: ${accuracy}%</h4>
            <h4>WPM: ${wpm}</h4>
            <h4>Mistakes: ${mistakes}</h4>
            <h4>Completed: ${complete}%</h4>
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
