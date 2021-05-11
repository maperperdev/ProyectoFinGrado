<select>
    <option id="0">Select a cryptocurrency</option>
    @foreach ($cryptos as $crypto)
    <option id="{{$crypto->id}}">{{ $crypto->asset_name }}</option>
    @endforeach
</select>