function openEdit(username) {
    document.getElementById(username.id).style.height = "400px";
    document.getElementById(username.id + "_username").style.visibility = "visible";
    document.getElementById(username.id + "_rank").style.visibility = "visible";
    document.getElementById(username.id + "_permission").style.visibility = "visible";
    document.getElementById(username.id + "_save").style.visibility = "visible";
    document.cookie = "currentedituser=" + username.id;
}