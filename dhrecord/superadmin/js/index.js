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
