<select class="select style-0" id="realestate_nha_hem" name="realestate_nha_hem">
    <option value="" selected="">Vị trí</option>
    @foreach (listViTri() as $item)
    <option  {{ request()->get('hem')==$item['value']?'selected':'' }} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
    @endforeach
</select>
