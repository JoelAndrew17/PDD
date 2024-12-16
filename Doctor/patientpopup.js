// Function to show the popup
function showPopup(name, time, urgency) {
    const popup = document.getElementById('patient-popup');
    const details = `Name: ${name}<br>Time: ${time}<br>Urgency: ${urgency}`;
    document.getElementById('popup-details').innerHTML = details;
    popup.style.display = 'block';
    document.body.classList.add('popup-open');
}

// Function to close the popup
function closePopup() {
    const popup = document.getElementById('patient-popup');
    popup.style.display = 'none';
    document.body.classList.remove('popup-open');
}
