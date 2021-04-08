window.addEventListener("load", start, false);

function start() {
  const selectElement = document.getElementById("selectElement");
  const selectElement2 = document.getElementById("selectElement2");
  selectElement.addEventListener(
    "change",
    (e) => {
      switch (e.target.value) {
        case "cryptos":
          createSelectMenu("crypto_name_symbol");
        case "stocks":
          createSelectMenu("stock_name_symbol");
        default:
          selectElement2.innerHTML = "";
          selectElement2.style.visibility = "hidden";
      }
    },
    false
  );


  function createSelectMenu(typeElement) {
    var xhttp = new XMLHttpRequest();
    var results;
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        results = JSON.parse(this.responseText);
        selectElement2.innerHTML = "";
        fillSelectMenu(results);
      }
    };
    xhttp.open("POST", "selectElements.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`typeElement=${typeElement}`);
  }

  function fillSelectMenu(results) {
    selectElement2.style.visibility = "visible";
    let option = document.createElement("option");
    option.appendChild(document.createTextNode("Seleccione una opción"));
    selectElement2.appendChild(option);
    for (const result of results) {
      let option = document.createElement("option");
      option.appendChild(document.createTextNode(result["name"]));
      option.setAttribute("value", result["symbol"]);
      selectElement2.appendChild(option);
    }
  }
}
