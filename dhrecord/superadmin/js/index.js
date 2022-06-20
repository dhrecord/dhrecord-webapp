// USER MANAGEMENT
// sample data
var data = [
  [
    1,
    "John Doe",
    "5 Magazine Road #02-01, 059571, Singapore",
    "S5219994H",
    "+65 8950 4262",
    "JohnDoe@gmail.com",
    "-",
  ],
  [
    2,
    "Jane Doe",
    "926 Yishun Central 1 01-177, 760926, Singapore",
    "S6891261Z",
    "+65 8952 7201",
    "JaneDoe@gmail.com",
    "l99Pas6d",
  ],
  [
    3,
    "Nate",
    "1 Coleman Street 02-30/31 The Adelphi, 179803, Singapore",
    "S9168686D",
    "+65 9786 5789",
    "Nate22@gmail.com",
    "9KAasY7w",
  ],
  [
    4,
    "Jack",
    "112 East Coast Road #B1-14 112 Katong, 428802, Singapore",
    "S5397679D",
    "+65 8951 7299",
    "Jack11@gmail.com",
    "9KAasY7w",
  ],
];

// inject data to table in 'user management' page => onLoad
function findData() {
  let text = "";
  for (i = 0; i < data.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data[i][0] +
      "</td><td>" +
      data[i][1] +
      "</td><td>" +
      data[i][2] +
      "</td><td>" +
      data[i][3] +
      "</td><td>" +
      data[i][4] +
      "</td><td>" +
      data[i][5] +
      "</td><td>" +
      data[i][6] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo(' +
      data[i][0] +
      ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
      '<td class="text-center"><button onclick="deleteRow(' +
      data[i][0] +
      ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
  }

  document.getElementById("data").innerHTML += text;
}

// search name function
function searchName() {
  // empty table
  document.getElementById("data").innerHTML = "";

  // get user input
  let input = document.getElementById("searchNameInput");
  let filter = input.value.toUpperCase();

  // inject matched data
  let text = "";
  for (i = 0; i < data.length; i++) {
    if (data[i][1].toUpperCase().indexOf(filter) > -1) {
      text +=
        '<tr><td scope="row">' +
        data[i][0] +
        "</td><td>" +
        data[i][1] +
        "</td><td>" +
        data[i][2] +
        "</td><td>" +
        data[i][3] +
        "</td><td>" +
        data[i][4] +
        "</td><td>" +
        data[i][5] +
        "</td><td>" +
        data[i][6] +
        "</td>" +
        '<td class="text-center"><button onclick="editInfo(' +
        data[i][0] +
        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
        '<td class="text-center"><button onclick="deleteRow(' +
        data[i][0] +
        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
    }
  }

  document.getElementById("data").innerHTML += text;
}

// function to delete row when 'delete' button is clicked
function deleteRow(id) {
  // empty table
  document.getElementById("data").innerHTML = "";

  // remove deleted row from data
  for (i = 0; i < data.length; i++) {
    if (data[i][0] === id) {
      data.splice(i, 1);
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data[i][0] +
      "</td><td>" +
      data[i][1] +
      "</td><td>" +
      data[i][2] +
      "</td><td>" +
      data[i][3] +
      "</td><td>" +
      data[i][4] +
      "</td><td>" +
      data[i][5] +
      "</td><td>" +
      data[i][6] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo(' +
      data[i][0] +
      ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
      '<td class="text-center"><button onclick="deleteRow(' +
      data[i][0] +
      ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
  }

  document.getElementById("data").innerHTML += text;
}

// function to pass information to modal when 'edit' button is clicked
function editInfo(id) {
  for (i = 0; i < data.length; i++) {
    if (data[i][0] === id) {
      $("#invisibleID").val(data[i][0]);
      $("#inputName").val(data[i][1]);
      $("#inputAddress").val(data[i][2]);
      $("#inputNRIC").val(data[i][3]);
      $("#inputContactNo").val(data[i][4]);
      $("#inputEmail").val(data[i][5]);
      $("#inputCheckReferral").val(data[i][6]);
    }
  }
}

// function to save the updated information from modal
function saveDetails() {
  // validate input - not null
  let ID = $("#invisibleID").val();
  let name = $("#inputName").val();
  let address = $("#inputAddress").val();
  let NRIC = $("#inputNRIC").val();
  let contactNo = $("#inputContactNo").val();
  let email = $("#inputEmail").val();
  let c_ref = $("#inputCheckReferral").val();

  if (
    ID.trim() === "" ||
    name.trim() === "" ||
    address.trim() === "" ||
    NRIC.trim() === "" ||
    contactNo.trim() === "" ||
    email.trim() === ""
  ) {
    alert("Invalid! Please don't leave the input field empty!");
    return;
  }

  // empty table
  document.getElementById("data").innerHTML = "";

  // update data of the user
  ID = parseInt(ID);
  for (i = 0; i < data.length; i++) {
    if (data[i][0] == ID) {
      data[i] = [ID, name, address, NRIC, contactNo, email, c_ref];
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data.length; i++) {
    if (data[i][6].trim() === "") {
      data[i][6] = "-";
    }

    text +=
      '<tr><td scope="row">' +
      data[i][0] +
      "</td><td>" +
      data[i][1] +
      "</td><td>" +
      data[i][2] +
      "</td><td>" +
      data[i][3] +
      "</td><td>" +
      data[i][4] +
      "</td><td>" +
      data[i][5] +
      "</td><td>" +
      data[i][6] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo(' +
      data[i][0] +
      ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
      '<td class="text-center"><button onclick="deleteRow(' +
      data[i][0] +
      ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
  }

  document.getElementById("data").innerHTML += text;
  $("#popupModal").modal("hide");
}

// REGISTRATION MANAGEMENT - PATIENT
// sample data
var data2 = [
  [
    1,
    "John Doe",
    "5 Magazine Road #02-01, 059571, Singapore",
    "S5219994H",
    "+65 8950 4262",
    "JohnDoe@gmail.com",
    "kkO9Y7js",
    "22/01/2019",
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    "Lorem ipsum dolor sit amet",
  ],
  [
    2,
    "Jane Doe",
    "926 Yishun Central 1 01-177, 760926, Singapore",
    "S6891261Z",
    "+65 8952 7201",
    "JaneDoe@gmail.com",
    "l99Pas6d",
    "18/08/2019",
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    "Lorem ipsum dolor sit amet",
  ],
  [
    3,
    "Nate",
    "1 Coleman Street 02-30/31 The Adelphi, 179803, Singapore",
    "S9168686D",
    "+65 9786 5789",
    "Nate22@gmail.com",
    "9KAasY7w",
    "07/09/2019",
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    "Lorem ipsum dolor sit amet",
  ],
  [
    4,
    "Jack",
    "112 East Coast Road #B1-14 112 Katong, 428802, Singapore",
    "S5397679D",
    "+65 8951 7299",
    "Jack11@gmail.com",
    "9KAasY7w",
    "27/10/2019",
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    "Lorem ipsum dolor sit amet",
  ],
];

// inject data to table in 'user management' page => onLoad
function findData2() {
  let text = "";
  for (i = 0; i < data2.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data2[i][0] +
      "</td><td>" +
      data2[i][1] +
      "</td><td>" +
      data2[i][2] +
      "</td><td>" +
      data2[i][3] +
      "</td><td>" +
      data2[i][4] +
      "</td><td>" +
      data2[i][5] +
      "</td><td>" +
      data2[i][6] +
      "</td><td>" +
      data2[i][7] +
      "</td>" +
      '<td class="text-center"><button onclick="viewFullInfo(' +
      data2[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal2">View</button></td></tr>';
  }

  document.getElementById("data2").innerHTML += text;
}

// search name function
function searchName2() {
  // empty table
  document.getElementById("data2").innerHTML = "";

  // get user input
  let input = document.getElementById("searchNameInput");
  let filter = input.value.toUpperCase();

  // inject matched data
  let text = "";
  for (i = 0; i < data2.length; i++) {
    if (data2[i][1].toUpperCase().indexOf(filter) > -1) {
      text +=
        '<tr><td scope="row">' +
        data2[i][0] +
        "</td><td>" +
        data2[i][1] +
        "</td><td>" +
        data2[i][2] +
        "</td><td>" +
        data2[i][3] +
        "</td><td>" +
        data2[i][4] +
        "</td><td>" +
        data2[i][5] +
        "</td><td>" +
        data2[i][6] +
        "</td><td>" +
        data2[i][7] +
        "</td>" +
        '<td class="text-center"><button onclick="viewFullInfo(' +
        data2[i][0] +
        ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal2">View</button></td></tr>';
    }
  }

  document.getElementById("data2").innerHTML += text;
}

// function to pass information to modal when 'edit' button is clicked
function viewFullInfo(id) {
  for (i = 0; i < data2.length; i++) {
    if (data2[i][0] === id) {
      $("#invisibleID").val(data2[i][0]);
      $("#inputName").val(data2[i][1]);
      $("#inputAddress").val(data2[i][2]);
      $("#inputNRIC").val(data2[i][3]);
      $("#inputContactNo").val(data2[i][4]);
      $("#inputEmail").val(data2[i][5]);
      $("#inputCheckReferral").val(data2[i][6]);
      $("#inputRegistrationDate").val(data2[i][7]);
      $("#inputMedCond").val(data2[i][8]);
      $("#inputDrugAlle").val(data2[i][9]);
    }
  }
}

// REGISTRATION MANAGEMENT - BUSINESS OWNER
// sample data
var data3 = [
  [
    1,
    "Y-Dental",
    "5 Magazine Road #02-01, 059571, Singapore",
    "+65 8950 4262",
    "YDental@gmail.com",
    "123456789012",
    "C0019292",
    "21/03/2006",
    "Pediatric Dentistry",
  ],
  [
    2,
    "Dental Care",
    "926 Yishun Central 1 01-177, 760926, Singapore",
    "+65 8952 7201",
    "DentalCare@gmail.com",
    "234567890123",
    "C0315261",
    "08/08/2010",
    "Periodontics, Prosthodontics",
  ],
  [
    3,
    "Go Dental",
    "112 East Coast Road #B1-14 112 Katong, 428802, Singapore",
    "+65 9786 5789",
    "GoDental@gmail.com",
    "345678901234",
    "C2032352",
    "17/09/2010",
    "Oral surgery",
  ],
];

// inject data to table in 'user management' page => onLoad
function findData3() {
  let text = "";
  for (i = 0; i < data3.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data3[i][0] +
      "</td><td>" +
      data3[i][1] +
      "</td><td>" +
      data3[i][2] +
      "</td><td>" +
      data3[i][3] +
      "</td><td>" +
      data3[i][4] +
      "</td><td>" +
      data3[i][5] +
      "</td><td>" +
      data3[i][6] +
      "</td><td>" +
      data3[i][7] +
      "</td><td>" +
      data3[i][8] +
      "</td>" +
      '<td class="text-center"><button onclick="viewFullInfo3(' +
      data3[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal3">View</button></td>' +
      '<td class="text-center"><button onclick="approveUser(' +
      data3[i][0] +
      ');" class="btn btn-sm btn-success">Approve</button></td>' +
      "</tr>";
  }

  document.getElementById("data3").innerHTML += text;
}

// search name function
function searchName3() {
  // empty table
  document.getElementById("data3").innerHTML = "";

  // get user input
  let input = document.getElementById("searchNameInput");
  let filter = input.value.toUpperCase();

  // inject matched data
  let text = "";
  for (i = 0; i < data3.length; i++) {
    if (data3[i][1].toUpperCase().indexOf(filter) > -1) {
      text +=
        '<tr><td scope="row">' +
        data3[i][0] +
        "</td><td>" +
        data3[i][1] +
        "</td><td>" +
        data3[i][2] +
        "</td><td>" +
        data3[i][3] +
        "</td><td>" +
        data3[i][4] +
        "</td><td>" +
        data3[i][5] +
        "</td><td>" +
        data3[i][6] +
        "</td><td>" +
        data3[i][7] +
        "</td><td>" +
        data3[i][8] +
        "</td>" +
        '<td class="text-center"><button onclick="viewFullInfo3(' +
        data3[i][0] +
        ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal3">View</button></td>' +
        '<td class="text-center"><button onclick="approveUser(' +
        data3[i][0] +
        ');" class="btn btn-sm btn-success">Approve</button></td>' +
        "</tr>";
    }
  }

  document.getElementById("data3").innerHTML += text;
}

// function to pass information to modal when 'edit' button is clicked
function viewFullInfo3(id) {
  for (i = 0; i < data3.length; i++) {
    if (data3[i][0] === id) {
      $("#invisibleID").val(data3[i][0]);
      $("#inputName").val(data3[i][1]);
      $("#inputAddress").val(data3[i][2]);
      $("#inputContactNo").val(data3[i][3]);
      $("#inputEmail").val(data3[i][4]);
      $("#inputRegistrationNo").val(data3[i][5]);
      $("#inputLicenseNo").val(data3[i][6]);
      $("#inputRegistrationDate").val(data3[i][7]);
      $("#inputSpecialization").val(data3[i][8]);
    }
  }
}

// function to delete row when 'delete' button is clicked
function approveUser(id) {
  // empty table
  document.getElementById("data3").innerHTML = "";

  // remove deleted row from data
  for (i = 0; i < data3.length; i++) {
    if (data3[i][0] === id) {
      data3.splice(i, 1);
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data3.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data3[i][0] +
      "</td><td>" +
      data3[i][1] +
      "</td><td>" +
      data3[i][2] +
      "</td><td>" +
      data3[i][3] +
      "</td><td>" +
      data3[i][4] +
      "</td><td>" +
      data3[i][5] +
      "</td><td>" +
      data3[i][6] +
      "</td><td>" +
      data3[i][7] +
      "</td><td>" +
      data3[i][8] +
      "</td>" +
      '<td class="text-center"><button onclick="viewFullInfo3(' +
      data3[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal3">View</button></td>' +
      '<td class="text-center"><button onclick="approveUser(' +
      data3[i][0] +
      ');" class="btn btn-sm btn-success">Approve</button></td>' +
      "</tr>";
  }

  document.getElementById("data3").innerHTML += text;
  $("#alert_approval").css("display", "block");
}

function close_alert() {
  $("#alert_approval").css("display", "none");
}
