function booking_analytics(period = 1) {
    fetch("ajax/dashboard.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ booking_analytics: true, period }),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            document.getElementById('total_bookings').textContent = data.total_bookings;
            document.getElementById('total_amount').textContent = `₱${data.total_amount}.00`;

            document.getElementById('active_bookings').textContent = data.active_bookings;
            document.getElementById('active_amount').textContent = `₱${data.active_amount}.00`;

            document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings;
            document.getElementById('cancelled_amount').textContent = `₱${data.cancelled_amount}.00`;
        })
        .catch(error => console.error("Error fetching booking analytics:", error));
}

function user_analytics(period = 1) {
    fetch("ajax/dashboard.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ user_analytics: true, period }),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            document.getElementById('total_new_register').textContent = data.total_new_register;

            document.getElementById('total_queries').textContent = data.total_queries;

            document.getElementById('total_reviews').textContent = data.total_reviews;
        })
        .catch(error => console.error("Error fetching user analytics:", error));
}

window.onload = function () {
    booking_analytics();
    user_analytics();
}