document.querySelector("input[name=username]")
    .addEventListener("input", onInput);

function onInput(e) {
    // 1.
    const name = e.target.value;
    // 2.
    ajax({
        mod: "get",
        url: "ajax/reg.php",
        getadat: `name=${name}`,
        siker: onSuccess
    });
}

function onSuccess(xhr, responseText) {
    // 6.
    console.log(responseText);
    // const {response} = JSON.parse(responseText);
    // const success = response.success;
    // 7.
    const { success } = JSON.parse(responseText);
    const span = document.querySelector("input[name=username]+span");
    span.innerHTML = success ? "pipa" : "X";
}