function alert(type, msg, position = "body") {
    let bs_class = (type === "success") ? "alert-success" : "alert-danger";
    let element = document.createElement('div');
    element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show" role="alert" id="auto-close-alert">
        ${msg}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

    if (position == "body") {
        document.body.appendChild(element);
        element.classList.add('custom-alert')
    }
    else {
        document.getElementById(position).appendChild(element);
    }

    setTimeout(() => {
        const alert = document.getElementById('auto-close-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 150);
        }
    }, 2500);
}