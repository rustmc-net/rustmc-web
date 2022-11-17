var selectetID = null;

function onPageLoad() {

    var color_picker_primary = document.getElementById("color-picker-primary");
    var color_picker_primary_wrapper = document.getElementById("color-picker-wrapper-primary");
    color_picker_primary.onchange = function() {
	    color_picker_primary_wrapper.style.backgroundColor = color_picker_primary.value;    
    }
    color_picker_primary_wrapper.style.backgroundColor = color_picker_primary.value;

    var color_picker_secondary = document.getElementById("color-picker-secondary");
    var color_picker_secondary_wrapper = document.getElementById("color-picker-wrapper-secondary");
    color_picker_secondary.onchange = function() {
	    color_picker_secondary_wrapper.style.backgroundColor = color_picker_secondary.value;    
    }
    color_picker_secondary_wrapper.style.backgroundColor = color_picker_secondary.value;

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