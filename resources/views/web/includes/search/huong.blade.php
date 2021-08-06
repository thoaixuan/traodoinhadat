
<select class="select style-0" id="realestate_nha_huong" name="realestate_nha_huong">
    <option value="">Hướng</option>
    @foreach (listHuong() as $item)
    <option  {{ request()->get('huong')==$item['value']?'selected':'' }} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
    @endforeach
</select>
