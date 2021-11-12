



function openScriptAddingPan() {
  var newScriptButton = document.getElementById("newScript");
  var displaySetting = newScriptButton.style.display;

  if (displaySetting == "block") {
    newScriptButton.style.display = "none";
  } else {
    newScriptButton.style.display = "block";
  }
}

function showEventText(id) {
  var eventText = document.getElementById("eventText"+id);
  var eventTextd = eventText.style.display;
  var eventUpdateText = document.getElementById("eventUpdateText"+id);
  var eventUpdateTextd = eventUpdateText.style.display;
  var eventManagementText = document.getElementById("eventManagementText"+id);
  var eventManagementTextd = eventManagementText.style.display;

  if (eventTextd == "block") {
    eventText.style.display = "none";
    eventManagementText.style.display = "none";
    eventUpdateText.style.display = "block";
  } else {
    eventUpdateText.style.display = "none";
    eventText.style.display = "block";
    eventManagementText.style.display = "block";
  }
}
