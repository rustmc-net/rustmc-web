
json = readTextFile('./assets/theme/theme.json')
var root = document.querySelector(':root');

if(json.dark) {
    root.style.setProperty('--backgroundColor', 'rgb(44,47,51)');
    root.style.setProperty('--defaultFontColor', '#FCFCFD');
}

root.style.setProperty('--colorFirst', json.colorFirst);
root.style.setProperty('--colorSecond', json.colorSecond);


function readTextFile(file)
{
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