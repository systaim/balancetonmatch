<div>
    @foreach ($photos as $photo)
        <img src="{{ $photo->images }}" alt="">
    @endforeach
</div>
