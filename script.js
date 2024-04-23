const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

sidebarClose.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
});

darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    document.setI;
    darkLight.classList.replace("bx-sun", "bx-moon");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
  }
});

submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}



// registration form validation
function validateForm() {
  // Reset previous error messages
  resetErrors();

  // Validation for each input field
  if (!validateName('firstName')) return false;
  if (!validateName('lastName')) return false;
  if (!validateEmail('Email')) return false;
  if (!validatePassword('Password')) return false;
  if (!validateDate('DOB')) return false;
  if (!validatePhone('Phone')) return false;
  if (!validateGender('Gender')) return false;

  return true;
}

function resetErrors() {
  // Reset previous error messages
  var errorElements = document.getElementsByClassName('error');
  for (var i = 0; i < errorElements.length; i++) {
    errorElements[i].innerText = '';
  }
}

function validateName(fieldName) {
  var name = document.forms['signupForm'][fieldName].value.trim();
  if (name === '') {
    showError(fieldName, 'This field is required.');
    return false;
  }
  return true;
}

function validateEmail(fieldName) {
  var email = document.forms['signupForm'][fieldName].value.trim();
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    showError(fieldName, 'Enter a valid email address.');
    return false;
  }
  return true;
}

function validatePassword(fieldName) {
  var password = document.forms['signupForm'][fieldName].value.trim();
  if (password.length < 8) {
    showError(fieldName, 'Password must be at least 8 characters long.');
    return false;
  }
  return true;
}

function validateDate(fieldName) {
  var date = document.forms['signupForm'][fieldName].value;
  if (!date) {
    showError(fieldName, 'This field is required.');
    return false;
  }
  return true;
}

function validatePhone(fieldName) {
  var phone = document.forms['signupForm'][fieldName].value.trim();
  var phoneRegex = /^\d{10}$/;
  if (phone !== '' && !phoneRegex.test(phone)) {
    showError(fieldName, 'Enter a valid 10-digit phone number.');
    return false;
  }
  return true;
}

function validateGender(fieldName) {
  var gender = document.forms['signupForm'][fieldName].value;
  if (gender !== 'M' && gender !== 'F') {
    showError(fieldName, 'Please select a gender.');
    return false;
  }
  return true;
}

function showError(fieldName, message) {
  var errorElement = document.createElement('div');
  errorElement.className = 'error';
  errorElement.innerText = message;
  document.getElementsByName(fieldName)[0].parentNode.appendChild(errorElement);
}


// JavaScript
document.addEventListener('DOMContentLoaded', function () {
  const notificationIcon = document.getElementById('notification');
  const notificationDropdown = document.querySelector('.notification-dropdown');

  // Example notifications
  const notifications = [
    'New message received',
    'Friend request accepted',
    'You have 3 new notifications',
  ];

  // Function to toggle the dropdown
  function toggleDropdown() {
    notificationDropdown.style.display =
      notificationDropdown.style.display === 'none' ? 'block' : 'none';
  }

  // Populate the dropdown with example notifications
  notifications.forEach((notification) => {
    const notificationItem = document.createElement('a');
    notificationItem.href = '#';
    notificationItem.textContent = notification;
    notificationDropdown.appendChild(notificationItem);
  });

  // Event listener for the notification icon
  notificationIcon.addEventListener('click', toggleDropdown);

  // Close the dropdown when clicking outside of it
  document.addEventListener('click', function (event) {
    if (!event.target.closest('.notification-container')) {
      notificationDropdown.style.display = 'none';
    }
  });
});


