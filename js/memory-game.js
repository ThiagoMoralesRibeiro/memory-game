const gameCards = document.querySelectorAll(".memory-card");
let flippedCard = false;
let finishGame = false;
let firstCard, secCard;

console.log(gameCards);

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
    console.log(secCard);
    matchCards();

}

function matchCards() {
    if (firstCard.dataset.number == secCard.dataset.number) {
        desactivateCards();
    }
    else {
        console.log('potato');
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






