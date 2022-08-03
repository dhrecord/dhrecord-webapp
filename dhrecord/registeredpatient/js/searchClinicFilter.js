function tableSearch() {
  let select = document.getElementById("auditLog_ddlFilterBy");
  let value = select.options[select.selectedIndex].value;

  let input, filter, table, tr, td, txtValue;
  let tr2, tr3;

  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("clinicTable");
  tr = table.getElementsByTagName("tr");

  // search by clinic name
  if (value === "1") {
    for (let i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];

      if (td) {
        txtValue = td.textContent || td.innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }

      tr2 = document.getElementsByClassName("docs");
      for (let k = 0; k < tr2.length; k++) {
        tr3 = tr2[k].getElementsByTagName("tr");
        for (let j = 0; j < tr3.length; j++) {
          tr3[j].style.display = "";
        }
      }
    }
  }

  // search by services
  else if (value === "2") {
    let temp = 0;
    let last = 0;
    for (let i = 0; i < tr.length; i++) {
      if (tr[i].innerHTML.indexOf('<th class="px-4">Services</th>') > -1) {
        temp = i - 1;
      }

      td = tr[i].getElementsByTagName("td")[1];

      if (td) {
        txtValue = td.innerHTML;
        let split_content = txtValue.split("<tbody>");

        if (split_content.length === 1) {
          let addr = split_content[0];

          if (addr.toUpperCase().indexOf(filter) > -1) {
            tr[temp].style.display = "";
            last = temp;
          } else {
            if (last !== temp) {
              tr[temp].style.display = "none";
            }
          }
        }
      }

      tr2 = document.getElementsByClassName("docs");
      for (let k = 0; k < tr2.length; k++) {
        tr3 = tr2[k].getElementsByTagName("tr");
        for (let j = 0; j < tr3.length; j++) {
          tr3[j].style.display = "";
        }
      }
    }
  }

  // search by address
  else if (value === "3") {
    for (let i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];

      if (td) {
        txtValue = td.innerHTML;
        let split_content = txtValue.split("<b>");

        if (split_content.length > 1) {
          let addr = split_content[1].split("/b>")[1].split("<br>")[0];

          if (addr.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }

      tr2 = document.getElementsByClassName("docs");
      for (let k = 0; k < tr2.length; k++) {
        tr3 = tr2[k].getElementsByTagName("tr");
        for (let j = 0; j < tr3.length; j++) {
          tr3[j].style.display = "";
        }
      }
    }
  }

  // search by postal code
  else if (value === "4") {
    for (let i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];

      if (td) {
        txtValue = td.innerHTML;
        let split_content = txtValue.split("<b>");

        if (split_content.length > 1) {
          let addr = split_content[2].split("/b>")[1].split("<br>")[0];

          if (addr.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }

      tr2 = document.getElementsByClassName("docs");
      for (let k = 0; k < tr2.length; k++) {
        tr3 = tr2[k].getElementsByTagName("tr");
        for (let j = 0; j < tr3.length; j++) {
          tr3[j].style.display = "";
        }
      }
    }
  }
}
