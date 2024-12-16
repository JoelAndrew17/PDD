document.getElementById("appointmentForm").addEventListener("submit", function(event) {
	event.preventDefault(); // Prevent the default form submission
	
	// Display the success popup and overlay
	document.getElementById("successPopup").style.display = "block";
	document.getElementById("overlay").style.display = "block";
	
	// Redirect after 2 seconds
	setTimeout(function() {
		window.location.href = document.getElementById("appointmentForm").action;
	}, 2000);
});

// Function to close the popup manually if needed
function closePopup() {
	document.getElementById("successPopup").style.display = "none";
	document.getElementById("overlay").style.display = "none";
}
