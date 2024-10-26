$("#get-words").on("click", async (e) => {
    const numOfWords = $("input#n-words").val();

    if (!numOfWords) {
        alert("Huh! insert a number, nigga");
        return;
    }
    $(e.target).attr("disabled", "disabled");

    const resp = await fetch(
        `https://random-word-api.herokuapp.com/word?number=${numOfWords}`
    );

    /** @type {string[]} */
    const words = await resp.json();

    $("#target-div").text(words.join(" "));

    $(e.target).removeAttr("disabled");
});
