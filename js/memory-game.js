const gameCards = document.querySelectorAll(".memory-card");
const scoreDiv = document.querySelector("#score")
let flippedCard = false;
let finishGame = false;
let firstCard, secCard;
let attempts = 0;
document.getElementById("attempts").innerHTML = attempts + " tentativas";


let timer = {
    seconds: 0,
    minutes: 0,
    hours: 0
};

function calcPoints(numberOfAttempts) {
    let timePoints = 1000 - timer.seconds;
    if (timePoints < 0) {
        timePoints = 0;
    }

    let attemptsPoints = 1000 - (numberOfAttempts * 10);
    if (attemptsPoints < 0) {
       attemptsPoints = 0
    }

    let totalPoints = timePoints + attemptsPoints;

    return totalPoints;
}


console.log(gameCards);



function updateTimer() {
    timer.seconds++

    formattedSeconds = (timer.seconds < 10) ? "0" + timer.seconds + " s" : timer.seconds + " s";

    let gameTimer = formattedSeconds;

    console.log(timer.seconds);
    
    document.getElementById("timer").innerHTML = gameTimer;
}

function startCronometer() {

    start = setInterval(updateTimer, 1000); // Inicia o cronômetro automaticamente
}

function pauseCronometer() {
    clearInterval(start)
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
    attempts++; // Incrementa o número de tentativas
    document.getElementById("attempts").innerHTML = attempts + " tentativas"; 
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
        if (document.querySelectorAll('.memory-card:not(.flipped)').length == 0) {
            finishGame = true;
            pauseCronometer();
            setTimeout(() => {
                scoreDiv.classList.remove("invisible")
                totalPoints = calcPoints(attempts);
                document.getElementById("score").innerHTML= "Total de pontos: "+totalPoints;
            }, 1000);
        }
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








