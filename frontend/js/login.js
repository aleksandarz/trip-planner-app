const loginBtn = document.querySelector(".login-btn");
const form = document.querySelector("form");

loginBtn.addEventListener("click", (event) => {
    event.preventDefault();

    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;

    if (!email || !password) {
        alert("Please fill out all fields.");
        return;
    }

    const emailPattern =
        /^[a-zA-Z0-9._%+-]{3,32}@[a-zA-Z0-9.-]{3,16}\.([a-zA-Z0-9.-]{3,16}\.)?[a-zA-Z]{2,6}$/;

    if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        return;
    }

    form.submit();
});
