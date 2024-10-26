// main.js
document.getElementById('filterType').addEventListener('change', function() {
    var selectedType = this.value;
    window.location.href = "gallery.php?type=" + selectedType;
});

