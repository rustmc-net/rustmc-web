var chached_username = null;

function openEdit(username) {
    if(chached_username != null) {
        document.getElementById(chached_username.id).style.height = "100%";
        document.getElementById(chached_username.id + "_username").style.visibility = "hidden";
        document.getElementById(chached_username.id + "_rank").style.visibility = "hidden";
        document.getElementById(chached_username.id + "_permission").style.visibility = "hidden";
        document.getElementById(chached_username.id + "_save").style.visibility = "hidden";
        chached_username = null;
    }
    document.getElementById(username.id).style.height = "400px";
    document.getElementById(username.id + "_username").style.visibility = "visible";
    document.getElementById(username.id + "_rank").style.visibility = "visible";
    document.getElementById(username.id + "_permission").style.visibility = "visible";
    document.getElementById(username.id + "_save").style.visibility = "visible";
    document.cookie = "currentedituser=" + username.id;
    chached_username = username;
}
function openAddGUI() {
    document.getElementById("add_popup").style.visibility = "visible";
}
function closeAddGUI() {
    document.getElementById("add_popup").style.visibility = "hidden";
}