// js file for Business owner
var prescriptionData = [
    [
        1,
        "Acidul",
        "Fluorides Toothpaste",
        "10",
        "Due for restocking soon",        
    ],
    [
        2,
        "Bcidul",
        "Dluorides Toothpaste",
        "1",
        "Due for restocking soon",
    ],
];

function findPrescriptionData() {
    let text = "";
    for (i = 0; i < prescriptionData.length; i++) {
        text +=
            '<tr><td scope="row">' +
            prescriptionData[i][0] +
            "</td><td>" +
            prescriptionData[i][1] +
            "</td><td>" +
            prescriptionData[i][2] +
            "</td><td>" +
            prescriptionData[i][3] +
            "</td><td>" +
            prescriptionData[i][4] +                       
            '<td class="text-center"><button onclick="editInfo(' +
            prescriptionData[i][0] +
            ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
            '<td class="text-center"><button onclick="deleteRow(' +
            prescriptionData[i][0] +
            ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
    }

    document.getElementById("prescriptionData").innerHTML += text;
}


// search name function
function search() {
    // empty table
    document.getElementById("prescriptionData").innerHTML = "";

    // get user input
    let input = document.getElementById("searchInput");
    let finalInput = input.value.toUpperCase();
    //let finalInput = input1.toString()

    let f = document.getElementById("ddlFilterBy");
    let filterBy = f.value -1;

    if (filterBy > -1) { }
    else {
           alert("Please select a category for filter before searching");
        }


    // inject matched data
    let text = "";
    //let result = prescriptionData.filter(checkNum);
    for (i = 0; i < prescriptionData.length; i++) {

        switch (filterBy)
        {
            case 0:
                if (prescriptionData[i][0] == finalInput) {
                    // if (filterBy != "") {
                    text +=
                        '<tr><td scope="row">' +
                        prescriptionData[i][0] +
                        "</td><td>" +
                        prescriptionData[i][1] +
                        "</td><td>" +
                        prescriptionData[i][2] +
                        "</td><td>" +
                        prescriptionData[i][3] +
                        "</td><td>" +
                        prescriptionData[i][4] +
                        '<td class="text-center"><button onclick="editInfo(' +
                        prescriptionData[i][0] +
                        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                        '<td class="text-center"><button onclick="deleteRow(' +
                        prescriptionData[i][0] +
                        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
                }
                break;

            case 1:
                if (prescriptionData[i][1].toUpperCase().indexOf(finalInput) > -1) {
                    text +=
                        '<tr><td scope="row">' +
                        prescriptionData[i][0] +
                        "</td><td>" +
                        prescriptionData[i][1] +
                        "</td><td>" +
                        prescriptionData[i][2] +
                        "</td><td>" +
                        prescriptionData[i][3] +
                        "</td><td>" +
                        prescriptionData[i][4] +
                        '<td class="text-center"><button onclick="editInfo(' +
                        prescriptionData[i][0] +
                        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                        '<td class="text-center"><button onclick="deleteRow(' +
                        prescriptionData[i][0] +
                        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';

                }
                break;

            case 2:
                if (prescriptionData[i][2].toUpperCase().indexOf(finalInput) > -1) {
                    text +=
                        '<tr><td scope="row">' +
                        prescriptionData[i][0] +
                        "</td><td>" +
                        prescriptionData[i][1] +
                        "</td><td>" +
                        prescriptionData[i][2] +
                        "</td><td>" +
                        prescriptionData[i][3] +
                        "</td><td>" +
                        prescriptionData[i][4] +
                        '<td class="text-center"><button onclick="editInfo(' +
                        prescriptionData[i][0] +
                        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                        '<td class="text-center"><button onclick="deleteRow(' +
                        prescriptionData[i][0] +
                        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';

                }
                break;

            case 3:
                if (prescriptionData[i][3] == finalInput) {
                    // if (filterBy != "") {
                    text +=
                        '<tr><td scope="row">' +
                        prescriptionData[i][0] +
                        "</td><td>" +
                        prescriptionData[i][1] +
                        "</td><td>" +
                        prescriptionData[i][2] +
                        "</td><td>" +
                        prescriptionData[i][3] +
                        "</td><td>" +
                        prescriptionData[i][4] +
                        '<td class="text-center"><button onclick="editInfo(' +
                        prescriptionData[i][0] +
                        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                        '<td class="text-center"><button onclick="deleteRow(' +
                        prescriptionData[i][0] +
                        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
                }
                break;

            case 4:
                if (prescriptionData[i][4].toUpperCase().indexOf(finalInput) > -1) {
                    text +=
                        '<tr><td scope="row">' +
                        prescriptionData[i][0] +
                        "</td><td>" +
                        prescriptionData[i][1] +
                        "</td><td>" +
                        prescriptionData[i][2] +
                        "</td><td>" +
                        prescriptionData[i][3] +
                        "</td><td>" +
                        prescriptionData[i][4] +
                        '<td class="text-center"><button onclick="editInfo(' +
                        prescriptionData[i][0] +
                        ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                        '<td class="text-center"><button onclick="deleteRow(' +
                        prescriptionData[i][0] +
                        ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';

                }
                break;

            default:
                text = "No value found";
        }
          
    }

    document.getElementById("prescriptionData").innerHTML += text;
}

