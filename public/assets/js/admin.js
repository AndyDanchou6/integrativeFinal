// Logout function
function logout() {
    const logoutMessage = "Are you sure you want to logout?";
    confirmPopUp(logoutMessage, function (result) {
        if (result == 1) {
            const logoutApi = `/api/logout`;

            fetch(logoutApi, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Authorization: `Bearer ${token}`,
                },
            })
                .then((res) => {
                    if (!res.ok) {
                        throw new Error("Network response was not ok");
                    }

                    return res.json();
                })
                .then((data) => {
                    if (data.status != 200) {
                        alert("Logout failed");
                    }

                    localStorage.removeItem("danchouToken");
                    localStorage.removeItem("danchouEmail");
                    window.location.href = "/";
                });
        }
    });
}

// Sidebar Toggle
const sidebarToggle = document.querySelector(".sidebar-toggle");
const sidebar = document.querySelector("#sidebar");
var sidebar_state = 0;

sidebarToggle.addEventListener("click", function () {
    if (sidebar_state == 0) {
        sidebar.style.left = "0";
        sidebar_state = 1;
    } else {
        sidebar.style.left = "-260px";
        sidebar_state = 0;
    }
});

// Pop up prompt
function confirmPopUp(message, callback) {
    const popUpConfirm = document.querySelector(".pop-ups");
    popUpConfirm.style.display = "flex";
    popUpConfirm.style.flexDirection = "column";
    popUpConfirm.style.justifyContent = "center";
    popUpConfirm.style.alignItems = "center";
    popUpConfirm.style.zIndex = 5;

    popUpConfirm.firstElementChild.innerHTML = message;

    const cancel = document.querySelector("#cancel-btn");
    cancel.addEventListener("click", function () {
        popUpConfirm.style.display = "none";
        callback(0);
    });

    const confirm = document.querySelector("#ok-btn");
    confirm.addEventListener("click", function () {
        popUpConfirm.style.display = "none";
        callback(1);
    });
}
