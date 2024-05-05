document.addEventListener("DOMContentLoaded", function (e) {
    // Login Operation
    const login = document.querySelector(".loginBtn");

    login.addEventListener("click", function () {
        const loginEmail = document.querySelector("#login-email").value;
        const loginPassword = document.querySelector("#login-password").value;
        // const emailKey = 'email';
        // const passKey = 'password';

         const loginApi = `/api/login`;
        fetch(loginApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: loginEmail,
                password: loginPassword
            })
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                if (data.status == 422) {
                    if (data.error.email) {
                        alert(data.error.email);
                    }
                    
                    if (data.error.password) {
                        alert(data.error.password);
                    }
                }

                if (data.status == 400) {
                    alert(data.error)
                }

                if (data.status == 200) {
                    window.location.href = '/dashboard';
                } 

                console.log(data.error);
            });
    });
});
