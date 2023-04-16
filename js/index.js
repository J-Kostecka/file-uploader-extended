document.querySelectorAll(".data-wrapper tbody > tr").forEach(row => {
    row.addEventListener('click', event => {
        if (row.classList.contains("clicked-row")) {
            row.classList.remove("clicked-row");
        }
        else {
            row.classList.add("clicked-row");
        }
    });
});

document.getElementById("uploadedFile").addEventListener("change", function () {
    document.querySelector(".form-wrapper label").innerHTML = this.value.replace(/.*[\/\\]/, '');
});