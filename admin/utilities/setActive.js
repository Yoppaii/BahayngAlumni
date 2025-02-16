function setActive() {
    let navbar = document.getElementById('dashboard-menu');
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
        let file = a_tags[i].href.split('/').pop(); // Get the file name from the href
        let file_name = file.split('.')[0]; // Get the file name without extension

        // Remove 'active' class from all links
        a_tags[i].classList.remove('active');

        // Check if the current URL contains the file name
        if (document.location.href.indexOf(file_name) >= 0) {
            a_tags[i].classList.add('active'); // Add 'active' class to the current link
        }
    }
}
setActive();