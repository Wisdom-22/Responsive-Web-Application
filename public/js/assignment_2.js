// JavaScript function to open a popup by ID
function openPopup(popupId) {
    // Get the popup element by its ID
    var popup = document.getElementById(popupId);
    
    // Log a message to the console
    console.log("hello");

    // Check if the popup element exists
    if (popup) {
        // Set the display style of the popup to block to make it visible
        popup.style.display = "block";
    }
}

// JavaScript function to close a popup by ID
function closePopup(popupId) {
    // Get the popup element by its ID
    var popup = document.getElementById(popupId);
    
    // Check if the popup element exists
    if (popup) {
        // Set the display style of the popup to none to hide it
        popup.style.display = "none";
    }
}
