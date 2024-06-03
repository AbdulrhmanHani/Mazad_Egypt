let inputMessage = document.querySelector("textarea");
let count = document.querySelector(".count");
let progress = document.querySelector(".progress");
let maxLength = inputMessage.getAttribute("maxlength");

count.innerHTML = maxLength;

inputMessage.oninput = function() {

    count.innerHTML = maxLength - this.value.length;
    if (count.innerHTML == 0) {
        count.classList.add("zero");
        progress.classList.add("progress-end");
    } else {
        count.classList.remove("zero");
        progress.classList.remove("progress-end");
    }

    // Set The Progress
    progress.style.width = `${(this.value.length * 50) / maxLength}%`;
};