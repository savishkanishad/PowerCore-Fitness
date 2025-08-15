

function makeResponsive() {
    const baseFontSize = 16; // px
    const minWidth = 320;
    const maxWidth = 1200;
    const minFontSize = 12;
    const maxFontSize = 24;

    function adjustFontSize() {
        const width = window.innerWidth;
        let fontSize =
            baseFontSize +
            ((width - minWidth) / (maxWidth - minWidth)) * (maxFontSize - minFontSize);

        fontSize = Math.max(minFontSize, Math.min(maxFontSize, fontSize));
        document.body.style.fontSize = fontSize + "px";
    }

    window.addEventListener("resize", adjustFontSize);
    adjustFontSize();
}

makeResponsive();