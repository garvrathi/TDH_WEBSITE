function validateForm() {
    var name = document.forms["registration-form"]["name"].value;
    var course = document.forms["registration-form"]["course"].value;
    var customCourse = document.forms["registration-form"]["custom-course"].value;
    var semester = document.forms["registration-form"]["semester"].value;
    var email = document.forms["registration-form"]["email"].value;
    var phone = document.forms["registration-form"]["phone"].value;
    var password = document.forms["registration-form"]["password"].value;

    var errors = [];

    if (name === "") {
        errors.push("Name is required.");
    }

    if (course === "") {
        errors.push("Course is required.");
    } else if (course === "other" && customCourse === "") {
        errors.push("Custom course is required for 'Other' option.");
    }

    if (semester === "") {
        errors.push("Semester is required.");
    }

    if (email === "") {
        errors.push("Email is required.");
    } else if (!validateEmail(email)) {
        errors.push("Invalid email format.");
    }

    if (phone === "") {
        errors.push("Phone number is required.");
    } else if (!validatePhone(phone)) {
        errors.push("Invalid phone number format. Please enter a 10-digit phone number.");
    }

    if (password === "") {
        errors.push("Password is required.");
    }

    if (errors.length > 0) {
        var errorText = "<h2>Error:</h2>";
        for (var i = 0; i < errors.length; i++) {
            errorText += "<p>" + errors[i] + "</p>";
        }
        document.getElementById("error-container").innerHTML = errorText;
        return false;
    }

    return true;
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    var re = /^\d{10}$/;
    return re.test(phone);
}

function toggleCustomCourse() {
    var course = document.getElementById("course").value;
    var customCourseContainer = document.getElementById("custom-course-container");

    if (course === "other") {
        customCourseContainer.style.display = "block";
    } else {
        customCourseContainer.style.display = "none";
    }
}
