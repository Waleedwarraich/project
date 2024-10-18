function navigate() {
    var selectElement = document.getElementById("trips");
    var selectedOption = selectElement.options[selectElement.selectedIndex].value;
    if (selectedOption && selectedOption !== window.location.href) {
        window.location.href = selectedOption;
    }
}