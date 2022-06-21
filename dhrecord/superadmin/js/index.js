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
  let to_Upper = input.value.toUpperCase();

  // get selected filter
  let filter = $("#userManagement_ddlFilterBy").val();
  filter = parseInt(filter);

  // inject matched data
  let text = "";
  for (i = 0; i < data.length; i++) {
    if (data[i][filter - 1].toString().toUpperCase().indexOf(to_Upper) > -1) {
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
  let to_Upper = input.value.toUpperCase();

  // get selected filter
  let filter = $("#regManPA_ddlFilterBy").val();
  filter = parseInt(filter);

  // inject matched data
  let text = "";
  for (i = 0; i < data2.length; i++) {
    if (data2[i][filter - 1].toUpperCase().indexOf(to_Upper) > -1) {
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
    "Pediatric Dentistry",
    "123456789012",
    "C0019292",
    "21/03/2021",
    "2 Years",
    "Active",
  ],
  [
    2,
    "Dental Care",
    "926 Yishun Central 1 01-177, 760926, Singapore",
    "+65 8952 7201",
    "DentalCare@gmail.com",
    "Periodontics, Prosthodontics",
    "234567890123",
    "C0315261",
    "08/08/2021",
    "5 Years",
    "Active",
  ],
  [
    3,
    "Go Dental",
    "112 East Coast Road #B1-14 112 Katong, 428802, Singapore",
    "+65 9786 5789",
    "GoDental@gmail.com",
    "Oral surgery",
    "345678901234",
    "C2032352",
    "17/09/2021",
    "1 Year",
    "Active",
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
      data3[i][8] +
      "</td><td>" +
      data3[i][9] +
      "</td><td>" +
      data3[i][10] +
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
  let to_Upper = input.value.toUpperCase();

  // get selected filter
  let filter = $("#regManBO_ddlFilterBy").val();
  filter = parseInt(filter);

  // inject matched data
  let text = "";
  for (i = 0; i < data3.length; i++) {
    if (data3[i][filter - 1].toUpperCase().indexOf(to_Upper) > -1) {
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
        data3[i][8] +
        "</td><td>" +
        data3[i][9] +
        "</td><td>" +
        data3[i][10] +
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
      $("#inputSpecialization").val(data3[i][5]);
      $("#inputRegistrationNo").val(data3[i][6]);
      $("#inputLicenseNo").val(data3[i][7]);
      $("#inputRegistrationDate").val(data3[i][8]);
      $("#inputContractPeriod").val(data3[i][9]);
      $("#inputAccountStatus").val(data3[i][10]);
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
      data3[i][8] +
      "</td><td>" +
      data3[i][9] +
      "</td><td>" +
      data3[i][10] +
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

// CLINIC SPECIALIZATION
// sample data
var data4 = [
  [
    1,
    "Oral surgery",
    "Surgical management of conditions affecting the oral and dento-alveolar tissues",
  ],
  [
    2,
    "Orthodontic",
    "Supervision, guidance and correction of the growing and mature dentofacial structures",
  ],
  [
    3,
    "Paediatric dentistry",
    "Oral health care for children and those with special needs",
  ],
  [
    4,
    "Forensic odontology",
    "The examination and evaluation of dental evidence for interests of justice",
  ],
  [
    5,
    "Prosthodontics",
    "Reconstruction of the natural teeth, replacement of missing teeth, and substitution of contiguous oral and maxillofacial tissues",
  ],
  [
    6,
    "Periodontics",
    "Treatment of diseases or abnormalities of the supporting tissues of the teeth and their substitutes",
  ],
  [
    7,
    "Dento-maxillofacial radiology",
    "Diagnostic imaging procedures applied to the hard and soft tissues of the oral and maxillofacial region",
  ],
];

// inject data to table in 'user management' page => onLoad
function findData4() {
  let text = "";
  for (i = 0; i < data4.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data4[i][0] +
      "</td><td>" +
      data4[i][1] +
      "</td><td>" +
      data4[i][2] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal4">Edit</button></td>' +
      '<td class="text-center"><button onclick="deleteInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-danger">Delete</button></td>' +
      "</tr>";
  }

  document.getElementById("data4").innerHTML += text;
}

// search specialization name function
function searchSpecializationName() {
  // empty table
  document.getElementById("data4").innerHTML = "";

  // get user input
  let input = document.getElementById("searchNameInput2");
  let filter = input.value.toUpperCase();

  // inject matched data
  let text = "";
  for (i = 0; i < data4.length; i++) {
    if (data4[i][1].toUpperCase().indexOf(filter) > -1) {
      text +=
        '<tr><td scope="row">' +
        data4[i][0] +
        "</td><td>" +
        data4[i][1] +
        "</td><td>" +
        data4[i][2] +
        "</td>" +
        '<td class="text-center"><button onclick="editInfo4(' +
        data4[i][0] +
        ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal4">Edit</button></td>' +
        '<td class="text-center"><button onclick="deleteInfo4(' +
        data4[i][0] +
        ');" class="btn btn-sm btn-danger">Delete</button></td>' +
        "</tr>";
    }
  }

  document.getElementById("data4").innerHTML += text;
}

// function to pass information to modal when 'edit' button is clicked
function editInfo4(id) {
  for (i = 0; i < data4.length; i++) {
    if (data4[i][0] === id) {
      $("#invisibleID").val(data4[i][0]);
      $("#inputSpecializationName").val(data4[i][1]);
      $("#inputDescription").val(data4[i][2]);
    }
  }
}

// function to save the updated information from modal
function saveDetails4() {
  // validate input - not null
  let ID = $("#invisibleID").val();
  let specialization_name = $("#inputSpecializationName").val();
  let description = $("#inputDescription").val();

  if (
    ID.trim() === "" ||
    specialization_name.trim() === "" ||
    description.trim() === ""
  ) {
    alert("Invalid! Please don't leave the input field empty!");
    return;
  }

  // empty table
  document.getElementById("data4").innerHTML = "";

  // update data of the user
  ID = parseInt(ID);
  for (i = 0; i < data4.length; i++) {
    if (data4[i][0] == ID) {
      data4[i] = [ID, specialization_name, description];
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data4.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data4[i][0] +
      "</td><td>" +
      data4[i][1] +
      "</td><td>" +
      data4[i][2] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal4">Edit</button></td>' +
      '<td class="text-center"><button onclick="deleteInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-danger">Delete</button></td>' +
      "</tr>";
  }

  document.getElementById("data4").innerHTML += text;
  $("#popupModal4").modal("hide");
}

function saveDetails5() {
  // validate input - not null
  let ID = data4[data4.length - 1][0] + 1;
  let specialization_name = $("#inputSpecializationName2").val();
  let description = $("#inputDescription2").val();

  if (specialization_name.trim() === "" || description.trim() === "") {
    alert("Invalid! Please don't leave the input field empty!");
    return;
  }

  // empty table
  document.getElementById("data4").innerHTML = "";

  // add item to array
  data4.push([ID, specialization_name, description]);

  // display updated table
  let text = "";
  for (i = 0; i < data4.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data4[i][0] +
      "</td><td>" +
      data4[i][1] +
      "</td><td>" +
      data4[i][2] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal4">Edit</button></td>' +
      '<td class="text-center"><button onclick="deleteInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-danger">Delete</button></td>' +
      "</tr>";
  }

  document.getElementById("data4").innerHTML += text;

  $("#inputSpecializationName2").val("");
  $("#inputDescription2").val("");

  $("#popupModal5").modal("hide");
}

// function to delete row when 'delete' button is clicked
function deleteInfo4(id) {
  // empty table
  document.getElementById("data4").innerHTML = "";

  // remove deleted row from data
  for (i = 0; i < data4.length; i++) {
    if (data4[i][0] === id) {
      data4.splice(i, 1);
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data4.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data4[i][0] +
      "</td><td>" +
      data4[i][1] +
      "</td><td>" +
      data4[i][2] +
      "</td>" +
      '<td class="text-center"><button onclick="editInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#popupModal4">Edit</button></td>' +
      '<td class="text-center"><button onclick="deleteInfo4(' +
      data4[i][0] +
      ');" class="btn btn-sm btn-danger">Delete</button></td>' +
      "</tr>";
  }

  document.getElementById("data4").innerHTML += text;
}

// CLINIC SPECIALIZATION - Review Request
// sample data
var data5 = [
  [
    1,
    "Endodontic",
    "Morphology and pathology of the pulpo-dentine complex and periradicular tissues",
    "Y-Dental",
  ],
  [
    2,
    "Oral and maxillofacial surgery",
    "Diagnosis, surgical and adjunctive treatment of diseases, injuries and defects of human jaws and associated structures",
    "Dental Care",
  ],
  [
    3,
    "Oral medicine",
    "Oral health care of patients with chronic and medically related disorders of the oral and maxillofacial region.",
    "ArcDent",
  ],
];

// inject data to table in 'user management' page => onLoad
function findData5() {
  let text = "";
  for (i = 0; i < data5.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data5[i][0] +
      "</td><td>" +
      data5[i][1] +
      "</td><td>" +
      data5[i][2] +
      "</td><td>" +
      data5[i][3] +
      "</td>" +
      '<td class="text-center"><button onclick="approve5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#popupModal5">Approve</button></td>' +
      '<td class="text-center"><button onclick="reject5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-danger">Reject</button></td>' +
      "</tr>";
  }

  document.getElementById("data5").innerHTML += text;
}

// function to delete row when 'delete' button is clicked
function approve5(id) {
  // empty table
  document.getElementById("data5").innerHTML = "";

  // remove deleted row from data
  for (i = 0; i < data5.length; i++) {
    if (data5[i][0] === id) {
      data5.splice(i, 1);
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data5.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data5[i][0] +
      "</td><td>" +
      data5[i][1] +
      "</td><td>" +
      data5[i][2] +
      "</td><td>" +
      data5[i][3] +
      "</td>" +
      '<td class="text-center"><button onclick="approve5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#popupModal5">Approve</button></td>' +
      '<td class="text-center"><button onclick="reject5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-danger">Reject</button></td>' +
      "</tr>";
  }

  document.getElementById("data5").innerHTML += text;
  document.getElementById("msg-alert").innerHTML =
    "Request is approved successfully!";
  $("#alert_approval").css("display", "block");
}

function reject5(id) {
  // empty table
  document.getElementById("data5").innerHTML = "";

  // remove deleted row from data
  for (i = 0; i < data5.length; i++) {
    if (data5[i][0] === id) {
      data5.splice(i, 1);
    }
  }

  // display updated table
  let text = "";
  for (i = 0; i < data5.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data5[i][0] +
      "</td><td>" +
      data5[i][1] +
      "</td><td>" +
      data5[i][2] +
      "</td><td>" +
      data5[i][3] +
      "</td>" +
      '<td class="text-center"><button onclick="approve5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#popupModal5">Approve</button></td>' +
      '<td class="text-center"><button onclick="reject5(' +
      data5[i][0] +
      ');" class="btn btn-sm btn-danger">Reject</button></td>' +
      "</tr>";
  }

  document.getElementById("data5").innerHTML += text;
  document.getElementById("msg-alert").innerHTML =
    "Request is rejected successfully!";
  $("#alert_approval").css("display", "block");
}

function close_alert() {
  $("#alert_approval").css("display", "none");
}

// AUDIT LOG
// sample data
var data6 = [
  [
    1,
    "26/01/2022, 02:11:23 AM",
    24,
    "Jack",
    "Update User",
    "User: Jack11@gmail.com",
  ],
  [
    2,
    "25/01/2022 11:40:03 AM",
    23,
    "Nate",
    "	Update User",
    "User: Nate22@gmail.com",
  ],
  [3, "23/01/2022 09:22:21 PM", 1, "Sam", "Add User", "	User: Jack11@gmail.com"],
  [4, "23/01/2022 07:30:33 PM", 1, "Sam", "Add user", "User: Nate22@gmail.com"],
];

// inject data to table in 'user management' page => onLoad
function findData6() {
  let text = "";
  for (i = 0; i < data6.length; i++) {
    text +=
      '<tr><td scope="row">' +
      data6[i][0] +
      "</td><td>" +
      data6[i][1] +
      "</td><td>" +
      data6[i][2] +
      "</td><td>" +
      data6[i][3] +
      "</td><td>" +
      data6[i][4] +
      "</td><td>" +
      data6[i][5] +
      "</td></tr>";
  }

  document.getElementById("data6").innerHTML += text;
}

// search audit function
function searchAuditLog() {
  // empty table
  document.getElementById("data6").innerHTML = "";

  // get user input
  let input = document.getElementById("searchAuditLog");
  let to_Upper = input.value.toUpperCase();

  // get selected filter
  let filter = $("#auditLog_ddlFilterBy").val();
  filter = parseInt(filter);

  // inject matched data
  let text = "";
  for (i = 0; i < data6.length; i++) {
    if (data6[i][filter - 1].toString().toUpperCase().indexOf(to_Upper) > -1) {
      text +=
        '<tr><td scope="row">' +
        data6[i][0] +
        "</td><td>" +
        data6[i][1] +
        "</td><td>" +
        data6[i][2] +
        "</td><td>" +
        data6[i][3] +
        "</td><td>" +
        data6[i][4] +
        "</td><td>" +
        data6[i][5] +
        "</td></tr>";
    }
  }

  document.getElementById("data6").innerHTML += text;
}
