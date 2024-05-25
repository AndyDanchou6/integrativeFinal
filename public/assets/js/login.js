document.addEventListener("DOMContentLoaded", function (e) {
// Login Operation
    const login = document.querySelector(".loginBtn");
    login.addEventListener("click", function () {
        const loginEmail = document.querySelector("#login-email").value;
        const loginPassword = document.querySelector("#login-password").value;

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
                const errorHandling = document.querySelector('.error-handling');
                
                if (data.status == 422) {
                    errorHandling.style.display = 'flex';
                    if (!data.message.email) {
                        if (data.message.password) {
                            errorHandling.firstElementChild.innerHTML = data.message.password;
                        }    
                    } else {
                        errorHandling.firstElementChild.innerHTML = data.message.email;
                    }
                    
                    setTimeout(function() {
                        errorHandling.style.display = 'none';
                    }, 3000);
                }

                if (data.status == 400) {
                    errorHandling.style.display = 'flex';
                    errorHandling.firstElementChild.innerHTML = data.message;

                    setTimeout(function() {
                        errorHandling.style.display = 'none';
                    }, 3000);
                }

                if (data.status == 200) {
                    localStorage.setItem('danchouEmail', loginEmail);
                    localStorage.setItem('danchouPassword', loginPassword);
                    window.location.href = '/verify';
                } 
            });
    });
});
