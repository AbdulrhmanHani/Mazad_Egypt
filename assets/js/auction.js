let countDownDate = new Date(`${document.querySelector(".time-end").value}`).getTime();


let counter = setInterval(() => {
    // Get Date Now
    let dateNow = new Date().getTime();

    // Find The Date Difference Between Now And Countdown Date
    let dateDiff = countDownDate - dateNow;

    // Get Time Units

    let days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
    let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);


    document.querySelector(".days").innerHTML = days < 10 ? `0${days}` : days;
    document.querySelector(".hours").innerHTML = hours < 10 ? `0${hours}` : hours;
    document.querySelector(".minutes").innerHTML = minutes < 10 ? `0${minutes}` : minutes;
    document.querySelector(".seconds").innerHTML = seconds < 10 ? `0${seconds}` : seconds;

    if (dateDiff < 0) {
        clearInterval(counter);
        document.querySelector(".time").innerHTML = `<input type="text" style="display:none;" value="0000">`;
        document.querySelector(".auctionEnded").innerHTML = `<input type="text" hidden name="auctionEnded" value="0000">`;
    }
}, 1000);