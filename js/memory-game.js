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

    formattedSeconds = (timer.seconds < 10) ? "0" + timer.seconds + " s" : timer.seconds + " s";

    let gameTimer = formattedSeconds;

    console.log(timer.seconds);
    
    document.getElementById("timer").innerHTML = gameTimer;
}

function startCronometer() {

    setInterval(updateTimer, 1000); // Inicia o cronômetro automaticamente
}

startCronometer();

//let timePoints = 1000 - timer.seconds;
//if (timePoints < 0) {
//    timePoints = 0;
//}

//let attemptsPoints = 1000 - (numberOfAttempts * 10);
//if (attemptsPoints < 0) {
//   attemptsPoints = 0
//}

//let totalPoints = timePoints + attemptsPoints;

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








