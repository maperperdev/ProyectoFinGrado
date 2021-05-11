<meta name="csrf-token" content="{{{ csrf_token() }}}">
<input list="companySymbols" name="companySymbol" id="companySymbol" placeholder="Introduce the name of a stock">
<datalist id=companySymbols>
    @foreach ($stocks as $stock)
    <option value="{{$stock->asset_symbol}}">{{ $stock->asset_name }}</option>
    @endforeach
</datalist>

<br /><input type="date" name="startDate" id="startDate" required />
<br /><input type="date" name="endDate" id="endDate" required />
<br /><input type="button" value="Enviar" id="button" />

<div id="my_dataviz"></div>

<script src="https://d3js.org/d3.v4.js"></script>
<script>
    window.addEventListener("load", start, false);

    function start() {
        const selectedStock = document.getElementById("companySymbol")
        const button = document.getElementById("button");
        button.addEventListener("click", getData, false);
        const startDate = document.getElementById("startDate");
        const endDate = document.getElementById("endDate");

        function getData(e) {
            // console.log(getDataFromSelect())
            e.preventDefault();
            var params = `companySymbol=${selectedStock.value}&startDate=${
      startDate.value
    }&endDate=${endDate.value}`;
            // console.log(params);
            var xhttp = new XMLHttpRequest();
            const url = "/makeChart"
            const tokenCSRF = document.getElementsByName("csrf-token")[0].content;
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.setRequestHeader("x-csrf-token", tokenCSRF);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let data = JSON.parse(this.responseText);
                    drawGraphic(data);
                }
            };
            xhttp.send(params);
        }

        function drawGraphic(dataJson) {
            document.getElementById("my_dataviz").innerHTML = "";
            // set the dimensions and margins of the graph
            var margin = {
                top: 10,
                right: 30,
                bottom: 30,
                left: 60
            };
            width = 1000 - margin.left - margin.right;
            height = 400 - margin.top - margin.bottom;

            var svg = d3
                .select("#my_dataviz")
                .append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var parsedData = dataJson.map(function(d, i) {
                return {
                    Date: d3.timeParse("%Y-%m-%d")(d.Date),
                    Open: +d.Open
                };
            });

            var x = d3
                .scaleTime()
                .domain(
                    d3.extent(parsedData, function(d) {
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
                    d3.max(parsedData, function(d) {
                        return +d.Open;
                    }),
                ])
                .range([height, 0]);

            svg.append("g").call(d3.axisLeft(y));

            // Add the line
            svg
                .append("path")
                .datum(parsedData)
                .attr("fill", "none")
                .attr("stroke", "steelblue")
                .attr("stroke-width", 1.5)
                .attr(
                    "d",
                    d3
                    .line()
                    .x(function(d) {
                        return x(d.Date);
                    })
                    .y(function(d) {
                        return y(+d.Open);
                    }))

        }
    }
</script>