function showContent(sectionId) {
    // Hide all content sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach((section) => {
        section.classList.remove('active');
    });

    // Show the selected content section
    const activeSection = document.getElementById(sectionId);
    activeSection.classList.add('active');
}
