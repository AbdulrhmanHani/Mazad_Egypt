/* Start Scroll Top */
scrollBtn = document.querySelector('.scroll-btn');
window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
        scrollBtn.classList.add('active');
    } else {
        scrollBtn.classList.remove('active');
    }
});
scrollBtn.addEventListener('click', function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    })
});
/* End Scroll Top */

/* Start Choose Mode*/
let chooseMode = document.querySelector(".choose-mode");

chooseMode.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    if (document.body.classList.contains("dark-mode")) {
        chooseMode.innerHTML = `<i class="fas fa-sun sun"></i>`;
        document.querySelector(".logo").src = "assets/images/LOGO 2.png";
        document.querySelector(".message h4").style.color = "#fff";
    } else {
        chooseMode.innerHTML = `<i class="fas fa-moon"></i>`;
        document.querySelector(".logo").src = "assets/images/LOGO.png";
        document.querySelector(".message h4").style.color = "#000";

    }
});
/* End Choose Mode*/

//--- Start Add Details Auction  ---
let addAuction = document.querySelector(".box");
let addDetailsAuction = document.querySelector(".add-details-auction");
let username = document.querySelector(".user");
let overlayBackground = document.querySelector(".overlay-background");
let buttonAddAuction = document.querySelector("#button-add-auction");
let buttonCancelAuction = document.querySelector("#button-cancel-auction");

addAuction.addEventListener("click", () => {
    addDetailsAuction.style.display = "block";
    overlayBackground.classList.add("active");
});


// Cancel Add Auction
buttonCancelAuction.addEventListener("click", () => {
    addDetailsAuction.style.display = "none";
    overlayBackground.classList.remove("active");
});
document.onkeyup = (e) => {
    if (e.key === "Escape") {
        addDetailsAuction.style.display = "none";
        overlayBackground.classList.remove("active");
        addDetailsUser.style.display = "none";
        addDetailsUser.style.display = "none";
    }
};

// Add Details User
let addDetailsUser = document.querySelector(".add-details-user");
buttonAddAuction.addEventListener("click", () => {
    addDetailsAuction.style.display = "none";
    addDetailsUser.style.display = "block";
});

let btnBack = document.querySelector(".add-details-user form .buttons button");


btnBack.addEventListener("click", (e) => {
    e.preventDefault();
    addDetailsUser.style.display = "none";
    addDetailsAuction.style.display = "block";

});
//---  End Add Details Auction  ---

/* Start Section Auctions */
let auctions = document.querySelector(".auctions");

let btnJoinAuction = document.querySelector(".join-auction");

btnJoinAuction.addEventListener("click", () => {
    overlayBackground.classList.add("active");
    document.querySelector(".add-data-user").style.display = "block";
});

let btnCancelJoinAuction = document.querySelector("#cancel-join-auction");
btnCancelJoinAuction.addEventListener("click", (e) => {
    e.preventDefault();
    document.querySelector(".add-data-user").style.display = "none";
    overlayBackground.classList.remove("active");
});

// Count text Description
let descProduct = document.querySelector(".desc-product");
let count = document.querySelector(".count");
let progress = document.querySelector(".progress");
let maxLength = descProduct.getAttribute("maxlength");

count.innerHTML = maxLength;

descProduct.oninput = function () {

    count.innerHTML = maxLength - this.value.length;
    if (count.innerHTML == 0) {
        count.classList.add("zero");
        progress.classList.add("progress-end");
    } else {
        count.classList.remove("zero");
        progress.classList.remove("progress-end");
    }

    // Set The Progress
    progress.style.width = `${(this.value.length * 100) / maxLength}%`;

};

/* End Section Auctions */
