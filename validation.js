const reservationForm = document.getElementById('reservationForm');
const successNotification = document.getElementById('successNotification');
const closeNotification = document.getElementById('closeNotification');

reservationForm.addEventListener('submit', function (e) {
    e.preventDefault();
    
    const name = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const date = document.getElementById('bookingDate').value;
    const time = document.getElementById('bookingTime').value;
    const guests = document.getElementById('numGuests').value;
   
    // Clear previous error messages
    document.getElementById('nameError').textContent = "";
    document.getElementById('timeError').textContent = "";

    // Initialize valid flag
    let valid = true;

    // Check for empty fields
    if (email === '' || phone === '' || date === '' || guests === '') {
        alert('Please fill the required fields.');
        return;
    }

    // Validate name length
    if (name.length < 3) {
        document.getElementById('nameError').textContent = 'Full name must be at least 3 characters.';
        valid = false;
    }

    // Validate booking time
    if (time) {
        let timeParts = time.split(":");
        let hour = parseInt(timeParts[0], 10);
        if (hour < 8 || hour >= 23) {
            document.getElementById('timeError').textContent = "Booking time must be between 8:00 AM and 11:00 PM.";
            valid = false;
           
        }
    }

    // Stop if any validation failed
    if (!valid) {
        return;
    }

    // Show success notification
    successNotification.style.display = 'block';
    setTimeout(function () {
        successNotification.style.display = 'none';
    }, 3000);

    // Reset the form
    reservationForm.reset();
});

closeNotification.addEventListener('click', function () {
    successNotification.style.display = 'none';
});
