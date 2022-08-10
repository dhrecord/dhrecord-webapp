//get dropdown list and searchbar
const dropdown = document.getElementById("survey_ddlfilter");
const searchbar = document.getElementById("searchbar_filter");
//get td rows
const table_body = document.querySelector("#data");
const rows = table_body.querySelectorAll("tr");

//add eventlistener for filter dropdown list. this basically checks for any action done. for example, onclick, onchange...
//dropdownlist event
searchbar.addEventListener("input", (evt) => {
  try {
    const q = evt.currentTarget.value.toLowerCase(); //standardize lowercase for matching
    const value = dropdown.value;
    if (value !== "Filter By...") {
      //if dropdown list is not empty string, meaning dropdown is selected
      rows.forEach((row) => {
        const matches = row.childNodes[value].textContent
          .toLowerCase()
          .includes(q);
        row.style.display = matches ? "" : "none";
      });
    } else {
      alert("please select a category from the dropdown list");
    }
  } catch (e) {
    console.log(e);
  }
});

dropdown.addEventListener("change", (evt) => {
  try {
    const value = evt.currentTarget.value;
    if (value === "2") {
      searchbar.setAttribute("type", "date");
    } else {
      searchbar.setAttribute("type", "text");
    }
  } catch (e) {
    console.log(e);
  }
});
