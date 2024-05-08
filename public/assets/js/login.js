document.addEventListener("DOMContentLoaded", function (e) {
    // Login Operation
    const login = document.querySelector(".loginBtn");

    login.addEventListener("click", function () {
        const loginEmail = document.querySelector("#login-email").value;
        const loginPassword = document.querySelector("#login-password").value;
        // const emailKey = 'email';
        // const passKey = 'password';

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const loginApi = `/api/login`;
        fetch(loginApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
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
                    // console.log(data.token);
                    localStorage.setItem('danchouToken', data.token)
                    window.location.href = '/dashboard';
                } 

                // console.log(data.error);
            });
    });
});
