<h1>{{$heading}}</h1>
@unless(count($listings) == 0)
    @foreach($listings as $listing)
        <h2><a href="/listings/{{$listing['id']}}">{{$listing['title']}}<br></h2></a>
        <p> {{$listing['description']}} <br></p>
    @endforeach
@else
    <p>No listings found</p>
@endunless