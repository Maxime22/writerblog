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
let needToAddSvgBaliseInNewSvgTextAndBalise = false

for (let index = 0; index < lengthContent; index++) { // on parcourt chaque caractère de ce qui est écrit dans content
    singleBalise.includes('script') ? singleBalise = "" : ""; // being careful with the JS

    if (needToAddSvgBaliseInNewSvgTextAndBalise) { // for the new pages (starting from the 2nd), we put all the balise who were still opened in the start of our new table svgTextAndBalises
        needToAddSvgBaliseInNewSvgTextAndBalise = false
        for (let index = 0; index < svgBalise.length; index++) {
            svgTextAndBalises[index] = svgBalise[index];

        }
        svgBalise.length = 0
    }

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

        for (let index = 0; index < 82; index++) {
            cmptString = cmptString + 1 // chercher le nombre de caractères pour un br
            if (cmptString < 2100) {
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
        cmptString++; // we can't be in the middle of a balise because we don't count them
    }

    if (regexSpace.test(contentDivHtml[index]) && !weEnteredInABalise) {
        svgTextAndBalises.push(textToAddToSvg)
        svgTextAndBalises.push(contentDivHtml[index])
        textToAddToSvg = '';
    }

    // Faudrait que je compte chaque espace et que je splice
    if (cmptString > 2100) { // we can't be in the middle of a balise because we don't count them
        let stringAllText = '';
        for (let index = 0; index < svgTextAndBalises.length; index++) {
            stringAllText = stringAllText + svgTextAndBalises[index]
        }
        let allBaliseLeft = ''
        for (let index = 0; index < svgBalise.length; index++) {
            allBaliseLeft = stringAllText + svgBalise[index]
        }

        /* if (svgBalise) { // si certaines balises ne sont pas fermées, les rajouter à la fin en modifiant svgbalise par des balises fermantes ? Peut être que innerHTML ferme les balises
            for (let index = 0; index < svgBalise.length; index++) {
                //pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgBaliseModifiedWithEnd[index];
            }
        } */
        pageWhereToAddContent.innerHTML = stringAllText // inner HTML semble fermer les balises ouvertes

        let newPage = document.createElement('div')
        newPage.classList.add('page')
        let newInsideDiv = document.createElement('div')
        newInsideDiv.classList.add('insidePage')
        newPage.appendChild(newInsideDiv)
        flipbook.appendChild(newPage)
        pageWhereToAddContent = newInsideDiv

        pageWhereToAddContent.innerHTML = ""
        cmptString = 0
        svgTextAndBalises.length = 0
        needToAddSvgBaliseInNewSvgTextAndBalise = true // allow to keep the balises whhich haven't been closed and put them in the start of the new page (see the beginning of the function)
    }

    weHadABR = false

}

if (cmptString < 2100) { // last page
    let stringAllText = '';
    for (let index = 0; index < svgTextAndBalises.length; index++) {
        stringAllText = stringAllText + svgTextAndBalises[index]
    }
    pageWhereToAddContent.innerHTML = stringAllText
}