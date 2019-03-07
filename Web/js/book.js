let flipbook = document.getElementById('flipbook');
let contentDiv = document.getElementById('contentDiv');
let firstPage = document.getElementById('firstPage');
let insideFirstPage = firstPage.firstChild

let textToAddToSvg = ''
let svgTextAndBalises = [] // should also register the spaces
let svgBalise = []
let singleBalise = ""
let baliseNotToRegister = false;
let cmptString = 0;
let weEnteredInABalise = false
let pageWhereToAddContent = insideFirstPage
let weHadABR = false;
weAreOnTheFirstPage = true;
let contentDivHtml = contentDiv.innerHTML
let lengthContent = contentDiv.innerHTML.length
let regexSpace = new RegExp(/^\s+$/)

for (let index = 0; index < lengthContent; index++) { // on parcourt chaque caractère de ce qui est écrit dans content

    singleBalise.includes('script') ? singleBalise = "" : ""; // being careful with the JS

    if (weEnteredInABalise) {
        singleBalise = singleBalise + contentDivHtml[index]
    }

    if (singleBalise === '</') {
        baliseNotToRegister = true;
        svgBalise.pop() // delete the last element of the table
    }

    if (singleBalise === '<br>') {
        weHadABR = true;
        weEnteredInABalise = false;
        singleBalise = ""

        for (let index = 0; index < 18; index++) {
            cmptString = cmptString + 1 // chercher le nombre de caractères pour un br
            if (cmptString < 1520) {
                textToAddToSvg = textToAddToSvg + ' ';
            }
        }
    }

    if (contentDivHtml[index] === '>' && !weHadABR) {
        weEnteredInABalise = false
        if (!baliseNotToRegister) { // if it works it is normal to have a text area who is empty, it means, all the balises has been closed
            svgBalise.push(singleBalise)
        }
        baliseNotToRegister = false;
        svgTextAndBalises.push(singleBalise)
        singleBalise = ""
    }

    if (contentDivHtml[index] === '<') {
        singleBalise = contentDivHtml[index]
        weEnteredInABalise = true;
        svgTextAndBalises.push(textToAddToSvg)
        textToAddToSvg = '';
    }

    if (!weEnteredInABalise && contentDivHtml[index] !== '>' && !regexSpace.test(contentDivHtml[index])) { // here there were an issue because we took the > when weEnteredInABalise was false
        textToAddToSvg = textToAddToSvg + contentDivHtml[index]
        cmptString++;
    }

    if (regexSpace.test(contentDivHtml[index]) && !weEnteredInABalise) {
        svgTextAndBalises.push(textToAddToSvg)
        svgTextAndBalises.push(contentDivHtml[index])
        textToAddToSvg = '';
    }

    // Faudrait que je compte chaque espace et que je splice
    if (cmptString > 1520) { // here we cut the text, it is where start the problems ^^

        for (let index = 0; index < svgTextAndBalises.length; index++) { // REVOIR CA ET AUSSI LE RESTE (balise html, coupe etc...)
            pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgTextAndBalises[index]
        }
        if (svgBalise) { // si certaines balises ne sont pas fermées, les rajouter à la fin en modifiant svgbalise par des balises fermantes
            for (let index = 0; index < svgBalise.length; index++) {
                //pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgBaliseModifiedWithEnd[index];
            }
        }

        // A RAJOUTER
        // on rajoute les balises fermantes manquantes à la fin puis on crée une autre page en dessous avec au départ les balises encore en svg
        // ne pas oublier de gérer les mots coupés en 2 aussi et les balises coupées en 2
        // gérer le html et ce que j'ai écrit dans le portable...

        let newPage = document.createElement('div')
        newPage.classList.add('page')
        let newInsideDiv = document.createElement('div')
        newInsideDiv.classList.add('insidePage')
        newPage.appendChild(newInsideDiv)
        flipbook.appendChild(newPage)
        pageWhereToAddContent = newInsideDiv

        pageWhereToAddContent.innerHTML = ""
        cmptString = 0
        // console.log(svgTextAndBalises)
        svgTextAndBalises.length = 0
    }

    weHadABR = false

}

if (cmptString < 1520) { // last page
    for (let index = 0; index < svgTextAndBalises.length; index++) { // REVOIR CA ET AUSSI LE RESTE (balise html, coupe etc...)
        pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgTextAndBalises[index]
    }
    if (svgBalise) { // si certaines balises ne sont pas fermées, les rajouter à la fin en modifiant svgbalise par des balises fermantes
        for (let index = 0; index < svgBalise.length; index++) {
            //pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgBaliseModifiedWithEnd[index];
        }
    }
    /* let newPage = document.createElement('div') // create a last blank page if we want
    newPage.classList.add('page')
    let newInsideDiv = document.createElement('div')
    newInsideDiv.classList.add('insidePage')
    newPage.appendChild(newInsideDiv)
    flipbook.appendChild(newPage) */
}

/* console.log(svgTextAndBalises) */
/* console.log(svgBalise) */
contentDiv.innerHTML = "";