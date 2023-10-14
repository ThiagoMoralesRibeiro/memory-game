const gameCards = document.querySelectorAll(".memory-card");
let flippedCard = false;
let finishGame = false;
let firstCard, secCard;

console.log(gameCards);


let timer = {
    seconds: 0,
    minutes: 0,
    hours: 0
};

function updateTimer() {
    timer.seconds++

    formattedSeconds = (timer.seconds < 10) ? "0" + timer.seconds : timer.seconds;
    formattedMinutes = (timer.minutes < 10) ? "0" + timer.minutes : timer.minutes;
    formattedHours = (timer.hours < 10) ? "0" + timer.hours : timer.hours;

    let gameTimer = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;

    if (timer.seconds == 60) {
        timer.seconds = 0;
        timer.minutes++;
    }

    if (timer.minutes == 60) {
        timer.minutes = 0;
        timer.hours++;
    }

    document.getElementById("timer").innerHTML = gameTimer;
}

function startCronometer() {

    setInterval(updateTimer, 1000); // Inicia o cronômetro automaticamente
}

startCronometer();

function flip() {
    if (finishGame) {
        return;
    }
    if (this == firstCard) {
        return;
    }

    this.classList.add('flipped');
    console.log(this);

    if (!flippedCard) {
        flippedCard = true;
        firstCard = this;

        return;
    }

    secCard = this;
    matchCards();

}

function matchCards() {
    if (firstCard.dataset.number == secCard.dataset.number) {
        desactivateCards();
    }
    else {
        unflip();
    }

}

function desactivateCards() {
    firstCard.removeEventListener('click', flip);
    secCard.removeEventListener('click', flip);

    reset();
}

function unflip() {
    finishGame = true;
    setTimeout(() => {
        firstCard.classList.remove('flipped');
        secCard.classList.remove('flipped');

        reset();
    }, 1000);
}

function reset() {
    flippedCard = false;
    finishGame = false;
    firstCard = null;
    secCard = null;
}

for (let i = 0; i < gameCards.length; i++) {
    const element = gameCards[i];
    element.addEventListener("click", flip);

}








