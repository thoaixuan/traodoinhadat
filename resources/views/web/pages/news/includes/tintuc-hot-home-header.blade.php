<div class="ns__hot--title">
    <div class="nsh__title">Tin hot</div>
    <div class="ns__hot--slick">
        @foreach (getPostHots(5) as $item)
            <div>
                <h2 class="title">{{ $item->post_title }}</h2>
          </div>
        @endforeach
    </div>
  </div>

