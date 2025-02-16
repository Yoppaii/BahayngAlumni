let hero_s_form = document.getElementById('hero_s_form');
let hero_picture_inp = document.getElementById('hero_picture_inp');


hero_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_hero();
});

function add_hero() {
    let data = new FormData();
    data.append('picture', hero_picture_inp.files[0]);
    data.append('add_hero', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('hero_s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert("failed", "Only JPG, PNG and JPEG are allowed!");
        } else if (this.responseText == 'inv_size') {
            alert("failed", "Image should be less than 2MB!");
        } else if (this.responseText == 'upd_failed') {
            alert("failed", "Image upload failed. Server Down!");
        } else {
            alert("success", "New Hero Added!");
            hero_picture_inp.value = "";
            get_hero();
        }

    };


    xhr.send(data);
}

function get_hero() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('hero_data').innerHTML = this.responseText;
    }

    xhr.send('get_hero');
}

function rem_hero(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Member removed!');
            get_hero();
        } else {
            alert('failed', 'No changes made!');
        }
    }

    xhr.send('rem_hero=' + val);
}

window.onload = function () {
    get_hero();
}