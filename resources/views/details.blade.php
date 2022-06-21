<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Code Challenge</title>
</head>
<body>
<div class="min-h-screen">
    <div class="rounded-xl bg-gray-200 m-3">
        <p class="text-lg font-semibold px-4 py-2"><b>{{ $type }}: {{ $result->name }}</b></p>
    </div>

    @if (isset($topTracks))
    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Top Tracks</p>

        @foreach ($topTracks as $topTrack)
        <a href="{{ route('details', ['id' => $topTrack->id, 'type' => 'tracks']) }}">
            <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
                <img class="block mx-auto h-10 w-10 rounded-full sm:mx-0 sm:shrink-0" src="{{ $topTrack->album->images[0]->url ?? '/img/spotify.png' }}" alt="{{ $topTrack->name }}">
                <div class="flex-1 text-center sm:text-left flex justify-between">
                    <div class="flex">
                        <p class="text-md text-black font-semibold">
                            {{ $topTrack->name }}
                        </p>
                        <p class="mx-1 text-slate-500 font-medium">
                            {{ $topTrack->album->name }}
                        </p>
                    </div>
                    @php 
                    $format = $topTrack->duration_ms > 3600000 ? '%H:%I:%s' : '%I:%s';
                    @endphp
                    <div>{{ Carbon\CarbonInterval::milliseconds($topTrack->duration_ms)->cascade()->format($format) }}</div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @if (isset($albums))
    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Albums</p>

        @foreach ($albums as $album)
        <a href="{{ route('details', ['id' => $album->id, 'type' => 'albums']) }}">
        <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
                <img class="block mx-auto h-10 w-10 rounded-full sm:mx-0 sm:shrink-0" src="{{ $album->images[0]->url ?? '/img/spotify.png' }}" alt="{{ $album->name }}">
                <div class="flex-1 text-center sm:text-left flex justify-between">
                    <div class="flex">
                        <p class="text-md text-black font-semibold">
                            {{ $album->name }}
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @if ($result->type == 'album')
    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Tracks</p>

        @foreach ($result->tracks->items as $track)
        <a href="{{ route('details', ['id' => $track->id, 'type' => 'tracks']) }}">
            <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
                <div class="flex-1 text-center sm:text-left flex justify-between">
                    <div class="flex">
                        <p class="text-md text-black font-semibold">
                            {{ $track->name }}
                        </p>
                    </div>
                    @php 
                    $format = $track->duration_ms > 3600000 ? '%H:%I:%s' : '%I:%s';
                    @endphp
                    <div>{{ Carbon\CarbonInterval::milliseconds($track->duration_ms)->cascade()->format($format) }}</div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @if ($result->type == 'track')
    <div class="rounded-xl bg-gray-200 m-3 py-4">
        <p class="text-lg font-semibold px-4">Details</p>

        <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
            <div class="flex-1 text-center sm:text-left flex justify-between">
                <div class="flex">
                    <p class="text-md text-black font-semibold">
                        Artist(s): {{ implode( ", ", array_map( function($artist){ return $artist->name; }, $result->artists)) }}
                    </p>
                </div>
            </div>
        </div>

        @if ($result->album->album_type == 'album')
        <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
            <div class="flex-1 text-center sm:text-left flex justify-between">
                <div class="flex">
                    <p class="text-md text-black font-semibold">
                        Album: {{ $result->album->name }} 
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
            <div class="flex-1 text-center sm:text-left flex justify-between">
                <div class="flex">
                    <p class="text-md text-black font-semibold">
                        Release: {{ \Carbon\Carbon::parse($result->album->release_date)->format('d/m/Y') }} 
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center py-2 px-4 mx-5 my-3 bg-white rounded-xl shadow-lg space-y-1 hover:bg-slate-300 hover:cursor-pointer sm:py-4 sm:space-y-0 sm:space-x-6">
            <div class="flex-1 text-center sm:text-left flex justify-between">
                <div class="flex">
                    <p class="text-md text-black font-semibold">
                        @php 
                        $format = $result->duration_ms > 3600000 ? '%H:%I:%s' : '%I:%s';
                        @endphp
                        Length: {{ Carbon\CarbonInterval::milliseconds($result->duration_ms)->cascade()->format($format) }}
                    </p>
                </div>
            </div>
        </div>

    </div>
    @endif
</div>
</body>
</html>
