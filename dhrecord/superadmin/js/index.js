// sample data
var data = [
  [
    1,
    "John Doe",
    "5 Magazine Road #02-01, 059571, Singapore",
    "S5219994H",
    "+65 8950 4262",
    "JohnDoe@gmail.com",
  ],
  [
    2,
    "Jane Doe",
    "926 Yishun Central 1 01-177, 760926, Singapore",
    "S6891261Z",
    "+65 8952 7201",
    "JaneDoe@gmail.com",
  ],
  [
    3,
    "Nate",
    "1 Coleman Street 02-30/31 The Adelphi, 179803, Singapore",
    "S9168686D",
    "+65 9786 5789",
    "Nate22@gmail.com",
  ],
  [
    4,
    "Jack",
    "112 East Coast Road #B1-14 112 Katong, 428802, Singapore",
    "S5397679D",
    "+65 8951 7299",
    "Jack11@gmail.com",
  ],
];

// inject data to table in 'user management' page
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
      "</td>" +
      '<td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
      '<td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
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
        "</td>" +
        '<td class="text-center"><button class="border-0 edit-btn" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
        '<td class="text-center"><button class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
    }
  }

  document.getElementById("data").innerHTML += text;
}

// to pass information to modal when 'edit' button is clicked
$(".edit-btn").click(function () {
  // get the name
  var $name = $(this)
    .closest("tr") // Finds the closest row <tr>
    .find("td:first")
    .text(); // Retrieves the text within <td>
  $("#inputName").val($name);

  // get the address
  var $address = $(this).closest("tr").find("td:eq(1)").text();
  $("#inputAddress").val($address);

  // get the NRIC
  var $NRIC = $(this).closest("tr").find("td:eq(2)").text();
  $("#inputNRIC").val($NRIC);

  // get the contact no.
  var $contactNo = $(this).closest("tr").find("td:eq(3)").text();
  $("#inputContactNo").val($contactNo);

  // get the email
  var $email = $(this).closest("tr").find("td:eq(4)").text();
  $("#inputEmail").val($email);
});
