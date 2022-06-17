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
