document.addEventListener("DOMContentLoaded", function () {
    const email = localStorage.getItem("danchouEmail");
    const searchUserApi = `api/search_users/email/${email}`;

    fetch(searchUserApi, {
        headers: {
            Accept: "application/json",
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
            const userProfile = data.data[0];
            const profileUsername = document.querySelector("#profile-username");
            const profileEmail = document.querySelector("#profile-email");
            const profilePhoneNo = document.querySelector("#profile-phoneNo");
            const profileRole = document.querySelector("#profile-role");
            const profileImage = document.querySelector(
                "#profile-pic-container .profile-pic-wrap img"
            );

            if (userProfile.image != null) {
                profileImage.setAttribute("src", "storage/" + userProfile.image);
            }

            insertParagraphElement(userProfile.username, profileUsername);
            insertParagraphElement(userProfile.email, profileEmail);
            insertParagraphElement(userProfile.phoneNo, profilePhoneNo);
            insertParagraphElement(userProfile.role, profileRole);

            // console.log(usernameNode);
            console.log(profileUsername);
            console.log(profileEmail);
            console.log(profilePhoneNo);
            console.log(profileRole);
            console.log("storage/" + userProfile.image);
        });
});

function insertParagraphElement(text, parentElement) {
    var pElement = document.createElement("p");
    var textNode = document.createTextNode(text);
    pElement.append(textNode);

    parentElement.append(pElement);
    return parentElement;
}
