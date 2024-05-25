document.addEventListener("DOMContentLoaded", function () {
    // Populate Table
    const usersApi = `/api/get_users`;
    fetch(usersApi, {
        headers: {
            Accept: "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            const thead = document.querySelector("#column-name");
            const tbody = document.querySelector("#data-fields");

            if (thead || tbody) {
                if (data.status == 200) {
                    const users = data.data;
                    const columnNames = `
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                </tr>
                `;

                    thead.innerHTML = columnNames;
                    let list = "";

                    users.forEach((user) => {
                        list += `<tr>
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.phoneNo}</td>
                            <td>${user.role}</td>
                    </tr>
                    `;
                    });

                    tbody.innerHTML = list;
                }
            }
        });
});

// Auxiliary Functions

// Add Text Response
function createResponseMessage(message, parentElement, responseType) {
    const errorMessage = document.createElement("div");
    if (responseType === "success") {
        errorMessage.classList.add("success");
    }
    if (responseType === "fail") {
        errorMessage.classList.add("warning");
    }
    errorMessage.classList.add("response-message");
    errorMessage.textContent = message;

    const existingErrorMessage = document.querySelector(".response-message");
    if (existingErrorMessage) {
        existingErrorMessage.parentNode.removeChild(existingErrorMessage);
    }

    parentElement.insertBefore(errorMessage, parentElement.firstChild);
}

// Add new user function
function addUser() {
    const popUpForm = document.querySelector(".popUpForm");
    popUpForm.style.display = "flex";
    popUpForm.style.flexDirection = "column";
    popUpForm.style.alignItems = "center";

    const closeForm = document.querySelector("#close-form");
    closeForm.addEventListener("click", function () {
        popUpForm.style.display = "none";
    });

    const submitForm = document.querySelector("#submit_form");
    submitForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const validateFormApi = `/api/validate`;

        var formData = new FormData(submitForm);

        fetch(validateFormApi, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Authorization: `Bearer ${token}`,
            },
            body: formData,
        })
            .then((res) => {
                if (!res.ok) {
                    throw new Error("Network response was not ok");
                }

                return res.json();
            })
            .then((data) => {
                // Display Error on form
                if (data.status != 200) {
                    const formFields = document.getElementById("form-fields");

                    if (data.status == 400) {
                        createResponseMessage(data.message, formFields, "fail");
                    } else {
                        let errorMessageText = "";

                        for (const key in data.message) {
                            if (data.message.hasOwnProperty(key)) {
                                if (data.message[key]) {
                                    errorMessageText = data.message[key];
                                    break;
                                }
                            }
                        }

                        createResponseMessage(
                            errorMessageText,
                            formFields,
                            "fail"
                        );
                    }
                } else {
                    // Ask to continue creation
                    const confirmCreationMessage =
                        "Are you sure you want to create this user?";
                    confirmPopUp(confirmCreationMessage, function (result) {
                        if (result == 1) {
                            const storeUserApi = `/api/post_users`;

                            fetch(storeUserApi, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": csrfToken,
                                    Accept: "application/json",
                                    Authorization: `Bearer ${token}`,
                                },
                                body: formData,
                            })
                                .then((res) => {
                                    if (!res.ok) {
                                        throw new Error(
                                            "Network response was not ok"
                                        );
                                    }

                                    return res.json();
                                })
                                .then((data) => {
                                    const formContainer =
                                        document.querySelector("#form-fields");
                                    createResponseMessage(
                                        data.message,
                                        formContainer,
                                        "success"
                                    );
                                });
                        }
                    });
                }
            });
    });
}
