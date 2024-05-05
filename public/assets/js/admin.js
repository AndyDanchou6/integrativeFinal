document.addEventListener("DOMContentLoaded", function () {
    // Sidebar Toogle
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    var sidebar_state = 0;

    sidebarToggle.addEventListener("click", function () {
        const sidebar = document.querySelector("#sidebar");

        if (sidebar_state == 0) {
            sidebar.style.left = "0";
            sidebar_state = 1;
        } else {
            sidebar.style.left = "-260px";
            sidebar_state = 0;
        }
        // console.log(sidebar_state);
    });

    // Settings Button
    const settings = document.querySelector('.settings-btn');
    settings.addEventListener('click', function() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = '/';
        }
    });

    // Populate Table 
    const usersApi = '/api/get_users';
    fetch(usersApi)
    .then(res => res.json())
    .then(data => {
        const thead = document.querySelector('#column-name');
        const tbody = document.querySelector('#data-fields');

        if (data.status == 200) {
            const users = data.data;
            const columnNames = `
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            `;

            thead.innerHTML = columnNames;
            let list = '';

            users.forEach(user => {
                list +=
                `<tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                </tr>
                `;
            });
            
            tbody.innerHTML = list;
        }
        console.log(data);
    });
});
