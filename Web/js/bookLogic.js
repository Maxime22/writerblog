if (document.body) {
    /* var larg = (document.body.clientWidth);
    var haut = (document.body.clientHeight); */
    if (document.body.clientWidth > 1200) {
        $("#flipbook").turn({
            width: 1100,
            height: 600,
            autoCenter: true
        });
    } 
}

