document.addEventListener("DOMContentLoaded", function () {
    // Register Operation
    const register = document.querySelector(".reg-btn");

    register.addEventListener("click", function () {
        const username = document.querySelector("#reg-username");
        const email = document.querySelector("#reg-email");
        const password = document.querySelector("#reg-password");
        const password_confirmation =
            document.querySelector("#reg-pass-confirm");

        const postUserApi = `/api/validate`;

        fetch(postUserApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: username.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value
            })
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                // Validation errors
                if (data.status == 422) {
                    errors = data.message;

                    if (errors.username) {
                        alert(errors.username);
                    }

                    if (errors.email) {
                        alert(errors.email);
                    }

                    if (errors.password) {
                        alert(errors.password);
                    }
                }

                if (data.status == 400) {
                    alert(data.message);
                }
                
                if (data.status == 200) {
                    if (confirm("Are you want to continue?")) {
                        const postUserApi = `/api/post_users`;
                        fetch(postUserApi, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                username: data.data.username,
                                email: data.data.email,
                                password: data.data.password
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Created
                            if (data.status == 201) {
                                alert(data.message);
                                window.location.href = '/';
                            }
            
                            // Not Created
                            if (data.status == 500) {
                                alert(data.message);
                            }
                        });
                    }
                }
                console.log(data.data)
            });
    });
});
