json = readTextFile('/rustmc/assets/settings/theme.json')
var root = document.querySelector(':root');

if(json.dark) {
    root.style.setProperty('--backgroundColor', 'rgb(44,47,51)');
    root.style.setProperty('--backgroundDarkColor', 'rgb(35,39,42)');
    root.style.setProperty('--defaultFontColor', '#FCFCFD');
    root.style.setProperty('--iconInvert', '1');
    root.style.setProperty('--shadowColor', 'rgb(31, 31, 31)');
    root.style.setProperty('--hoverColor', 'rgb(204, 208, 211)');
    root.style.setProperty('--hoverShadow', 'rgba(241, 241, 241, 0.9)');
}
    
root.style.setProperty('--colorFirst', json.colorFirst);
root.style.setProperty('--colorSecond', json.colorSecond);

function readTextFile(file) {
    var rawFile = new XMLHttpRequest();
    var allText = "";
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                allText = rawFile.responseText;
            }
        }
    }
    rawFile.send(null);
    return JSON.parse(allText);
} 