var params = new URLSearchParams(window.location.search);

function loadPage() {
    
    //console.log("CloudServer ID: " + params.get('id'));
    var json = getJson(params.get('id'));
    document.getElementById('servername').innerHTML = json.name;

    //Stats
    updateStats();

    //Information
    document.getElementById('info-id').innerHTML = json.id;
    document.getElementById('info-port').innerHTML = json.port;
    document.getElementById('info-node').innerHTML = json.node;
    document.getElementById('info-group').innerHTML = json.group;


}

function updateStats() {
    var json = getJson(params.get('id'));
    document.getElementById('players').innerHTML = document.getElementById('players').innerHTML.replace("{onlinePlayer}", json.stats['player']).replace("{maxPlayer}", json.slots);
    document.getElementById('cpu').innerHTML = document.getElementById('cpu').innerHTML.replace("{cpuUsage}", json.stats['cpu'] + "%");
    document.getElementById('ram').innerHTML = document.getElementById('ram').innerHTML.replace("{ramUsage}", json.stats['memory']).replace("{maxRam}", json.memory);
    document.getElementById('tps').innerHTML = document.getElementById('tps').innerHTML.replace("{currentTPS}", json.stats['tps']);

    var percent = 230 * json.stats['player'] / json.slots;
    document.getElementById('server-stats-bar-slots').style.width = percent + "px";

    percent = 230 * json.stats['cpu'] / 100;
    document.getElementById('server-stats-bar-cpu').style.width = percent + "px";

    percent = 230 * json.stats['memory'] / json.memory;
    document.getElementById('server-stats-bar-ram').style.width = percent + "px";

    percent = 230 * (1 - json.stats['tps'] / 20);
    document.getElementById('server-stats-bar-tps').style.width = percent + "px";

}


function getJson(id) {
    return readTextFile('/rustmc/web/cloud/cloudserver.json'); //TODO: Get Informations from the Cloud
}

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