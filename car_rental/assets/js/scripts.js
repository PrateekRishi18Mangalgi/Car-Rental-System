// Example: Simple validation for booking form
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const carSelect = document.getElementById('carSelect');
    if (!carSelect.value) {
        alert('Please select a car');
        e.preventDefault();
    }
});
