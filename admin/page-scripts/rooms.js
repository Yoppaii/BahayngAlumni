let add_room_form = document.getElementById('add_room_form');

add_room_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_room();
});

function add_room() {
    let data = new FormData();
    data.append('add_room', '');
    data.append('name', add_room_form.elements['name'].value);
    data.append('area', add_room_form.elements['area'].value);
    data.append('price', add_room_form.elements['price'].value);
    data.append('quantity', add_room_form.elements['quantity'].value);
    data.append('capacity', add_room_form.elements['capacity'].value);
    data.append('description', add_room_form.elements['description'].value);

    let features = [];

    add_room_form.elements['features'].forEach(el => {
        if (el.checked) {
            features.push(el.value);
        }
    });

    let facilities = [];

    add_room_form.elements['facilities'].forEach(el => {
        if (el.checked) {
            facilities.push(el.value);
        }
    });

    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('add_room');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert("success", "New Room Added!");
            add_room_form.reset();
            get_all_rooms();
        } else {
            alert("failed", "Failed to Add New Room!");

        }

    };
    xhr.send(data);

}

function get_all_rooms() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('room_data').innerHTML = this.responseText;
    }
    xhr.send('get_all_rooms');
}

let edit_room_form = document.getElementById('edit_room_form');

edit_room_form.addEventListener('submit', function (e) {
    e.preventDefault();
    edit_room();
});

function edit_room() {
    let data = new FormData();
    data.append('edit_room', '');
    data.append('room_id', edit_room_form.elements['room_id'].value);
    data.append('name', edit_room_form.elements['name'].value);
    data.append('area', edit_room_form.elements['area'].value);
    data.append('price', edit_room_form.elements['price'].value);
    data.append('quantity', edit_room_form.elements['quantity'].value);
    data.append('capacity', edit_room_form.elements['capacity'].value);
    data.append('description', edit_room_form.elements['description'].value);

    let features = [];

    edit_room_form.elements['features'].forEach(el => {
        if (el.checked) {
            features.push(el.value);
        }
    });

    let facilities = [];

    edit_room_form.elements['facilities'].forEach(el => {
        if (el.checked) {
            facilities.push(el.value);
        }
    });

    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('edit_room');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert("success", "Room Edited!");
            edit_room_form.reset();
            get_all_rooms();
        } else {
            alert("failed", "Failed to Edit Room!");

        }

    };
    xhr.send(data);
}

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        edit_room_form.elements['room_id'].value = data.roomData.id;
        edit_room_form.elements['name'].value = data.roomData.name;
        edit_room_form.elements['area'].value = data.roomData.area;
        edit_room_form.elements['price'].value = data.roomData.price;
        edit_room_form.elements['quantity'].value = data.roomData.quantity;
        edit_room_form.elements['capacity'].value = data.roomData.capacity;
        edit_room_form.elements['description'].value = data.roomData.description;

        edit_room_form.elements['features'].forEach(el => {
            if (data.features.includes(Number(el.value))) {
                el.checked = true;
            }
        });

        edit_room_form.elements['facilities'].forEach(el => {
            if (data.facilities.includes(Number(el.value))) {
                el.checked = true;
            }
        });
    };
    xhr.send('get_room=' + id);
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Status Toggled!');
            get_all_rooms();
        } else {
            alert('failed', 'Failed to Toggle Status!');
        }
    }
    xhr.send('toggle_status=' + id + '&value=' + val);
}

let add_image_form = document.getElementById('add_image_form');

add_image_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData();
    data.append('image', add_image_form.elements['image'].files[0]);
    data.append('room_id', add_image_form.elements['room_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        if (this.responseText == 'inv_img') {
            alert("failed", "Only JPG, WEBP, PNG and JPEG are allowed!", "image_alert");
        } else if (this.responseText == 'inv_size') {
            alert("failed", "Image should be less than 2MB!", "image_alert");
        } else if (this.responseText == 'upd_failed') {
            alert("failed", "Image upload failed. Server Down!", "image_alert");
        } else {
            alert("success", "New Image Added!", "image_alert");
            const roomId = add_image_form.elements['room_id'].value;
            const modalTitle = document.querySelector("#edit_room_image .modal-title");
            roomName = modalTitle.innerText;
            room_images(roomId, roomName);
            add_image_form.reset();
        }
    };
    xhr.send(data);
}

function room_images(id, roomName) {

    document.querySelector("#edit_room_image .modal-title").innerText = roomName;
    add_image_form.elements['room_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('room_image_data').innerHTML = this.responseText;
    }
    xhr.send('get_room_images=' + id);

}

function rem_image(img_id, room_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('room_id', room_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        if (this.responseText == '1') {
            alert("success", "Image Removed!", "image_alert");
            const modalTitle = document.querySelector("#edit_room_image .modal-title");
            roomName = modalTitle.innerText;
            room_images(room_id, roomName);
        } else {
            alert("failed", "Failed to Remove Image!", "image_alert");
        }
    };
    xhr.send(data);
}

function thumb_image(img_id, room_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('room_id', room_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        if (this.responseText == '1') {
            alert("success", "Image Thumbnail Changed!", "image_alert");
            const modalTitle = document.querySelector("#edit_room_image .modal-title");
            roomName = modalTitle.innerText;
            room_images(room_id, roomName);
        } else {
            alert("failed", "Failed to Update Thumbnail!", "image_alert");
        }
    };
    xhr.send(data);
}

function remove_room(room_id) {

    if (confirm("Are you sure, you want to delete this room?")) {
        let data = new FormData();
        data.append('room_id', room_id);
        data.append('remove_room', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert("success", "Room Removed!");
                get_all_rooms();

            } else {
                alert("failed", "Failed to Remove the Room!");
            }
        }
        xhr.send(data);
    }
}


window.onload = function () {
    get_all_rooms();
}