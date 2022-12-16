var selectetID = null;

var color_picker_secondary = document.getElementById("color-picker-secondary");
var color_picker_secondary_wrapper = document.getElementById("color-picker-wrapper-secondary");

var color_picker_primary = document.getElementById("color-picker-primary");
var color_picker_primary_wrapper = document.getElementById("color-picker-wrapper-primary");

function onPageLoad() {

    color_picker_secondary = document.getElementById("color-picker-secondary");
    color_picker_secondary_wrapper = document.getElementById("color-picker-wrapper-secondary");

    color_picker_primary = document.getElementById("color-picker-primary");
    color_picker_primary_wrapper = document.getElementById("color-picker-wrapper-primary");

    color_picker_primary.onchange = function() {
	    color_picker_primary_wrapper.style.backgroundColor = color_picker_primary.value;    
    }
    color_picker_primary_wrapper.style.backgroundColor = color_picker_primary.value;

    
    color_picker_secondary.onchange = function() {
	    color_picker_secondary_wrapper.style.backgroundColor = color_picker_secondary.value;    
    }
    color_picker_secondary_wrapper.style.backgroundColor = color_picker_secondary.value;

    selectSetting("system");
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

function decimalToHexString(number)
{
  if (number < 0)
  {
    number = 0xFFFFFFFF + number + 1;
  }

  return number.toString(16).toUpperCase();
}


function reloadThemeInputs($primary,$secondary,$dark) {
    color_picker_secondary = document.getElementById("color-picker-secondary");
    color_picker_secondary_wrapper = document.getElementById("color-picker-wrapper-secondary");

    color_picker_primary = document.getElementById("color-picker-primary");
    color_picker_primary_wrapper = document.getElementById("color-picker-wrapper-primary");

    color_picker_primary_wrapper.style.backgroundColor = decimalToHexString($primary);
    color_picker_secondary_wrapper.style.backgroundColor = decimalToHexString($secondary);
}