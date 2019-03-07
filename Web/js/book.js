let flipbook = document.getElementById('flipbook');
let contentDiv = document.getElementById('contentDiv');
let firstPage = document.getElementById('firstPage');
let insideFirstPage = firstPage.firstChild

let textToAddToSvg = ''
let svgTextAndTags = [] // should also register the spaces
let svgTag = []
let singleTag = ""
let tagNotToRegister = false;
let cmptString = 0;
let weEnteredInATag = false
let pageWhereToAddContent = insideFirstPage
let weHadABR = false;
weAreOnTheFirstPage = true;
let contentDivHtml = contentDiv.innerHTML
let lengthContent = contentDiv.innerHTML.length
let regexSpace = new RegExp(/^\s+$/)
let needToAddSvgTagInNewSvgTextAndTag = false

for (let index = 0; index < lengthContent; index++) { // on parcourt chaque caractère de ce qui est écrit dans content
    singleTag.includes('script') ? singleTag = "" : ""; // being careful with the JS

    if (needToAddSvgTagInNewSvgTextAndTag) { // for the new pages (starting from the 2nd), we put all the Tag who were still opened in the start of our new table svgTextAndTags
        needToAddSvgTagInNewSvgTextAndTag = false
        for (let index = 0; index < svgTag.length; index++) {
            svgTextAndTags[index] = svgTag[index];

        }
        svgTag.length = 0
    }

    if (weEnteredInATag) {
        singleTag = singleTag + contentDivHtml[index]
    }

    if (singleTag === '</') {
        tagNotToRegister = true;
        svgTag.pop() // delete the last element of the table
    }

    if (singleTag === '<br>') {
        weHadABR = true;
        weEnteredInATag = false;
        singleTag = ""

        for (let index = 0; index < 82; index++) {
            cmptString = cmptString + 1 // chercher le nombre de caractères pour un br
            if (cmptString < 2100) {
                textToAddToSvg = textToAddToSvg + ' ';
            }
        }
    }

    if (contentDivHtml[index] === '>' && !weHadABR) {
        weEnteredInATag = false
        if (!tagNotToRegister) { // if it works it is normal to have a text area who is empty, it means, all the Tags has been closed
            svgTag.push(singleTag)
        }
        tagNotToRegister = false;
        svgTextAndTags.push(singleTag)
        singleTag = ""
    }

    if (contentDivHtml[index] === '<') {
        singleTag = contentDivHtml[index]
        weEnteredInATag = true;
        svgTextAndTags.push(textToAddToSvg)
        textToAddToSvg = '';
    }

    if (!weEnteredInATag && contentDivHtml[index] !== '>' && !regexSpace.test(contentDivHtml[index])) { // here there were an issue because we took the > when weEnteredInATag was false
        textToAddToSvg = textToAddToSvg + contentDivHtml[index]
        cmptString++; // we can't be in the middle of a Tag because we don't count them
    }

    if (regexSpace.test(contentDivHtml[index]) && !weEnteredInATag) {
        svgTextAndTags.push(textToAddToSvg)
        svgTextAndTags.push(contentDivHtml[index])
        textToAddToSvg = '';
    }

    // Faudrait que je compte chaque espace et que je splice
    if (cmptString > 2100) { // we can't be in the middle of a Tag because we don't count them
        let stringAllText = '';
        for (let index = 0; index < svgTextAndTags.length; index++) {
            stringAllText = stringAllText + svgTextAndTags[index]
        }
        for (let index = 0; index < svgTag.length; index++) {
            allTagLeft = stringAllText + svgTag[index]
        }

        /* if (svgTag) { // si certaines Tags ne sont pas fermées, les rajouter à la fin en modifiant svgTag par des Tags fermantes ? Peut être que innerHTML ferme les Tags
            for (let index = 0; index < svgTag.length; index++) {
                //pageWhereToAddContent.innerHTML = pageWhereToAddContent.innerHTML + svgTagModifiedWithEnd[index];
            }
        } */
        pageWhereToAddContent.innerHTML = stringAllText // inner HTML semble fermer les Tags ouvertes

        let newPage = document.createElement('div')
        newPage.classList.add('page')
        let newInsideDiv = document.createElement('div')
        newInsideDiv.classList.add('insidePage')
        newPage.appendChild(newInsideDiv)
        flipbook.appendChild(newPage)
        pageWhereToAddContent = newInsideDiv

        pageWhereToAddContent.innerHTML = ""
        cmptString = 0
        svgTextAndTags.length = 0
        needToAddSvgTagInNewSvgTextAndTag = true // allow to keep the Tags whhich haven't been closed and put them in the start of the new page (see the beginning of the function)
    }

    weHadABR = false

}

if (cmptString < 2100) { // last page
    let stringAllText = '';
    for (let index = 0; index < svgTextAndTags.length; index++) {
        stringAllText = stringAllText + svgTextAndTags[index]
    }
    pageWhereToAddContent.innerHTML = stringAllText
}