function get_users() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('users_data').innerHTML = this.responseText;
    }
    xhr.send('get_users');
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Status Toggled!');
            get_users();
        } else {
            alert('failed', 'Failed to Toggle Status!');
        }
    }
    xhr.send('toggle_status=' + id + '&value=' + val);
}

function remove_user(user_id) {

    if (confirm("Are you sure, you want to delete this user?")) {
        let data = new FormData();
        data.append('user_id', user_id);
        data.append('remove_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users_crud.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert("success", "User Removed!");
                get_users();

            } else {
                alert("failed", "Failed to Remove the User!");
            }
        }
        xhr.send(data);
    }
}

function search_user(user_name) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload = function () {
        document.getElementById('users_data').innerHTML = this.responseText;
    }
    xhr.send('search_user&name=' + user_name);
}

window.onload = function () {
    get_users();
}
