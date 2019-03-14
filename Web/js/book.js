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
let needToAddSvgTagInNewSvgTextAndTag = false
let weHaveAComment = false


for (let index = 0; index < lengthContent; index++) { // we run through the content
    singleTag.includes('<script>') ? singleTag = "" : ""; // being careful with the JS

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
        tagNotToRegister = true
        svgTag.pop() // delete the last element of the table
    }

    if (singleTag === '<br>' || singleTag === '</br>' || singleTag === '<p' || singleTag === '</p>') { // sometimes it is a br, sometimes it is a p who have a bottom margin
        for (let index = 0; index < 83; index++) {
            cmptString = cmptString + 1 
        }
    }

    if(singleTag === '<br>' || singleTag === '<br />' || singleTag === '<br/>'){
        weHadABR = true
        singleTag = ""
        weEnteredInATag = false
    }

    if(singleTag === '<!--'){
        weHaveAComment = true
    }

    if(singleTag.includes('-->')){
        singleTag = ""
        weHaveAComment = false
    }

    if (contentDivHtml[index] === '>' && !weHadABR && !weHaveAComment) {
        weEnteredInATag = false
        if (!tagNotToRegister) { // if it works it is normal to have a text area who is empty, it means, all the Tags has been closed
            svgTag.push(singleTag)
        }
        tagNotToRegister = false
        svgTextAndTags.push(singleTag)
        singleTag = ""
    }

    if (contentDivHtml[index] === '<') {
        singleTag = contentDivHtml[index]
        weEnteredInATag = true;
        svgTextAndTags.push(textToAddToSvg)
        textToAddToSvg = '';
    }

    if (contentDivHtml[index] === ' ' && !weEnteredInATag) {
        svgTextAndTags.push(textToAddToSvg)
        svgTextAndTags.push(contentDivHtml[index])
        textToAddToSvg = '';
    }

    if (!weEnteredInATag && contentDivHtml[index] !== '>') { // here there were an issue because we took the > when weEnteredInATag was false
        textToAddToSvg = textToAddToSvg + contentDivHtml[index]
        cmptString++ // we can't be in the middle of a Tag because we don't count them
    }

    if (cmptString > 1800) { // we can't be in the middle of a Tag because we don't count them
        let stringAllText = '';
        for (let index = 0; index < svgTextAndTags.length; index++) {
            stringAllText = stringAllText + svgTextAndTags[index]
        }
        pageWhereToAddContent.innerHTML = stringAllText

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
        needToAddSvgTagInNewSvgTextAndTag = true // allow to keep the Tags which haven't been closed and put them in the start of the new page (see the beginning of the function)
    }

    weHadABR = false

}

if (cmptString < 1800) { // last page
    let stringAllText = '';
    for (let index = 0; index < svgTextAndTags.length; index++) {
        stringAllText = stringAllText + svgTextAndTags[index]
    }
    pageWhereToAddContent.innerHTML = stringAllText
}