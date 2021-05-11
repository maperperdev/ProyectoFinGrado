<!-- <form action="/stocksData" method="POST">
@csrf
<input list="companySymbols" name="companySymbol" id="companySymbol" placeholder="Introduce the name of a stock">
<datalist id="companySymbols">
    @foreach ($stocks as $stock)
    <option value="{{$stock->asset_symbol}}">{{ $stock->asset_name }}</option>
    @endforeach
</datalist>
 <input type="submit" value="check price">
</form>
<p>{{ $price ?? '' }}</p> -->

<meta name="csrf-token" content="{{{ csrf_token() }}}">
<input list="companySymbols" name="companySymbol" id="companySymbol" placeholder="Introduce the name of a stock">
<datalist id=companySymbols>
    @foreach ($stocks as $stock)
    <option value="{{$stock->asset_symbol}}">{{ $stock->asset_name }}</option>
    @endforeach
</datalist>
<input type="number" name="price" id="price" readonly>

<script>
    const selectedStock = document.getElementById("companySymbol");
    const price = document.getElementById("price");
    selectedStock.addEventListener("change", (e) => {
        e.preventDefault();
        getData(selectedStock.value);
    }, false);

    function getData(companySymbol) {
        var params = `companySymbol=${companySymbol}`;
        const tokenCSRF = document.getElementsByName("csrf-token")[0].content;
        var xhttp = new XMLHttpRequest();
        url = "/stocksData";
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("x-csrf-token", tokenCSRF);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                price.value = Number.parseFloat(data.price).toFixed(2);
            }
        };
        xhttp.send(params);
    }
</script>