var selectetID = null;

function onPageLoad() {
    selectSetting("theme");
}

function selectSetting(id) {
    if(selectetID != null) {
        document.getElementById(selectetID).classList.remove("selectet");
        document.getElementById(selectetID).classList.add("unselect");
        document.getElementById("settings-content-" + selectetID).style.visibility = "hidden";
    }
    selectetID = id;
    document.getElementById(id).classList.add("selectet");
    document.getElementById(id).classList.remove("unselect");
    document.getElementById("settings-content-" + id).style.visibility = "visible";
}