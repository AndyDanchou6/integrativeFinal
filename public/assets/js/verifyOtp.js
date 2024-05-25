document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.querySelector('#submit-btn');

    submitBtn.addEventListener('click', function() {
        var otpCode = document.querySelector('#otp-code').value;
        var savedEmail = localStorage.getItem('danchouEmail');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const otpVerifyApi = `api/verify`;

        fetch(otpVerifyApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                email: savedEmail,
                otpCode: otpCode
            })
        })
        .then(res => res.json())
        .then(data => {

        const errorHandling = document.querySelector('.error-handling');
        if (data.status !== 200) {
            errorHandling.style.display = 'flex';
            errorHandling.firstElementChild.innerHTML = data.message;

            setTimeout(function() {
                errorHandling.style.display = 'none';
            }, 3000);
        } else {
            localStorage.setItem('danchouToken', data.token);
            localStorage.removeItem('danchouPassword');
            window.location.href = `/dashboard`;
        }
        });
    })

    const resendCodeBtn = document.querySelector('#resend-code');

    resendCodeBtn.addEventListener('click', function() {
        // console.log(resendCodeBtn);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const loginApi = `/api/login`;
        fetch(loginApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                email: localStorage.getItem('danchouEmail'),
                password: localStorage.getItem('danchouPassword')
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
                }

                if (data.status == 200) {
                    window.location.href = '/verify';
                    alert('Code Resent');
                } 
            });
    });
});