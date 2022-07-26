//get dropdown list and searchbar
const dropdown = document.getElementById("referralTracking_ddlfilter");
const searchbar = document.getElementById("searchbar_filter")
//get td rows
const table_body = document.querySelector("#data");
const rows = table_body.querySelectorAll("tr");

//add eventlistener for filter dropdown list. this basically checks for any action done. for example, onclick, onchange...
//dropdownlist event
searchbar.addEventListener("input", (evt) =>{
    try {
        const q = evt.currentTarget.value.toLowerCase(); //standardize lowercase for matching
        const value = dropdown.value;
        if(value) { //if dropdown list is not empty string, meaning dropdown is selected
            rows.forEach(row => {
                const matches = row.childNodes[value].textContent.toLowerCase().startsWith(q);
                row.style.display = matches ? "" : "none";
            })
        }
        else {
            alert("please select a category from the dropdown list")
        }
    }
    catch (e){
        console.log(e);
    }
     
})
