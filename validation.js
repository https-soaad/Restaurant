const reservationForm = document.getElementById('reservationForm');

reservationForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Prevent the default form submission

    const name = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const date = document.getElementById('bookingDate').value;
    const time = document.getElementById('bookingTime').value;
    const guests = document.getElementById('numGuests').value;

    document.getElementById('nameError').textContent = "";
    document.getElementById('timeError').textContent = "";

    let valid = true;

    if (email === '' || phone === '' || date === '' || guests === '') {
        alert('Please fill the required fields.');
        valid = false;
    }

    if (name.length < 3) {
        document.getElementById('nameError').textContent = 'Full name must be at least 3 characters.';
        valid = false;
    }

    if (time) {
        let timeParts = time.split(":");
        let hour = parseInt(timeParts[0], 10);
        if (hour < 8 || hour >= 23) {
            document.getElementById('timeError').textContent = "Booking time must be between 8:00 AM and 11:00 PM.";
            valid = false;
        }
    }

    if (valid) {

        reservationForm.submit();
    }
    reservationForm.reset();
});