// function to delete row when 'delete' button is clicked
function deleteRow(id) {
    // empty table
    document.getElementById("prescriptionData").innerHTML = "";

    // remove deleted row from data
    for (i = 0; i < prescriptionData.length; i++) {
        if (prescriptionData[i][0] === id) {
            prescriptionData.splice(i, 1);
        }
    }

    // display updated table
    let text = "";
    for (i = 0; i < prescriptionData.length; i++) {
        text +=
            '<tr><td scope="row">' +
            prescriptionData[i][0] +
            "</td><td>" +
            prescriptionData[i][1] +
            "</td><td>" +
            prescriptionData[i][2] +
            "</td><td>" +
            prescriptionData[i][3] +
            "</td><td>" +
            prescriptionData[i][4] +
            '<td class="text-center"><button onclick="editInfo(' +
            prescriptionData[i][0] +
            ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
            '<td class="text-center"><button onclick="deleteRow(' +
            prescriptionData[i][0] +
            ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
    }

    document.getElementById("prescriptionData").innerHTML += text;
}

// function to pass information to modal when 'edit' button is clicked
function editInfo(id) {
    for (i = 0; i < prescriptionData.length; i++) {
        if (prescriptionData[i][0] === id) {
            $("#invisibleID").val(prescriptionData[i][0]);
            $("#updatePrescriptionName").val(prescriptionData[i][1]);
            $("#updatePrescriptionDesc").val(prescriptionData[i][2]);
            $("#updateQty").val(prescriptionData[i][3]);
            $("#updateRemarks").val(prescriptionData[i][4]);
        }
    }
}

