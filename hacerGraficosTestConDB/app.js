window.addEventListener("load", start, false);

function start() {
  const button = document.getElementById("button");
  button.addEventListener("click", getData, false);
  const startDate = document.getElementById("startDate");
  const endDate = document.getElementById("endDate");

  function getDataFromSelect() {
    for (let elem of selectElement2) {
      if (elem.selected == true) {
        return elem.value;
      }
    }
  }

  function getData() {
    // console.log(getDataFromSelect())
    var params = `companySymbol=${getDataFromSelect()}&startDate=${
      startDate.value
    }&endDate=${endDate.value}`;
    // console.log(params);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "getDataFromYahoo.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let data = this.responseText;
				// console.log(data);
				drawGraphic(data);
      }
    };
    xhttp.send(params);
  }

  function drawGraphic(data) {
		document.getElementById("my_dataviz").innerHTML = "";
    // set the dimensions and margins of the graph
    var margin = { top: 10, right: 30, bottom: 30, left: 60 },
      width = 1000 - margin.left - margin.right,
      height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3
      .select("#my_dataviz")
      .append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
      .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    //Read the data
    // let url = "https://query1.finance.yahoo.com/v7/finance/download/ACER?period1=1615298400&period2=1615471200&interval=1d&events=history&includeAdjustedClose=true&Open=false";
    // let url = "data.csv";
    d3.csv(
      "data.csv",
      // "https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/3_TwoNumOrdered_comma.csv",

      // When reading the csv, I must format variables:
      function (d) {
        return { Date: d3.timeParse("%Y-%m-%d")(d.Date), Open: d.Open };
      },

      // Now I can use this dataset:
      function (data) {
        // Add X axis --> it is a date format
        var x = d3
          .scaleTime()
          .domain(
            d3.extent(data, function (d) {
              return d.Date;
            })
          )
          .range([0, width]);
        svg
          .append("g")
          .attr("transform", "translate(0," + height + ")")
          .call(d3.axisBottom(x));

        // Add Y axis
        var y = d3
          .scaleLinear()
          .domain([
            0,
            d3.max(data, function (d) {
              return +d.Open;
            }),
          ])
          .range([height, 0]);
        svg.append("g").call(d3.axisLeft(y));

        // Add the line
        svg
          .append("path")
          .datum(data)
          .attr("fill", "none")
          .attr("stroke", "steelblue")
          .attr("stroke-width", 1.5)
          .attr(
            "d",
            d3
              .line()
              .x(function (d) {
                return x(d.Date);
              })
              .y(function (d) {
                return y(d.Open);
              })
          );
      }
    );
  }
}
