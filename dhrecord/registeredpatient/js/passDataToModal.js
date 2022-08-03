function passData(docName, specializations, operatingHours) {
  const dn = document.getElementById("d_name");
  dn.innerHTML = docName;

  const sl = document.getElementById("spec_list");
  sl.innerHTML = specializations;

  const oh = document.getElementById("o_hours");

  if (operatingHours !== "-") {
    let oh_item = operatingHours.split(", ");
    let oh_html = "<p>";

    for (let i = 0; i < oh_item.length; i++) {
      let oh_item_day = "";
      oh_item_day += oh_item[i].substring(1, oh_item[i].length - 1);
      oh_item_day += "<br/>";

      oh_html += oh_item_day;
    }

    oh_html += "</p>";
    oh.innerHTML = oh_html;
  } else {
    oh.innerHTML = "-";
  }
}