// function to save the updated information from modal
function saveDetails() {

    // validate input - not null
    let ID = $("#invisibleID").val();
    let name = $("#updatePrescriptionName").val();
    let desc = $("#updatePrescriptionDesc").val();
    let qty = $("#updateQty").val();
    let remarks = $("#updateRemarks").val();

    //if (
    //    ID.trim() === "" ||
    //    name.trim() === "" ||
    //    desc.trim() === "" ||
    //    qty.trim() === "" ||
    //    remarks.trim() === ""
    //) {
    //    alert("Invalid! Please don't leave the input field empty!");
    //    return;
    //}

    // empty table
    document.getElementById("prescriptionData").innerHTML = "";

    // update data of the user
    ID = parseInt(ID);
    for (i = 0; i < prescriptionData.length; i++) {
        if (prescriptionData[i][0] == ID) {
            prescriptionData[i] = [ID, name, desc, qty, remarks];
        }
    }

    // display updated table
    let text = "";
    for (i = 0; i < prescriptionData.length; i++) {

        for (i = 0; i < prescriptionData.length; i++) {
            text +=
                '<tr><td scope="row">' +
                prescriptionData[i][0] +
                "</td><td>" +
                prescriptionData[i][1] +
                "</td><td>" +
                prescriptionData[i][2] +
                "</td><td>" +
                prescriptionData[i][3] +
                "</td><td>" +
                prescriptionData[i][4] +
                '<td class="text-center"><button onclick="editInfo(' +
                prescriptionData[i][0] +
                ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                '<td class="text-center"><button onclick="deleteRow(' +
                prescriptionData[i][0] +
                ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
        }

        document.getElementById("prescriptionData").innerHTML += text;
        $("#popupModal").modal("hide");
    }

}
function addID() {

    let name1 = $("#updatePrescriptionName1").val();
    let desc1 = $("#updatePrescriptionDesc1").val();
    let qty1 = $("#updateQty1").val();
    let remarks1 = $("#updateRemarks1").val();

    let currentID = prescriptionData[prescriptionData.length - 1][0]
    currentID++;
    // update data of the user
    //ID1 = parseInt(newID);
    //prescriptionData.push(currentID, name1, desc1, qty1, remarks1);

    

    // empty table
    document.getElementById("prescriptionData").innerHTML = "";
   
    //prescriptionData[3][0].push(3);
    //prescriptionData[3][1].push(name1);
    //prescriptionData[3][2].push(desc1);
    //prescriptionData[3][3].push(qty1);
    //prescriptionData[3][4].push(remarks1);

    let valueToPush = new Array();
    valueToPush[0] = currentID;
    valueToPush[1] = name1;
    valueToPush[2] = desc1;
    valueToPush[3] = qty1;
    valueToPush[4] = remarks1;
    prescriptionData.push(valueToPush);

    // display updated table
    let text = "";
    for (i = 0; i < prescriptionData.length; i++) {

        for (i = 0; i < prescriptionData.length; i++) {
            text +=
                '<tr><td scope="row">' +
                prescriptionData[i][0] +
                "</td><td>" +
                prescriptionData[i][1] +
                "</td><td>" +
                prescriptionData[i][2] +
                "</td><td>" +
                prescriptionData[i][3] +
                "</td><td>" +
                prescriptionData[i][4] +
                '<td class="text-center"><button onclick="editInfo(' +
                prescriptionData[i][0] +
                ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                '<td class="text-center"><button onclick="deleteRow(' +
                prescriptionData[i][0] +
                ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
        }

        document.getElementById("prescriptionData").innerHTML += text;
        //$("#popupModal1").modal("hide");
    }    

}


function AddInfo() {

    //let currentID = prescriptionData[prescriptionData.length - 1][0]
    //currentID++;
    // update data of the user
    //ID1 = parseInt(newID);
    //prescriptionData.push(currentID, name1, desc1, qty1, remarks1);
    //let newID = currentID++;

    // validate input - not null
    //let ID1 = newID;
    //let name1 = $("#updatePrescriptionName1").val();
    //let desc1 = $("#updatePrescriptionDesc1").val();
    //let qty1 = $("#updateQty1").val();
    //let remarks1 = $("#updateRemarks1").val();            

    

    // empty table
    document.getElementById("prescriptionData").innerHTML = "";

    // display updated table
    let text = "";
    for (i = 0; i < prescriptionData.length; i++) {

        for (i = 0; i < prescriptionData.length; i++) {
            text +=
                '<tr><td scope="row">' +
                prescriptionData[i][0] +
                "</td><td>" +
                prescriptionData[i][1] +
                "</td><td>" +
                prescriptionData[i][2] +
                "</td><td>" +
                prescriptionData[i][3] +
                "</td><td>" +
                prescriptionData[i][4] +
                '<td class="text-center"><button onclick="editInfo(' +
                prescriptionData[i][0] +
                ');" class="border-0" data-bs-toggle="modal" data-bs-target="#popupModal"><i class="fa-solid fa-pen-to-square"></i></button></td>' +
                '<td class="text-center"><button onclick="deleteRow(' +
                prescriptionData[i][0] +
                ');" class="border-0"><i class="fa-solid fa-trash-can"></i></button></td><tr>';
        }

        document.getElementById("prescriptionData").innerHTML += text;
        $("#popupModal1").modal("hide");
    }
    
}



