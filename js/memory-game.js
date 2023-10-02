const gameCards = document.querySelectorAll(".memory-card");
let flippedCard = false;
let finishGame = false;
let firstCard, secCard;

console.log(gameCards);

function flip() {
    gameCards.forEach(e => {
        if (finishGame) {
            return;
        }
        if (e == firstCard) {
            return;
        }

        e.classList.add('flipped');
        console.log('1');

        if (!flippedCard) {
            flippedCard = true;
            firstCard = e;
        }

        secCard = e;
        matchCards();
    });
}

function matchCards() {
    if (firstCard.dataset.number == secCard.dataset.number) {
        deactivateCards();
    }
    else{
        unflip();
    }

}

function deactivateCards() { 
    firstCard.removeEventListener('click', flip);
    secCard.removeEventListener('click', flip);

    reset();
}

function unflip() { 
    finishGame = true;
    setTimeout(()=>{
        firstCard.classList.remove('flipped');
        secondCard.classList.remove('flipped');

        reset();
    }, 1000);
}

function reset(){
    flippedCard = false;
    finishGame = false;
    firstCard = null;
    secondCard = null;
}

gameCards.forEach(cards => {
    cards.addEventListener('click', flip);
});


    

