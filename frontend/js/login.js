const loginBtn = document.querySelector(".login-btn");
const form = document.querySelector("form");

loginBtn.addEventListener("click", (event) => {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;

    if (!username || !email) {
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
